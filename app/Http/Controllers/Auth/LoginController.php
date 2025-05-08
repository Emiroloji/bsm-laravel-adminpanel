<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;            // ✅  DOĞRU  Request
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /* Giriş sonrası yönlendirme */
    protected string $redirectTo = '/dashboard';

    /* Oturum kapatma */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');   // veya '/'
    }
}