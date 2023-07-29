<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


    class MemberInvitation extends Mailable
    {
        use Queueable, SerializesModels;
    
        public $member;
        public $departmentName;
        public $password;
        public $actionType;
    
        /**
         * Create a new message instance.
         *
         * @param  Member|null  $member (null for registration, provided for login)
         * @param  string  $departmentName
         * @param  string|null  $password (null for registration, provided for login)
         * @param  string  $actionType (can be 'login' or 'register')
         * @return void
         */
        public function __construct(?Member $member, $departmentName, $password = null, $actionType)
        {
            $this->member = $member;
            $this->departmentName = $departmentName;
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
    
            return $this->subject('Department Invitation')
                ->view('mail.member_invitation', ['url' => $url]);
        }
    }
    


