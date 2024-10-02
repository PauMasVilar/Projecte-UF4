<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        "id",
        "id_course",
        "message",
        "read"
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id');
    }

    // public function unreadNotifications()
    // {
    //     return $this->belongsToMany(Notification::class, NotificationReaded::class, 'id_student', 'id_course', 'id', 'id_course');
    // }

    // public function unreadNotifications($userId)
    // {
    //     return $this->whereDoesntHave('readByUsers', function ($query) use ($userId) {
    //         $query->where('user_id', $userId);
    //     });
    // }
}
