<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Trip;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $trip;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation de réservation')
                    ->view('emails.reservation_confirmed');
    }
}

