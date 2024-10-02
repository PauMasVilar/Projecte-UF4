<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModuleContent;

class Module extends Model
{
    use HasFactory;

    protected $table = 'modules';

    protected $fillable = [
        "id",
        "id_course",
        "name",
        "description"
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course', 'id');
    }

    public function moduleContent()
    {
        return $this->hasMany(ModuleContent::class, 'id_module', 'id');
    }
}
