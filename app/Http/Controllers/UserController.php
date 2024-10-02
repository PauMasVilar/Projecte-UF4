<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index()
    {
        // session()->flush();
        session(["vistaUser" => "users.index"]);
        $users = User::all();
        return view("user.manage", ["users" => $users]);
    }

    public function edit(User $user)
    {
        return view("user.edit", ["user" => $user]);
    }

    public function back($var = "", $msg = "")
    {
        // echo session("vistaUser");
        // echo session("vistaCursos");
        // die();
        if (session()->has("vistaCursos")) $redirect = redirect()->intended(route(session("vistaCursos")));
        else $redirect = redirect()->intended(route(session("vistaUser") ?? "home"));
        return (!empty($var) && !empty($msg)) ? $redirect : $redirect->with($var, $msg);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required | min:4 | max:20",
            "username" => "required | min:4 | max:20 | unique:users,username," . $user->id,
            "email" => "required | email | unique:users,email," . $user->id,
            "birth_date" => "required | before_or_equal:" . now()->format('d-m-Y'),
            "password" => "nullable | confirmed",
            "profile_picture" => "nullable | image",
        ]);

        $user = User::find($user->id);

        $user->update([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "birth_date" => $request->birth_date,
        ]);

        // En cas de que no posi les passwords o no posi profile_picture, no farà update a aquests camps
        if ($request->password && $request->password_confirmation) $user->update(["password" => $request->password]);
        if ($request->file('profile_picture')) $user->addMediaFromRequest('profile_picture')->toMediaCollection('images');
        // return $this->back()->with("userUpdateSuccess", "Dades actualitzades correcament!");

        if (session()->has("vistaUser")) return redirect()->intended(route(session("vistaUser")) ?? "home")->with("userUpdateSuccess", "Dades actualitzades correcament!");

        // if ($from === "profile") return redirect()->intended(route("profile.index"))->with('userUpdateSuccess', "Dades actualitzades correcament!");
        // return redirect()->intended(route("users.index"))->with('userUpdateSuccess', "Has actualitzat l'usuari correcament!");
    }

    public function destroy(User $user)
    {   
        $media = public_path("media/" . $user->id);
        File::deleteDirectory($media);

        $user->delete();
        return redirect()->intended(route("users.index"))->with('userDeleteSuccess', "Has eliminat l'usuari correcament!");
    }

    public function changeProfessor(User $user)
    {
        $user->update(["is_professor" => !$user->is_professor]);
        return redirect()->intended(route("users.index"))->with('userUpdateSuccess', "Has actualitzat l'usuari correcament!");
    }

    public function changeAdmin(User $user)
    {
        $user->update(["is_admin" => !$user->is_admin]);
        return redirect()->intended(route("users.index"))->with('userUpdateSuccess', "Has actualitzat l'usuari correcament!");
    }
}
