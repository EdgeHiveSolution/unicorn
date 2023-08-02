<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MemberPartner;

class KpiOwner extends Model

{

    use HasFactory;


    public function members()
    
    {
        return $this->belongsToMany(MemberPartner::class, 'member_partner', 'kpi_id', 'member_id')
            ->withTimestamps();
    }


}
