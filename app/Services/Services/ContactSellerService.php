<?php
namespace App\Services\Services;

use App\Http\Requests\ContactSellerRequest;
use App\Mail\ContactSellerMail;
use App\Models\Car;
use App\Models\SellerContact;
use App\Services\Constructors\ContactSellerConstructor;
use Illuminate\Support\Facades\Mail;

class ContactSellerService implements ContactSellerConstructor
{
    public function store(ContactSellerRequest $request): array
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

        $carUrl = route('cars.show', ['car' => $car->slug]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
            'car_title' => $car->title,
            'car_seller_email' => $car->email,
            'car_url' => $carUrl,
        ];

        Mail::to($data['car_seller_email'])->send(new ContactSellerMail($data));

        return [
            'success' => true,
            'message' => "تم إرسال استفسارك إلى بائع السيارة بنجاح.",
            'car_slug' => $car->slug
        ];
    }
}
