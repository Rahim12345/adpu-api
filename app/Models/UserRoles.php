<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRoles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $guarded = [];

    public function getRole(): HasOne
    {
        return $this->hasOne(Role::class,'id','role_id');
    }
}
