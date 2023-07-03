<?php

namespace App\Models;

use App\Models\Partner;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email','department_id','partner_id'

    ];

    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }


}
