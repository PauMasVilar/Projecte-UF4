<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    public function index()
    {
        session(["vistaCursos" => "professors.index"]);
        session(["vistaUser" => "professors.index"]);
        $professors = User::with("courses")->get();
        return view("professor.index", ["professors" => $professors]);
    }
}
