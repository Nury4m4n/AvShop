<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerIndex()
    {
        return view('auth.register');
    }

    public function registerAuth(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        if (User::create($validatedData)) {
            return redirect()->route('welcome')->with('success', 'Registrasi berhasil. Silahkan login.');
        } else {
            return redirect()->back()->with('error', 'Registrasi gagal. Silahkan coba lagi.');
        }
    }

    public function loginIndex()
    {
        return view('auth.login');
    }

    public function loginAuth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan status admin
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('dashboard'))->with('success', 'Login berhasil.');
            } else {
                return redirect()->intended(route('welcome'))->with('success', 'Login berhasil.');
            }
        }

        return back()->with('error', 'Login gagal. Silahkan periksa email dan password Anda.');
    }




    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Anda telah logout.');
    }
}