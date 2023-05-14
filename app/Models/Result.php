<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = ['student_id','excercise_id','media_id','mark','professor_id','created_at','updated_at'];


    public function students()
    {
        return $this->hasOne('App\Models\User','id','student_id');
    }

    public function medias()
    {
        return $this->hasOne('App\Models\Media','id','media_id');
    }

    public function excercise()
    {
        return $this->hasOne('App\Models\Excercise','id','excercise_id');
    }

    public function professor()
    {
        return $this->hasOne('App\Models\User','id','professor_id');
    }
}
