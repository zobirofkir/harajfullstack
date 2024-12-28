<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSellerRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\SellerContact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSellerMail;

class ContactSellerController extends Controller
{
    public function store(ContactSellerRequest $request)
    {
        $validated = $request->validated();

        $car = Car::findOrFail($validated['car_id']);

        $contact = SellerContact::create([
            'car_id' => $validated['car_id'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'car_title' => $car->title,
            'car_seller_email' => $car->email,
        ];

        Mail::to($data['car_seller_email'])->send(new ContactSellerMail($data));

        return redirect()->back()->with('success', 'Your message has been sent to the seller!');
    }
}
