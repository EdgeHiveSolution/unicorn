<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone', 'email','website','logo','country','business_type','description','documents', 'about'

    ];

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Member::class);
    }

}
