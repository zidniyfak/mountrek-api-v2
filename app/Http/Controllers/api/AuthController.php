<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Stringable;

class AuthController extends Controller
{
    //
    function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone_numb' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'User register successfully',
            'data' => $success
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }

        $success['token'] = $user->createToken('auth_token')->plainTextToken;
        $success['name'] = $user->name;
        $success['email'] = $user->email;

        return response()->json([
            'success' => true,
            'message' => 'User login successfully',
            'data' => $success
        ]);
    }

    public function user(Request $request)
    {
        $user = Auth::user();
        // $data = Post::where('user_id', $user->id)->get();
        return response()->json([
            'success' => true,
            'message' => 'User retrieved successfully',
            'data' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        // Jika ada file gambar, simpan ke storage
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $imgName = $img->hashName();
            $img->storeAs('public/users', $imgName);

            // Hapus gambar lama jika ada
            if ($user->img && Storage::exists('public/users/' . $user->img)) {
                Storage::delete('public/users/' . $user->img);
            }

            // Simpan nama file baru ke database
            $user->img = $imgName;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_numb = $request->phone_numb;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'success' => true,
            'message' => 'User logout successfully',
            'data' => null
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found',
            ], 404);
        }

        $otp = rand(100000, 999999);

        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(15);
        $user->save();

        $data = [
            // 'email' => $user->email,
            'name' => $user->name,
            'otp' => $otp,
        ];

        // dd($data);

        Mail::to($user->email)->send(new \App\Mail\SendOtp($data));

        return response()->json([
            'success' => true,
            'message' => 'Reset password link sent to your email',
            'data' => $data
        ]);
    }

    public function validateOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required',
        ]);

        $user = User::where('email', $request->email)
            ->where('otp', $request->otp)
            ->where('otp_expires_at', '>=', now())
            ->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP',
            ], 400);
        }

        $token = \Illuminate\Support\Str::random(60);
        $user->remember_token = $token;
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'OTP validated successfully',
            'data' => $user
        ]);
    }

    public function resetPassword(Request $request, $token)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid token',
            ], 404);
        }
        $user->password = Hash::make($request->password);
        $user->remember_token = null;
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Password reset successfully',
            'data' => $user
        ]);
    }
}
