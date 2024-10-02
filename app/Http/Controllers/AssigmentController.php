<?php

namespace App\Http\Controllers;

use App\Models\Assigment;
use Illuminate\Http\Request;
use App\Models\ModuleContent;

class AssigmentController extends Controller
{
    public function create(ModuleContent $moduleContent)
    {
        session(["vistaModuleContent" => ["view" => "moduleContent.index", "moduleContent" => $moduleContent]]);
        return view("assigment.create", ["moduleContent" => $moduleContent]);
    }

    public function back()
    {
        return redirect()->intended(route(session("vistaModuleContent")["view"], session("vistaModuleContent")["moduleContent"]));
    }

    public function edit(Assigment $assigment)
    {
        // dd($assigment->moduleContent);
        session(["vistaModuleContent" => ["view" => "moduleContent.index", "moduleContent" => $assigment->moduleContent]]);
        return view("assigment.edit", ["assigment" => $assigment]);
    }

    public function store(ModuleContent $moduleContent, Request $request)
    {
        $request->validate([
            "title" => "required | min:4 | max:50 | unique:assigments",
            "description" => "required | min:5",
            "due_date" => "required | after_or_equal:" . now()->format('d-m-Y'),
        ]);

        Assigment::create([
            "id_module_content" => $moduleContent->id,
            "title" => $request->title,
            "description" => $request->description,
            "due_date" => $request->due_date,
        ]);

        $notificationController = new NotificationController();
        $notificationController->store(
            $moduleContent->module->course, 
            "S'ha afegit la tasca " . $moduleContent->assigment->title 
            . " al contingut " . $moduleContent->title 
            . " del mòdul " . $moduleContent->module->name 
            . " pel dia " . date("d/m/Y", strtotime($moduleContent->assigment->due_date))
        );

        return $this->back()->with("assigmentCreatedSucess", "Tasca afegida correctament!");
    }

    public function update(Assigment $assigment, Request $request)
    {
        $request->validate([
            "title" => "required | min:4 | max:50 | unique:assigments,title," . $assigment->id,
            "description" => "required | min:5",
            "due_date" => "required | after_or_equal:" . now()->format('d-m-Y')
        ]);

        $assigment = Assigment::find($assigment->id);

        $assigment->update([
            "title" => $request->title,
            "description" => $request->description,
            "due_date" => $request->due_date
        ]);

        $notificationController = new NotificationController();
        $notificationController->store(
            $assigment->moduleContent->module->course, 
            "S'ha modificat la tasca " . $request->title
            . " del contingut " . $assigment->moduleContent->title 
            . " del mòdul " . $assigment->moduleContent->module->name
            . " pel dia " . date("d/m/Y", strtotime($request->due_date))
        );
        return $this->back()->with("assigmentUpdateSuccess", "Tasca actualitzada correcament!");
    }

    public function destroy(Assigment $assigment)
    {
        $notificationController = new NotificationController();
        $notificationController->store(
            $assigment->moduleContent->module->course, 
            "S'ha eliminat la tasca del contingut " . $assigment->moduleContent->title 
            . " del mòdul " . $assigment->moduleContent->module->name . "!"
        );

        $assigment->delete();
        return back()->with('assigmentDeleteSuccess', "Has eliminat la tasca correcament!");
    }
}
