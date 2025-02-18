<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/tasks';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    // Personnaliser la réponse en cas d'échec de connexion
    protected function sendFailedLoginResponse(Request $request)
    {
        // Personnaliser le message d'erreur
        $errors = ['email' => trans('auth.failed')];

        // Ajouter un message d'erreur à la session
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors($errors)
            ->with('status', 'Invalid email or password!');
    }

    // Personnaliser la réponse après une connexion réussie
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectPath())
            ->with('status', 'Login successful!');
    }
}
