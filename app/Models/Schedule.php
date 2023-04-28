<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

     // TODO: ЗАМЕНИТЬ НА БЕЛОНГТУ

    public function professors()
    {
        return $this->hasOne('App\Models\User','id','professor_id');
    }

    public function courses()
    {
        return $this->hasOne('App\Models\StudentCourse','id','student_course_id');
    }

    public function daysofweek()
    {
        return $this->hasOne('App\Models\DayOfWeek','id','day_of_week_id');
    }

    public function rooms()
    {
        return $this->hasOne('App\Models\Room','id','room_id');
    }
}
