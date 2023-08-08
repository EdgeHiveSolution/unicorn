<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserRole;
use App\Models\Member;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SUPERADMIN = 'Admin';
    const ROLE_MEMBER = 'Member';
    const ROLE_PARTNER = 'Partner';
    const MEMBER_PARTNER = 'Member_partner';
   
    



    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     * 
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'is_active',
        'password',
    ];

    public function isAdmin()
    {
        return $this->userrole && $this->userrole->name === 'admin';
    }

    public function userrole()

    {
        return $this->belongsTo(UserRole::class, 'user_role_id');
    }

    protected $with = ['member.kpiMetricMembers.progress'];

    public function member()
    {
        return $this->hasOne(Member::class,'user_id');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
