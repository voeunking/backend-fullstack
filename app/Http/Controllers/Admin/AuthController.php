<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $token = $request->query('token');
        if ($token) {
            $tokenModel = PersonalAccessToken::findToken($token);
            if ($tokenModel && $tokenModel->tokenable->role === 'admin') {
                Auth::login($tokenModel->tokenable);
                return redirect()->route('admin.dashboard');
            }
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials) && Auth::user()->role === 'admin') {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials or not an admin']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(env('FRONTEND_URL', '/'));
    }
}
