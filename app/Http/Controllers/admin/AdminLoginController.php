<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\PasswordResetToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use function Ramsey\Uuid\v1;

class AdminLoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function login_process(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Berhasil Login');
        } else {
            return redirect()->route('login')->with('error', 'Email atau Password Salah');
        }
    }

    public function register()
    {
        return view('auth.register');
    }

    public function register_process(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_numb' => 'required',
            'password' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone_numb'] = $request->phone_numb;
        $data['password'] = Hash::make($request->password);
        $data['role'] = 'admin';
        $data['img'] = 'admin.jpg';

        User::create($data);

        return redirect()->route('login')->with('success', 'Berhasil Register');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_process(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|exists:users,email',
            ],
            [
                'email.exists' => 'Email Tidak Ditemukan',
                'email.required' => 'Email Tidak Boleh Kosong',
                'email.email' => 'Email Tidak Valid',
            ]
        );

        $token = bin2hex(random_bytes(16));

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email,
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success', 'Berhasil Reset Password');
    }

    public function validasi_forgot_password(Request $request, $token)
    {
        $getToken = PasswordResetToken::where('token', $token)->first();

        if (!$getToken) {
            return redirect()->route('login')->with('error', 'Token Tidak Valid');
        }
        return view('auth.validasi-token', compact('token'));
    }

    public function validasi_forgot_password_process(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $token = PasswordResetToken::where('token', $request->token)->first();

        if (!$token) {
            return redirect()->route('login')->with('error', 'Token Tidak Valid');
        }

        $user = User::where('email', $token->email)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Email Tidak Valid');
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);
        $token->delete();
        return redirect()->route('login')->with('success', 'Berhasil Reset Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
