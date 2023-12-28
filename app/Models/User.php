<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'avatar',
        'email',
        'password',
        'deleted',
        'blocked',
    ];

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

    public function getRole(): HasOne
    {
        return $this->hasOne(Role::class,'id','role_id');
    }

    public function getUnits(): HasMany
    {
        return $this->hasMany(Unit::class,'creator_id','id');
    }

    public function getPermissionLinks(): \Illuminate\Support\Collection
    {
        return $this->hasMany(Permission::class,'user_id','id')->pluck('route_name');
    }

    public function getUserRole(): HasOne
    {
        return $this->hasOne(UserRoles::class,'user_id','id');
    }
}
