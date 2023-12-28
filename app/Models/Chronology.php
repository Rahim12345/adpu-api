<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chronology extends Model
{
    use HasFactory;

    protected $table = 'chronologies';

    protected $guarded = [];
}
