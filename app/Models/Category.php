<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug'
    ];

    public function cars()
    {
        return $this->hasMany(Car::class);
    }
}
