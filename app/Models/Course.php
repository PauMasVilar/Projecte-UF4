<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';

    protected $fillable = [
        "id",
        "id_professor",
        "name", 
        "description",
        "duration", 
        "start_date",
        "end_date"
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_professor', 'id');
    }

    public function modules()
    {
        return $this->hasMany(Module::class, 'id_course', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class, 'id_course', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'id_course', 'id');
    }
    
    public static function last()
    {
        return static::all()->last();
    }

    public static function first()
    {
        return static::all()->first();
    }
}
