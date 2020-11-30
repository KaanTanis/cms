<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnkaRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        }
        return back()->withInfo(__('authFailed'));
    }

    public function logout()
    {
        Auth::logout();
    }
}
