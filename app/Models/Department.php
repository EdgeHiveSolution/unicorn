<?php

namespace App\Models;

use App\Models\Member;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'email','about'

    ];

    public function members(): BelongsToMany
    {
        return $this->belongsToMany(Member::class);
    }

      /**
     * The partners that belong to the department.
     */
    public function partners()
    {
        return $this->belongsToMany(Partner::class, 'member_partner')
            ->withPivot('member_id', 'role')
            ->withTimestamps();
    }

    public function kpis(){
        return $this->hasMany(Kpi::class);
    }
}
