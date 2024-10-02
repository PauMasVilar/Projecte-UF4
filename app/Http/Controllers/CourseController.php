<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\StudentEnrollment;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        // session()->flush();
        session(["vistaCursos" => "courses.index"]);
        $courses = Course::with("user")->get();
        return view("course.index", ["courses" => $courses]);
    }

    
    public function courseIndex(Course $course)
    {
        return view("course.courseIndex", ["course" => $course]);
    }

    public function indexProfile(Course $course, User $user)
    {
        session(["vistaUser" => "profile", "user" => $user]);
        return view("course.courseIndex", ["course" => $course]);
    }

    public function show(Course $course)
    {
        session(["vistaCursos" => "courses.index"]);
        return view("course.courseIndex", ["course" => $course]);
    }

    public function manage()
    {
        // $courses = Course::leftJoin("users", "users.id", "=", "courses.id_professor")
        //     ->select("courses.*", "users.name as professor_name")
        //     ->get();
        // session()->flush();
        session(["vistaCursos" => "courses.manage"]);
        $courses = Course::with("user")->get();
        return view("course.manage", ["courses" => $courses]);
    }

    public function create()
    {
        return view("course.create");
    }

    public function edit(Course $course)
    {
        return view("course.edit", ["course" => $course]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $courses = Course::where('name', 'like', "%$query%")->orWhere('description', 'like', "%$query%")->get();

        return view('course.index', ["courses" => $courses, "query" => $query]);
    }

    public function back()
    {
        // dd(session("vistaUser"));
        return (session("vistaUser") == "profile") ? redirect()->intended(route(session("vistaUser"), ["user" => session("user")])) : redirect()->intended(route(session("vistaCursos")));
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required | min:4 | max:35 | unique:courses",
            "description" => "required | min:5 | max:255",
            "duration" => "required | min:1 | max:3",
            "start_date" => "required | after_or_equal:" . now()->format('d-m-Y'),
            "end_date" => "required | after_or_equal:start_date",
        ]);

        Course::create([
            "id_professor" => Auth::user()->id,
            "name" => $request->name,
            "description" => $request->description,
            "duration" => $request->duration,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
        ]);

        // return redirect()->intended(route("courses.manage"))->with('courseCreatedSuccess', "Curs creat correctament!");
        return $this->back()->with("courseCreatedSuccess", "Curs creat correctament!");
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            "name" => "required | min:4 | max:35 | unique:courses,name," . $course->id,
            "description" => "required | min:5 | max:255",
            "duration" => "required | min:1 | max:3",
            "start_date" => "required | after_or_equal:" . now()->format('d-m-Y'),
            "end_date" => "required | after_or_equal:" . now()->format('d-m-Y'),
        ]);

        $course = Course::find($course->id);

        $course->update([
            "name" => $request->name,
            "description" => $request->description,
            "duration" => $request->duration,
            "start_date" => $request->start_date,
            "end_date" => $request->end_date,
        ]);

        return $this->back()->with("courseUpdateSuccess", "Dades actualitzades correcament!");
        // with('courseUpdateSuccess', "Dades actualitzades correcament!");
        // return redirect()->intended(route("courses.manage"))->with('courseUpdateSuccess', "Has actualitzat el curs correcament!");
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return $this->back()->with('courseDeleteSuccess', "Has eliminat el curs correcament!");
    }
}
