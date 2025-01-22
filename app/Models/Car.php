<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'images',
        'price',
        'description',
        'negotiable_price',
        'slug',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sellerContacts()
    {
        return $this->hasMany(SellerContact::class);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
