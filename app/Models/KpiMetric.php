<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Progress;
use App\Models\KpiMetricMember;
use App\Models\Kpi;
use App\Models\Member;

class KpiMetric extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'type',
        'response_period',
        'kpi_id',
        'target',
        'timely_value',
        // 'partner_id',
        'on_track_value',
        'off_track_min',
        'off_track_max',
        'at_risk_min',
        'at_risk_max'
    ];



    public function kpi()
    {
        return $this->belongsTo(Kpi::class);
    }


    

   

    public function members()
    {
        return $this->hasMany(Member::class);
    }




    
    public function kpiMetricMembers()
{
    return $this->hasMany(KpiMetricMember::class);
}




 

}
