<?php

namespace App\Services\Services;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Services\Constructors\ContactConstructor;
use Illuminate\Support\Facades\Mail;

class ContactService implements ContactConstructor
{
    public function store(ContactRequest $request): array
    {
        $contact = Contact::create($request->validated());

        Mail::send('emails.contact', ['contact' => $contact], function ($message) use ($contact) {
            $message->to('i.fosalamri75@gmail.com')
                ->subject('رسالة جديدة من '.$contact->name);
        });

        return [
            'success' => true,
            'message' => 'تم إرسال رسالتك بنجاح، شكراً لك، '.$contact->name.'. سنقوم بالتواصل معك في أقرب وقت.',
        ];
    }
}
