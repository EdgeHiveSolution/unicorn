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

    /**
     * Create a new message instance.
     *
     * @param  Member  $member
     * @param  string  $departmentName
     * @param  string  $password
     * @return void
     */
    public function __construct(Member $member, $departmentName, $password)
    {
        $this->member = $member;
        $this->departmentName = $departmentName;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Department Invitation')
                    ->view('mail.member_invitation');
    }
}



