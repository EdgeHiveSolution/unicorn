<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;



    class MemberInvitation extends Mailable
    {
        use Queueable, SerializesModels;
    
        public $member;
        public $departmentName;
        public $password;
        public $actionType;
        public $registrationLink; // New property to hold the registration link
        public $loginLink;

    
        /**
         * Create a new message instance.
         *
         * @param  Member|null  $member (null for registration, provided for login)
         * @param  string  $departmentName
         * @param  string|null  $password (null for registration, provided for login)
         * @param  string  $actionType (can be 'login' or 'register')
         * @param  string|null  $registrationLink (null for login, provided for registration)
         * @param  string|null  $loginLink (null for registration, provided for login)


         * @return void
         */
        public function __construct(?Member $member, $departmentName, $password = null, $actionType, $registrationLink = null,  $loginLink = null)
        {
            $this->member = $member;
            $this->departmentName = $departmentName;
            $this->password = $password;
            $this->actionType = $actionType;
            $this->registrationLink = $registrationLink; // Assign the registration link to the property
            $this->loginLink = $loginLink; // Assign the login link to the property


        }
    
        /**
         * Build the message.
         *
         * @return $this
         */
        public function build()
      {
        Log::info('Department Name: ' . $this->departmentName);

        $url = ($this->actionType === 'login') ? $this->loginLink : $this->registrationLink;

        return $this->subject('Department Invitation')
            ->view('mail.member_invitation', [
                'url' => $url,
                'departmentName' => $this->departmentName,
                'member' => $this->member, // Pass the member to the email template
                'password' => $this->password, // Pass the password to the email template
                'actionType' => $this->actionType, // Pass the actionType to the email template
            ]);
    }


    }
    


