<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;
use App\Models\KpiMetric;



class Metric extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit',

    ];

    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function kpiMetric()
    {
        return $this->hasOne(KpiMetric::class);
    }

}
