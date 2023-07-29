<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PatnerInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $password;
    public $actionType;
    public $partnerName;

    /**
     * Create a new message instance.
     *
     * @param  Member|null  $member (null for registration, provided for login)
     * @param  string|null  $password (null for registration, provided for login)
     * @param  string  $actionType (can be 'login' or 'register')
     * @param  string  $partnerName (name of the partner/department)
     * @return void
     */
    public function __construct(?Member $member, ?string $password, string $actionType, string $partnerName)
    {
        $this->member = $member;
        $this->password = $password;
        $this->actionType = $actionType;
        $this->partnerName = $partnerName;
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
            ->view('mail.patner_invitation', ['url' => $url, 'partnerName' => $this->partnerName]);
    }
}
