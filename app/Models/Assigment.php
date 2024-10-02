<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assigment extends Model
{
    use HasFactory;

    protected $table = 'assigments';

    protected $fillable = [
        "id",
        "id_module_content",
        "title",
        "description",
        "due_date",
    ];

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'id_assigment');
    }

    public function moduleContent()
    {
        return $this->belongsTo(ModuleContent::class, 'id_module_content');
    }
}
