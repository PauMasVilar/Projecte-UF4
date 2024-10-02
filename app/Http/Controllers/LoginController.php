<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view("auth.login");
    }

    public function autenticate(Request $request)
    {
        $credentials = $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            // return redirect()->intended(route("home", Auth::user()->username))->with('loginSuccess', "Has iniciat sessió correcament!");
            return redirect()->intended(route("home"))->with('loginSuccess', "Has iniciat sessió correcament!");
        }

        return back()->withErrors(["credentials" => "Credencials incorrectes"]);
    }
}
