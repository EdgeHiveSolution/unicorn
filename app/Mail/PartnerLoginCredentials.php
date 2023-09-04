<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Partner;


class PartnerLoginCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $loginLink;
    public $password;
    public $partner;

    /**
     * Create a new message instance.
     *
     * @param Partner $partner
     * @param string $loginLink
     * @param string $password
     */
    public function __construct(Partner $partner, $loginLink, $password)
    {
        $this->partner = $partner;
        $this->loginLink = $loginLink;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Partner Login Credentials')
            ->view('mail.partner-login-credentials'); // Use the appropriate email view name
    }

}