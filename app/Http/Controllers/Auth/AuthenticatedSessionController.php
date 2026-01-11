<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class AuthenticatedSessionController extends Controller
{
    /**
     * ADMIN LOGIN ONLY
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
            'admin_key' => ['required'],
        ]);

        // ✅ CEK SECRET KEY ADMIN
        if ($request->admin_key !== env('ADMIN_SECRET')) {
            return back()->withErrors([
                'admin_key' => 'Invalid admin secret key',
            ]);
        }

        // ✅ LOGIN MANUAL (WAJIB)
        if (!Auth::attempt($request->only('email','password'))) {
            return back()->withErrors([
                'email' => 'Email or password incorrect',
            ]);
        }

        $request->session()->regenerate();

        // 🔥 PAKSA REDIRECT KE ADMIN (INI KUNCI SEMUANYA)
        return redirect('/admin/products');
    }

    /**
     * LOGOUT
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
