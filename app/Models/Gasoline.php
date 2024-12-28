<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gasoline extends Model
{
    protected $fillable = [
        'type',
        'user_id',
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
