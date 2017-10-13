<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Opening_time extends Model
{
    protected $fillable = [];

    /**
     * Get the User associated with this review.
     */
    public function day()
    {
        return $this->belongsTo('App\Models\Day');
    }

    /**
     * Get the Restaurant associated with this review.
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
