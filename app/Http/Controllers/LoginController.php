<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (auth()->attempt($data)) {
            return redirect()->route('dashboard')->withInput(['username' => $request->input('username')]);
        } else {
            return redirect()->back()->with('error', 'username atau password salah!');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function registerPage()
    {
        return view('register');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admin',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $admin = Admin::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
}
