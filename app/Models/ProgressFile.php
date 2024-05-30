<?php

namespace App\Models;

use App\Models\Progress;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressFile extends Model
{
    use HasFactory;
    protected $table = 'progress_files';

    protected $fillable = [
        'progress_id',
        'file_paths', 
    ];


    public function progress()
    {
        return $this->belongsTo(Progress::class);
    }

}
