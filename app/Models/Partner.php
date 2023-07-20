<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'website', 'logo', 'country_id', 'business_type', 'description', 'documents', 'about',

    ];


    public function members()
    {
        return $this->belongsToMany(Member::class, 'member_partner', 'partner_id', 'member_id')
        ->withPivot('role');
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function kpis(){
        return $this->hasMany(Kpi::class);
    }

}
