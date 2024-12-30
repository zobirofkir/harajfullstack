<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactSellerRequest;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\SellerContact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactSellerMail;
use App\Services\Facades\ContactSellerFacade;

class ContactSellerController extends Controller
{
    public function store(ContactSellerRequest $request)
    {
        $contactSeller = ContactSellerFacade::store($request);

        return redirect()->route('cars.show', ['car' => $contactSeller['car_slug']])->with('success', $contactSeller['message']);
    }
}
