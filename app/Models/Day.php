<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    /**
     * Get the User associated with this review.
     */
    public function opening_days()
    {
        return $this->hasMany('App\Models\Opening_time');
    }
}
