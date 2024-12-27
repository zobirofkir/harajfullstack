<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'phone',
        'email',
        'info',
        'images',
        'price',
        'address',
        'description',
        'slug',
        'logo_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logo()
    {
        return $this->belongsTo(Logo::class);
    }
}
