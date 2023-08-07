<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Progress;
use App\Models\KpiMetricMember;

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
    

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function members()
    {
        return $this->hasMany(Members::class);
    }




    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    
    public function kpiMetricMembers()
{
    return $this->hasMany(KpiMetricMember::class);
}




 

}
