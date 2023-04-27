<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;
    /**
     * Get all of the comments for the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     // TODO: ЗАМЕНИТЬ НА БЕЛОНГТУ
    // public function professors(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }

    // public function courses(): HasMany
    // {
    //     return $this->hasMany(StudentCourse::class);
    // }

    // public function dayofweeks(): HasMany
    // {
    //     return $this->hasMany(DayOfWeek::class);
    // }

    // public function rooms(): HasMany
    // {
    //     return $this->hasMany(Room::class);
    // }
}
