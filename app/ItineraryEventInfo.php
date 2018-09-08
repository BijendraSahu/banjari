<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItineraryEventInfo extends Model
{
    protected $table = 'itinerary_event_info';
    public $timestamps = false;

    public function hotel_info()
    {
        return $this->belongsTo('App\HotelInfo');
    }
}
