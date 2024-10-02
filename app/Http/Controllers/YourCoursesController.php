<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YourCoursesController extends Controller
{
    public function index()
    {
        session(["vistaCursos" => "yourCourses.index"]);
        $courses = Course::with("user")->where("id_professor", Auth::id())->get();
        return view("course.yourCourses", ["courses" => $courses]);
    }

    public function search(Request $request)
    {
        // En cas de que l'usuari no posi cap text, per defecte retornava tots els cursos
        // per fer que en cas de que no introdueixi res retorni tal i com diu la vista,
        // unicament els cursos de l'usuari logejat, si la query esta buida retornara el mateix
        // que quan accedim a la vista
        $query = $request->input('query');
        if(empty($query)) {
            $courses = Course::with("user")->where("id_professor", Auth::id())->get();
        } else {
            $courses = Course::with("user")
                ->where("id_professor", Auth::id())
                ->where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->get();
        }

        return view('course.yourCourses', ["courses" => $courses, "query" => $query]);
    }
}
