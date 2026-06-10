<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SmartyRenderer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin(SmartyRenderer $smarty)
    {
        return $smarty->render('auth/login.tpl');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        $request->session()->regenerate();

        $destination = auth()->user()->is_admin ? '/admin/products' : '/';

        return redirect()->intended($destination)->with('success', 'Welcome back.');
    }

    public function showRegister(SmartyRenderer $smarty)
    {
        return $smarty->render('auth/register.tpl');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = User::create($data);
        Auth::login($user);

        return redirect('/')->with('success', 'Your account is ready.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been signed out.');
    }
}
