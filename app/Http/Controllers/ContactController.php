<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.contacts.index');
    }

    public function store(ContactRequest $request)
    {
        $contact = Contact::create($request->validated());

        Mail::send('emails.contact', ['contact' => $contact], function ($message) {
            $message->to('zobirofkir19@gmail.com')
                    ->subject('رسالة جديدة من نموذج الاتصال');
        });

        return view('pages.contacts.index')->with('success', 'تم إرسال رسالتك بنجاح!');
    }
}
