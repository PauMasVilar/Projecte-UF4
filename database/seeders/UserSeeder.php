<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // El que fa això és que, previament al iniciar els usuaris, 
        // natejara per complet la carpeta de media, ja que al fer un refresh de la ddbb
        // és com si eliminesim tots els usuaris per tant també eliminar les carpetes adjecents
        $mediaFolder = public_path("media");
        File::cleanDirectory($mediaFolder);

        User::factory([
            "name" => "Pau Mas Vilar",
            "username" => "paumas",
            "email" => "paumas@gmail.com",
            "birth_date" => "2002-11-12",
            "password" => "paumas",
            "is_admin" => true,
            "is_professor" => true,
        ])->create()->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');

        User::factory([
            "name" => "Toni Vila",
            "username" => "toni",
            "email" => "toni@gmail.com",
            "birth_date" => "1976-05-24",
            "password" => "toni",
            "is_professor" => true
        ])->create()->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');

        User::factory([
            "name" => "Marivel",
            "username" => "marivel",
            "email" => "marivel@gmail.com",
            "birth_date" => "1897-01-04",
            "password" => "marivel",
            "is_professor" => true
        ])->create()->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');

        User::factory([
            "name" => "Mario",
            "username" => "mario",
            "email" => "mario@gmail.com",
            "birth_date" => "2003-07-17",
            "password" => "mario"
        ])->create()->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');

        // User::factory()->count(5)->create();

        // Al crear un usuari aleatori, tot i així afagirà per defecte l'imatge que hi ha guardada al public
        User::factory()->count(5)->create()->each(function ($user) {
            $user->addMediaFromUrl(asset('imgs/default.png'))->toMediaCollection('images');
        });
    }
}
