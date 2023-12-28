<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class HomeBanner extends Model
{
    use HasFactory;

    protected $table = 'home_banners';

    protected $guarded = [];

    public function getCreator(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
