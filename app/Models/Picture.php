<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'restaurant_id', 'user_id'
    ];

    /**
     * Get the User associated with this review.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
