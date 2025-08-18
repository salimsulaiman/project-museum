<?php

namespace App\Http\Controllers;

use App\Models\User;  //User: Model untuk menyimpan data user ke databas
use Illuminate\Http\Request; //Request: Untuk menangani data dari form.
use Illuminate\Support\Facades\Auth;  //Auth: Fitur autentifikasi login dan logout Laravel.
use Illuminate\Support\Facades\Hash; //Untuk mengenkripsi password.
use Illuminate\Support\Facades\Cookie; //Cookie: Untuk menyimpan pesan ke browser

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'hp' => 'required|regex:/^[0-9]+$/|min:10|max:15',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:user,admin'
        ]);

        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'hp' => $request->hp,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        Cookie::queue('register_success', 'Registrasi berhasil! Silakan login.', 1);

        return redirect()->route('login');
    }

    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard.index'); //Jika login gagal, arahkan kembali ke form login dengan pesan error:
            } else {
                return redirect()->route('dashboard.user');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
