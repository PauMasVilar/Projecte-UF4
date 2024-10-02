<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $table = 'student_enrollment';

    protected $fillable = [
        "id",
        "id_student",
        "id_course",
        "enrollment_date",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_student');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }
}
