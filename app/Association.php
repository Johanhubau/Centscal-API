<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    /**
     * Get the user associated with the association.
     */

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the events that the association organises
     */

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
