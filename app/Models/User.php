<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id', 
        'name',
        'username',
        'email',
        'birth_date',
        'password',
        'is_professor',
        'is_admin'
    ];

    protected $table = 'users';

    public function courses()
    {
        return $this->hasMany(Course::class, 'id_professor', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany(StudentEnrollment::class, 'id_student', 'id');
    }

    public function taskSubmissions()
    {
        return $this->hasMany(TaskSubmission::class, 'id_student', 'id');
    }

    public function notifications()
    {
        return $this->hasManyThrough(Notification::class, StudentEnrollment::class, 'id_student', 'id_course', 'id', 'id_course');
    }

    public function unreadNotifications()
    {
        return $this->hasManyThrough(Notification::class, StudentEnrollment::class, 'id_student', 'id_course', 'id', 'id_course')
        ->whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('notifications_readed')
                ->whereColumn('notifications_readed.id_notification', 'notifications.id')
                ->where('notifications_readed.id_user', Auth::user()->id);
        });
    }

    public static function last()
    {
        return static::all()->last();
    }

    public static function first()
    {
        return static::all()->first();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion("thumb")
            ->width(100)
            ->height(100);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_professor' => 'boolean',
        'is_admin' => 'boolean',
        'password' => 'hashed',
    ];
}
