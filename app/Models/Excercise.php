<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Excercise extends Model
{
    use HasFactory;

    protected $fillable = ['media_id','theory','student_course_id'];
    public $timestamps = false;

    public function medias()
    {
        return $this->hasOne('App\Models\Media','id','media_id');
    }

    public function courses()
    {
        return $this->hasOne('App\Models\StudentCourse','id','student_course_id');
    }

    public function result(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
