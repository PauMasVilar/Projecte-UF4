<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\StudentEnrollment;
use Illuminate\Support\Facades\Auth;

class StudentEnrollmentController extends Controller
{

    public function index()
    {
        session(["vistaCursos" => "studentEnrollment.index"]);
        // $enrolledCourseIds = Auth::user()->enrollments->pluck('id_course');
        // $courses = Course::whereIn('id', $enrolledCourseIds)->get();
        $enrolledCourses = Auth::user()->enrollments->load('course');
        return view("studentEnrollment.index", ["enrolledCourses" => $enrolledCourses]);
    }

    // Retorna la vista per gestionar els alumnes (users) inscrits al curs seleccionat
    public function manage(Course $course)
    {
        session(["vistaUser" => "studentEnrollment.manage"]);
        // $enrolledUsers = $course->enrollments->pluck('id_student');
        // $users = User::whereIn('id', $enrolledUsers)->get();
        $enrolledUsers = $course->enrollments->load('user');
        return view("studentEnrollment.manage", ["enrolledUsers" => $enrolledUsers]);
    }

    public function search(Request $request)
    {
        // Mira si al buscar li pasa o no algun camp a l'input i en cas de que li pasi algun
        // farà dins dels dos cursos inscrits els where name i description.
        $query = $request->input('query');
        // $enrolledCourseIds = Auth::user()->enrollments->pluck('id_course');
        // $courses = Course::whereIn('id', $enrolledCourseIds)->get();
        $enrolledCourses = Auth::user()->enrollments->load('course');

        if (!empty($query)) {
            $enrolledCourses = Course::where('name', 'like', "%$query%")
                ->orWhere('description', 'like', "%$query%")
                ->whereIn('id', Auth::user()->enrollments->pluck('course_id'))
                ->get();
        }

        return view('studentEnrollment.index', ["enrolledCourses" => $enrolledCourses, "query" => $query]);
    }


    public function create(Course $course, User $user)
    {
        StudentEnrollment::create([
            "id_student" => $user->id,
            "id_course" => $course->id,
            "enrollment_date" => Carbon::now(),
        ]);
        return redirect()->back();
    }

    public function delete(Course $course, User $user)
    {
        $enroll = StudentEnrollment::where('id_student', $user->id)->where('id_course', $course->id);
        $enroll->delete();
        return redirect()->back();
    }

    public function destroy(Course $course, User $user)
    {
        return $this->delete($course, $user)->with('enrolledUserDeletedSucess', "Has expulsat l'alumne del curs correctament!");
    }
}
