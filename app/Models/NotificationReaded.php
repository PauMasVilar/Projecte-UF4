<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationReaded extends Model
{
    use HasFactory;

    protected $table = 'notifications_readed';

    protected $fillable = [
        "id",
        "id_notification",
        "id_user",
    ];
}
