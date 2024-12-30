<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Mountain;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    //
    // public function index()
    // {
    //     $users = User::all();
    //     return view('users.user_index', compact('users'));
    // }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $users = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
        })->get();

        return view('users.user_index', compact('users'));
    }
    public function create()
    {
        return view('users.user_create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50',
                'password' => 'required|string|max:50',
                'phone_numb' => 'required|string|max:50',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menangani gambar jika ada
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img->storeAs('public/users', $img->hashName());

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_numb' => $request->phone_numb,
                'img' => $img->hashName(),
            ]);
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_numb' => $request->phone_numb,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User Created Successfully');
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('users.user_edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|email|max:50',
                'phone_numb' => 'required|string',
                'password' => 'nullable',
                'img' => 'nullable',
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::findOrFail($id);
        if ($request->hasFile('img')) {
            $img = $request->file('img');
            $img->storeAs('public/users', $img->hashName());

            $path = str_replace('http://127.0.0.1:8000/storage/', '', $user->img);
            Storage::delete('public/' . $path);

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_numb = $request->phone_numb;
            $user->img = $img->hashName();
            $user->save();
        } else {
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_numb = $request->phone_numb;
            $user->save();
        }

        return redirect()->route('admin.users.index')->with('success', 'User Updated Successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // Menghapus gambar dari storage jika ada
        if ($user->img) {
            $path = str_replace('http://127.0.0.1:8000/storage/', '', $user->img);
            Storage::delete('public/' . $path);
        }
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User Deleted Successfully');
    }
}
