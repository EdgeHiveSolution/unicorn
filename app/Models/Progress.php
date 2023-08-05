<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KpiMetric;

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
        'kpi_metric_id'
    ];



    public function kpiMetric()
    {
        return $this->belongsTo(KpiMetric::class);
    }


}
