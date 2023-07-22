<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kpi extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'member_id',
        'partner_id',
        'review_period'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function member()
    {
        return $this->belongsTo(Partner::class);
    }

    public function kpi_metrics()
    {
        return $this->hasMany(Kpi_metric::class);
    }


}
