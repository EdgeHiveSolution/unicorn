<?php

namespace App\Models;


use App\Models\Member;
use App\Models\Partner;
use App\Models\DepartmentMember;
use App\Models\DepartmentPartner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Department extends Model

{
    use HasFactory;

    protected $fillable = [
        'name', 'email','about'

    ];


     public function members()

    {
        return $this->belongsToMany(Member::class, 'department_member')
          ->using(DepartmentMember::class)
          ->withPivot('department_id', 'member_id')
            ->withTimestamps();
    }


    public function partners()

    {
        return $this->belongsToMany(Partner::class, 'department_partner')
            ->using(DepartmentPartner::class)
            ->withPivot('department_id', 'partner_id', 'role')
            ->withTimestamps();
    }
    // public function partners()
    // {
    //     return $this->belongsToMany(Partner::class, 'member_partner')
    //         ->withPivot('member_id', 'role')
    //         ->withTimestamps();
    // }

    public function kpis(){
        return $this->hasMany(Kpi::class);
    }


}
