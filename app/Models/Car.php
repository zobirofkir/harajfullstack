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
        'old_price',
        'address',
        'description',
        'slug',
        'logo_id',
        'gasoline_id'
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

    public function sellerContacts()
    {
        return $this->hasMany(SellerContact::class);
    }

    public function gasoline()
    {
        return $this->belongsTo(Gasoline::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

}
