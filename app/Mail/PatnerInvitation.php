<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class PatnerInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $member;
    public $password;
    public $actionType;
    public $partnerName;
    public $registrationLink;
    public $loginLink;


    /**
     * Create a new message instance.
     *
     * @param  Member|null  $member (null for registration, provided for login)
     * @param  string|null  $password (null for registration, provided for login)
     * @param  string  $actionType (can be 'login' or 'register')
     * @param  string  $partnerName (name of the partner/department)
     * @param  string|null  $registrationLink (null for login, provided for registration)
     * @param  string|null  $loginLink (null for registration, provided for login)

     * @return void
     */
    public function __construct(?Member $member, $partnerName, $password = null, $actionType, $registrationLink = null,  $loginLink = null)
    {
        $this->member = $member;
        $this->password = $password;
        $this->actionType = $actionType;
        $this->partnerName = $partnerName;
        $this->registrationLink = $registrationLink; // Assign the registration link to the property
        $this->loginLink = $loginLink;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        Log::info('Partner Name: ' . $this->partnerName);


        $url = ($this->actionType === 'login') ? $this->loginLink : $this->registrationLink;
        
        return $this->subject('Partner Invitation')
            ->view('mail.patner_invitation', [
                'url' => $url,
            ]);
    }
}
