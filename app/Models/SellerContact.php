<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerContact extends Model
{
    protected $fillable = [
        'car_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
