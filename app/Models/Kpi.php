<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

}
