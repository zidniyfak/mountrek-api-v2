<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Berhasil Logout');
    }
}
