<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\NotificationReaded;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function store(Course $course, $msg)
    {
        Notification::create([
            "id_course" => $course->id,
            "message" => $msg,
        ]);
    }

    public function read(Notification $notification, User $user)
    {
        NotificationReaded::create([
            "id_notification" => $notification->id,
            "id_user" => $user->id,
        ]);

        return back();
    }

    public function readAll(User $user)
    {
        $notifications = Auth::user()->unreadNotifications;
        foreach ($notifications as $notification) {
            NotificationReaded::create([
                "id_notification" => $notification->id,
                "id_user" => $user->id,
            ]);
        }

        return back();
    }
}
