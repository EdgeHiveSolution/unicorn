<?php

namespace App\Mail;

use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class MemberInvitation extends Mailable
{
    use Queueable, SerializesModels;

    public $member;

    /**
     * Create a new message instance.
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('Invitation and Login Details')
                    ->view('mail.member_invitation');
    }
}
