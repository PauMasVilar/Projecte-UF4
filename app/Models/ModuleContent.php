<?php

namespace App\Models;

use App\Models\Module; // Add this import statement

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleContent extends Model
{
    use HasFactory;

    protected $table = 'module_content';

    protected $fillable = [
        "id",
        "id_module",
        "title",
        "content",
    ];

    public function module()
    {
        return $this->belongsTo(Module::class, 'id_module', 'id');
    }

    public function assigment()
    {
        return $this->belongsTo(Assigment::class, "id", "id_module_content");
    }

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'id_module_content');
    }

    public function files()
    {
        return $this->hasMany(ModuleContentFile::class, "module_content_id", "id");
    }
}
