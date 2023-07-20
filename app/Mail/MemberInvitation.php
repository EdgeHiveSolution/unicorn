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

    /**
     * Create a new message instance.
     *
     * @param  Member  $member
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $department = $this->member->departments->first();

    if ($department) {
        $departmentName = $department->name;
    } else {
        $departmentName = 'Unknown Department';
    }


        return $this->subject('Department Invitation')
                    ->view('mail.member_invitation', compact('departmentName'));
    }
}

