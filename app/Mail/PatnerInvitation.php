<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PatnerInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $password;
    public $actionType;

    /**
     * Create a new message instance.
     *
     * @param  Member|null  $member (null for registration, provided for login)
     * @param  string|null  $password (null for registration, provided for login)
     * @param  string  $actionType (can be 'login' or 'register')
     * @return void
     */
    public function __construct(?Member $member, ?string $password, string $actionType)
    {
        $this->member = $member;
        $this->password = $password;
        $this->actionType = $actionType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = ($this->actionType === 'login') ? url('/') : url('/register');

        return $this->subject('Partner Invitation')
            ->view('mail.partner_invitation', ['url' => $url]);
    }
}
