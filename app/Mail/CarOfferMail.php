<?php

namespace App\Mail;

use App\Models\Car;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CarOfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $car;

    public $offer;

    public function __construct(Car $car, Offer $offer)
    {
        $this->car = $car;
        $this->offer = $offer;
    }

    public function build()
    {
        return $this->subject('تفاصيل عرض سيارتك')
            ->view('emails.car_offer');
    }
}
