<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Metric;


class Unit extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'type',
        'metric_id'
    ];




    public function metric()
    {
        return $this->belongsTo(Metric::class, 'metric_id');
    }

}
