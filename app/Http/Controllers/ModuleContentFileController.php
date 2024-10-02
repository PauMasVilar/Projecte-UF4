<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\ModuleContentFile;
use Illuminate\Support\Facades\Storage;
use App\Models\ModuleContent;

class ModuleContentFileController extends Controller
{

    public function getAllFiles()
    {
        return ModuleContentFile::all();
    }

    public function store(Request $request, ModuleContent $moduleContent)
    {
        foreach ($request->file('files') as $file) {
            $name = $file->getClientOriginalName();
            $path = $file->store('uploads');

            ModuleContentFile::create([
                "module_content_id" => $moduleContent->id,
                "name" => $name,
                "path" => $path
            ]);
        }
    }

    public function view(ModuleContentFile $file)
    {
        $path = storage_path('app/' . $file->path);
        return response()->file($path);
    }

}
