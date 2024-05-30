<?php

namespace App\Models;
use App\Models\Progress;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressChat extends Model
{
    use HasFactory;
    protected $table = 'progress_chat';

    protected $fillable = [
        'progress_id',
        'sender_id',
        // 'recipient_id',
        'message',
    ];

    public function progress()
    {
        return $this->belongsTo(Progress::class, 'progress_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
}
