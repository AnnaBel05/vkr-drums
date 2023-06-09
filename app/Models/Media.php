<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['link','name'];
    public $timestamps = false;

    public function excercise(): HasMany
    {
        return $this->hasMany(Excercise::class);
    }

    public function result(): HasMany
    {
        return $this->hasMany(Result::class);
    }
}
