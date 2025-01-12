<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function store(OfferRequest $request)
    {
        $offer = Car::create($request->validated());
        return redirect()->route('cars.show', ['car' => $offer->slug]);
    }
}
