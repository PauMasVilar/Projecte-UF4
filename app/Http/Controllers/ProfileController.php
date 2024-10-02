<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        // session()->flush();
        session(["vistaCursos" => "profile.index"]);
        session(["vistaUser" => "profile.index"]);
        return view("profile.profile", ["user" => Auth::user()]);
    }

    public function profile(User $user)
    {
        session(["vistaUser" => "profile", "user" => $user]);
        return view("profile.profile", ["user" => $user]);
    }

    public function back($var = "", $msg = "")
    {
        $redirect = redirect()->intended(route(session("vistaUser")));
        return (!empty($var) && !empty($msg)) ? $redirect : $redirect->with($var, $msg);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('logout');
    }
}
