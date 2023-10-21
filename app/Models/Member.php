<?php

namespace App\Models;

use App\Models\Partner;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\MemberPartner;
use App\Models\User;
use AppModels\UserRole;
use App\Models\DepartmentMember;
use App\Models\KpiMetric;
use App\Models\KpiMetricMember;
use App\Models\KpiMember;
use App\Models\Kpi;
use Illuminate\Database\Eloquent\SoftDeletes;



class Member extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name','email','photo','is_active', 'user_id'
        
    ];


    protected $with = ['departments' , 'kpis.kpiMetrics.kpiMetricMembers.progress'];   

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function userRole()
    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }


      public function departments()
{
    return $this->belongsToMany(Department::class, 'department_member')
         ->using(DepartmentMember::class)
         ->withPivot('department_id', 'member_id')
         ->withTimestamps();
}

    
   
   


    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'member_partner')
            ->using(MemberPartner::class)
            ->withPivot('department_id', 'role', 'member_id')
            ->withTimestamps();
    }       


            
            public function kpiMetricMembers()
        {
            return $this->hasMany(KpiMetricMember::class, 'member_id');
        }



                 public function kpis()
            {
                return $this->belongsToMany(Kpi::class, 'kpi_member')
                    ->using(KpiMember::class)
                    ->withPivot('member_id', 'kpi_id') 
                    ->withTimestamps();
            }


}
