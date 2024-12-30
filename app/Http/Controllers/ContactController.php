<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\Facades\ContactFacade;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contacts.index');
    }


    public function store(ContactRequest $request)
    {
        $contact = ContactFacade::store($request);
        return redirect()->route('contacts.index')->with('success', $contact['message']);
    }
}
