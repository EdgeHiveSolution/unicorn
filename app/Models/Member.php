<?php

namespace App\Models;

use App\Models\Partner;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','photo'

    ];

    public function departments(): BelongsToMany
    {
        return $this->belongsToMany(Department::class);
    }

    // app/Models/Member.php

    public function partners(): BelongsToMany
    {
        return $this->belongsToMany(Partner::class);
    }

    public function kpis(){
        return $this->hasMany(Kpi::class);
    }



}
