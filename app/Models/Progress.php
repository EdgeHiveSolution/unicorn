<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KpiMetricMember;
use App\Models\KpiMetric;
use App\Models\Kpi;

class Progress extends Model
{
    use HasFactory;

    protected $table = 'progress';

    protected $fillable = [

        'title',
        'value',
        'notes',
        'current_value',
        'target_value',
        'kpi_id',
        'kpi_metric_id',
        'kpi_metric_member_id'
    ];



    public function kpiMetricMember()
    {
        return $this->belongsTo(KpiMetricMember::class, 'kpi_metric_member_id');
    }



}
