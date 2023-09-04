<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Progress;
use App\Models\KpiMetric;
use App\Models\Partner;
use App\Models\Member;
use App\Models\KpiMember;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'kpiOwner_id',
        'partner_id',
        'review_period_range'
    ];



    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }


    
   

    public function kpiOwner()
    {
        return $this->belongsTo(KpiOwner::class);
    }




    public function kpiMetrics()
    {
        return $this->hasMany(KpiMetric::class);
    }


    public function members()
{
    return $this->belongsToMany(Member::class, 'kpi_member')
        ->using(KpiMember::class)
        ->withPivot('kpi_id', 'member_id') 
        ->withTimestamps();
}



    
    // public function progress()
    // {
    //     return $this->hasMany(Progress::class);
    // }


}
