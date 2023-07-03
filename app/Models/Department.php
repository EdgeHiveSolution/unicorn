<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email','about'

    ];

    public function members(){
        return $this->hasMany(Member::class, 'department_id');
    }
}
