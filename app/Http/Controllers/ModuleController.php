<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Module $module)
    {
        session(["vistaCourseModule" => ["view" => "course.index", "course"  => $module->course]]);
        return view("module.index", ["module" => $module]);
    }

    public function create(Course $course)
    {
        // $temp = ["view" => "course.index", "params" => ["course" => $course]];
        session(["vistaCourseModule" => ["view" => "course.index", "course"  => $course]]);
        return view("module.create", ["course" => $course]);
    }

    public function back()
    {
        return redirect()->intended(route(session("vistaCourseModule")["view"], session("vistaCourseModule")["course"]));
    }

    public function edit(Module $module)
    {
        return view("module.edit", ["module" => $module]);
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            "name" => "required | min:3 | max:35 | unique:modules",
            "description" => "required | min:5 | max:400"
        ]);

        Module::create([
            "id_course" => $course->id,
            "name" => $request->name,
            "description" => $request->description
        ]);

        $notificationController = new NotificationController();
        $notificationController->store($course, "S'ha afegit un nou mòdul al curs " . $course->name . "!");

        // return redirect()->intended(route("courses.manage"))->with('courseCreatedSuccess', "Curs creat correctament!");
        return $this->back()->with("moduleCreatedSuccess", "Mòdul creat correctament!");
    }

    public function update(Request $request, Module $module)
    {
        $request->validate([
            "name" => "required | min:3 | max:35 | unique:modules,name," . $module->id,
            "description" => "required | min:5 | max:255"
        ]);

        $module = Module::find($module->id);

        $module->update([
            "id_course" => $module->id_course,
            "name" => $request->name,
            "description" => $request->description
        ]);

        $notificationController = new NotificationController();
        $notificationController->store($module->course, "S'ha actualitzat el mòdul " . $module->name . "!");

        return $this->back()->with("moduleUpdateSuccess", "Dades actualitzades correcament!");
    }

    public function destroy(Module $module)
    {
        $notificationController = new NotificationController();
        $notificationController->store($module->course, "S'ha eliminat el mòdul " . $module->name . "!");

        $module->delete();
        return $this->back()->with('moduleDeleteSuccess', "Has eliminat el modul correcament!");
    }
}
