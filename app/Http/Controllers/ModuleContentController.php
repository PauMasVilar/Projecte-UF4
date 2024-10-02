<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Models\ModuleContent;
use App\Models\TaskSubmission;
use App\Models\ModuleContentFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ModuleContentController extends Controller
{
    public function index(ModuleContent $moduleContent)
    {
        // En comptes de fer el foreach a la vista i mirar file per file si coincideix amb l'id del moduleContent
        // que estem mostrant, previament a la vista ja recupero unicament els files del moduleContent que llistarè
        // i per tant només caldrar llistar-los sense fer les comprobacions a la vista.
        $files = ModuleContentFile::where('module_content_id', $moduleContent->id)->get();
        // $taskSubmission = TaskSubmission::where("id_assigment", $moduleContent->assigment->id)->where("id_student", Auth::user()->id)->first();
        // $moduleContent->assigment->taskSubmissions->where("id_student", Auth::user()->id);
        // dd($submissionFile);
        // TaskSubmission::where('module_content_id', $moduleContent->id)->where()->get();
        session(["vistaModule" => ["view" => "module.index", "course"  => $moduleContent->module]]);
        // dd(session()->all());
        return view("moduleContent.index", ["moduleContent" => $moduleContent, "files" => $files/* , "taskSubmission" => $taskSubmission */]);
    }

    public function create(Module $module)
    {
        session(["vistaCourseModule" => ["view" => "course.index", "course"  => $module->course]]);
        return view("moduleContent.create", ["module" => $module]);
    }

    public function back()
    {
        return redirect()->intended(route(session("vistaCourseModule")["view"], session("vistaCourseModule")["course"]));
    }

    public function backContent()
    {
        return redirect()->intended(route(session("vistaModule")["view"], session("vistaModule")["course"]));
    }

    public function edit(ModuleContent $moduleContent)
    {
        return view("moduleContent.edit", ["moduleContent" => $moduleContent]);
    }

    public function store(Request $request, Module $module)
    {
        $request->validate([
            "title" => "required | min:3 | max:20 | unique:module_content",
            "content" => "required | min:5",
            "files.*" => 'mimes:pdf, | max:2048',
        ]);

        $moduleContent = ModuleContent::create([
            "id_module" => $module->id,
            "title" => $request->title,
            "content" => $request->content
        ]);

        if ($request->file('files')) app(ModuleContentFileController::class)->store($request, $moduleContent);

        $notificationController = new NotificationController();
        $notificationController->store($module->course, "S'ha afegit nou contingut al mòdul " . $module->name . "!");
        
        // return redirect()->intended(route("courses.manage"))->with('courseCreatedSuccess', "Curs creat correctament!");
        return $this->back()->with("moduleContentCreatedSuccess", "Contingut afegit correctament!");
    }

    public function update(Request $request, ModuleContent $moduleContent)
    {
        $request->validate([
            "title" => "required|min:3|max:20|unique:module_content,title," . $moduleContent->id,
            "content" => "required|min:5",
            "files.*" => 'sometimes|mimes:pdf|max:2048',
        ]);

        $moduleContent = ModuleContent::find($moduleContent->id);

        $moduleContent->update([
            "id_module" => $moduleContent->id_module,
            "title" => $request->title,
            "content" => $request->content
        ]);

        if ($request->file('files')) {
            $files = $moduleContent->files;

            // Al editar un moduleContent, en cas de que el professor introdueixi algun fitxer, eliminarà els fitxers que hi havien 
            // guardats previament i inserterà els nous, per aixó hem d'eliminar tant els pdfs guardats a la ruta app/uploads
            // com els registres de la base de dades de la taula module_content_files
            foreach ($files as $file) {
                $filename = storage_path('app/' . $file->path);
                File::delete($filename);
                ModuleContentFile::whereIn("id", $file)->delete();
            }

            app(ModuleContentFileController::class)->store($request, $moduleContent);
        }

        $notificationController = new NotificationController();
        $notificationController->store($moduleContent->module->course, "S'ha actualitzat el contingut del mòdul " . $moduleContent->module->name . "!");

        return $this->backContent()->with("moduleContentUpdateSuccess", "Dades actualitzades correcament!");
    }

    public function destroy(ModuleContent $moduleContent)
    {
        $files = $moduleContent->files;

        // Eliminar archius associats al contingut del modul
        foreach ($files as $file) {
            $filename = storage_path('app/' . $file->path);
            File::delete($filename);
        }

        $notificationController = new NotificationController();
        $notificationController->store($moduleContent->module->course, "S'ha eliminat contingut del mòdul " . $moduleContent->module->name . "!");

        $moduleContent->delete();

        return $this->backContent()->with('moduleContentDeleteSuccess', "Has eliminat el contingut del mòdul correcament!");
    }
}
