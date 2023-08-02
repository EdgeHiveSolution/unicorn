<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;



class Metric extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'unit',

    ];




    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }


}
