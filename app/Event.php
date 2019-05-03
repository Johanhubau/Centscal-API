<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
        "title",
        "asso_id",
        "all_day",
        "start",
        "end",
        "url",
        "source"
    ];

    /**
     * Get the association that organises the event
     */

    public function association()
    {
        return $this->belongsTo(Association::class, 'asso_id');
    }

    /**
     * Get the source event of the event
     */

    public function source()
    {
        return $this->belongsTo(Event::class, 'source');
    }
    /**
     * Get the events from this event
     */

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
