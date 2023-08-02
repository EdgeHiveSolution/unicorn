<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\KpiMetric;
use App\Models\Department;
use App\Models\Member;
use App\Models\Kpi;
use App\Models\Country;
use App\Models\DepartmentPartner;
use App\Models\MemberPartner;




class Partner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'website', 'logo', 'country_id', 'business_type','is_active','password', 'description', 'documents', 'about',

    ];


    // public function members()
    // {
    //     return $this->belongsToMany(Member::class, 'member_partner', 'partner_id', 'member_id')
    //     ->withPivot('role');
    // }

    /**
     * The departments that belong to the partner.
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'department_partner')
              ->using(DepartmentPartner::class)
              ->withPivot('department_id', 'partner_id', 'role')
              ->withTimestamps();
    }


    public function members()
{
    return $this->belongsToMany(Member::class, 'member_partner')
        ->using(MemberPartner::class)
        ->withPivot('department_id', 'role', 'member_id')
        ->withTimestamps();
}

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function kpis()
    {
        return $this->hasMany(Kpi::class);
    }

    public function kpiMetrics()
    {
        return $this->hasMany(KpiMetric::class);
    }

}
