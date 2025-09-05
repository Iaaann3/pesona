<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /**
     * Override username field to use no_rumah instead of email.
     */
    public function username()
    {
        return 'no_rumah';
    }

    use AuthenticatesUsers;

    /**
     * Redirect users after login based on their role.
     */
    protected function redirectTo()
    {
        $user = auth()->user();
        if ($user && $user->role == 'admin') {
            // Redirect ke halaman pembayaran admin
            return route('admin.pembayaran.index');
        } elseif ($user && $user->role == 'user') {
            // Redirect ke dashboard user
            return route('user.dashboard');
        }
        return '/home'; // fallback kalau role tidak jelas
    }

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
