<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class RegisterController extends Controller
{
    public function index()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required | min:4 | max:20",
            "username" => "required | min:4 | max:20 | unique:users",
            "email" => "required | email | unique:users",
            "birth_date" => "required | before_or_equal:" . now()->format('d-m-Y'),
            "password" => "required | confirmed",
            "profile_picture" => "nullable | image"
        ]);

        $user = User::create([
            "name" => $request->name,
            "username" => $request->username,
            "email" => $request->email,
            "birth_date" => $request->birth_date,
            "password" => $request->password,
        ]);

        if ($request->file('profile_picture')) {
            $user->addMediaFromRequest('profile_picture')->toMediaCollection('images');
        } else {
            // Al utilitzar addMediaFromUrl i asset, al esperar una ruta per alguna raó 
            // no funcióna i salta error, en cavi utilitzant directament addMedia i public_path
            // Funciona perfectament. Tot i que en els seeders utilitzo FromUrl
            // Si no poso el ->perservingOriginal al fer un create borrarà la imatge per crear un archiu identifier
            // $user->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');
            $user->addMedia(public_path('imgs/default.png'))->preservingOriginal()->toMediaCollection('images');
        }

        Auth::attempt($request->only('username', 'password'));

        return redirect()->intended(route("home"))->with('loginSuccess', "Has iniciat sessió correcament!");
    }
}
