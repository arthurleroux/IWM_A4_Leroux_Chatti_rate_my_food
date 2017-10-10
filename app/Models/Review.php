<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'user_id', 'restaurant_id', 'status', 'price', 'rate'
    ];

    /**
     * Get the User associated with this review.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the Restaurant associated with this review.
     */
    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }
}
