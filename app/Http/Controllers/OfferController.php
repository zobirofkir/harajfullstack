<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Mail\CarOfferMail;
use App\Models\Car;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OfferController extends Controller
{
    public function store(OfferRequest $request)
    {
        $offerCar = Car::where('slug', $request->route('slug'))->first();

        if (!$offerCar) {
            return redirect()->back();
        }

        $offer = Offer::create([
            'negotiable_offer_price' => $request->negotiable_offer_price,
            'offer_email' => $request->offer_email,
            'car_id' => $offerCar->id,
        ]);

        Mail::to($offerCar->user->email)->send(new CarOfferMail($offerCar, $offer));

        return redirect()->back();
    }
}
