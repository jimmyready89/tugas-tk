<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $request->validate([
            'nip' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('nip', $request->nip)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            
            $request->session()->regenerate();
            
            return redirect()->intended(route('home'))
                           ->with('success', 'Selamat datang, ' . $user->nip . '!');
        }

        return back()->withErrors([
            'nip' => 'NIP atau password yang Anda masukkan salah.',
        ])->onlyInput('nip');
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:20|unique:users,nip',
            'role' => 'required|string|max:50',
            'department' => 'required|string|max:100',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nip' => $request->nip,
            'role' => $request->role,
            'department' => $request->department,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        
        $request->session()->regenerate();
        
        return redirect()->route('home')
                        ->with('success', 'Registrasi berhasil! Selamat datang di Portal Berita.');
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')
                        ->with('success', 'Anda berhasil logout.');
    }
}
