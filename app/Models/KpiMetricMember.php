<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\KpiMetric;
use App\Models\Member;
use App\Models\Progress;


class KpiMetricMember extends Model
{
    use HasFactory;
    
    protected $table = 'kpi_metric_members';

    protected $fillable = ['kpi_metric_id', 'member_id', 'target', 'timely_value'];

            public function kpiMetric()
        {
            return $this->belongsTo(KpiMetric::class);
        }


                    public function member()
            {
                return $this->belongsTo(Member::class);
            }


            public function progress()
            {
                return $this->hasOne(Progress::class, 'kpi_metric_member_id');
            }
}

