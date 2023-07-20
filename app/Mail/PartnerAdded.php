<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\PartnerDetail;

class PartnerAdded extends Mailable
{
    use Queueable, SerializesModels;

    public $partnerDetail;

    /**
     * Create a new message instance.
     */
    public function __construct(PartnerDetail $partnerDetail)
    {
        $this->partnerDetail = $partnerDetail;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Invitation and Login Details')
                    ->view('mail.partner_added');
    }
}

