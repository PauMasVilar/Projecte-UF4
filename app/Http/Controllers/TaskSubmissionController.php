<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Assigment;
use Illuminate\Http\Request;
use App\Models\TaskSubmission;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;

class TaskSubmissionController extends Controller
{
    public function grade(TaskSubmission $submission)
    {
        session(["vistaModuleContent" => ["view" => "moduleContent.index", "moduleContent"  => $submission->assigment->moduleContent]]);
        return view("submission.grade", ["submission" => $submission]);
    }

    public function store(Assigment $assigment, User $user, Request $request)
    {
        $request->validate(["file" => 'required | mimes:pdf, | max:2048']);

        $name = $request->file->getClientOriginalName();
        $path = $request->file->store('assigments');

        TaskSubmission::create([
            "id_assigment" => $assigment->id,
            "id_student" => $user->id,
            "due_date" => Carbon::now(),
            "submission" => $name,
            "path" => $path
        ]);
        return back()->with('taskSubmissionStoreSuccess', "Tasca entregada correctament!");
    }

    public function storeGrade(TaskSubmission $submission, Request $request)
    {

        $submission = TaskSubmission::find($submission->id);
        $submission->update(["grade" => $request->grade]);

        $notificationController = new NotificationController();
        $notificationController->store($submission->assigment->moduleContent->module->course, "S'ha corretgit la tasca  " . $submission->assigment->title . " del modul " . $submission->assigment->moduleContent->module->name . "!");

        return redirect()->intended(route(session("vistaModuleContent")["view"], session("vistaModuleContent")["moduleContent"]))->with('gradeStoreSuccess', "Correcció guardada correctament!");
    }


    public function destroy(Assigment $assigment, User $user)
    {
        $submission = TaskSubmission::where('id_assigment', $assigment->id)->where('id_student', $user->id)->get()->first();
        $filename = storage_path('app/' . $submission->path);
        File::delete($filename);

        $submission->delete();

        return back()->with('taskSubmissionDeleteSuccess', "Tasca eliminada correctament!");
    }

    public function view(TaskSubmission $taskSubmission)
    {
        $path = storage_path('app/' . $taskSubmission->path);
        return response()->file($path);
    }

    // public function view($taskSubmissionId)
    // {
    //     dd($taskSubmissionId);
    //     // $file = TaskSubmission::find($fileId);
    //     $path = storage_path('app/' . $taskSubmission->path);
    //     return response()->file($path);
    // }
}
