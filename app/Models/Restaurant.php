<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $casts = [
        'opening_time' => 'array',
    ];
}