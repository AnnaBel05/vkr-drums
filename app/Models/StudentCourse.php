<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentCourse extends Model
{
    use HasFactory;

    public function schedule(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function excercise(): HasMany
    {
        return $this->hasMany(Excercise::class);
    }

    public function professor()
    {
        return $this->hasOne('App\Models\User','id','professor_id');
    }

    public function student()
    {
        return $this->hasOne('App\Models\User','id','student_id');
    }
}
