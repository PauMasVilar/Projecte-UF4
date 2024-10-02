<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    use HasFactory;

    protected $table = 'task_submissions';
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "id_assigment",
        "id_student",
        "due_date",
        "submission",
        "path",
        "grade"
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_student');
    }

    public function assigment()
    {
        return $this->belongsTo(Assigment::class, 'id_assigment');
    }

    // NO CAMBIAR EL PUTO NOM GRACIES
    public function getRouteKeyName()
    {
        return 'submission';
    }
}
