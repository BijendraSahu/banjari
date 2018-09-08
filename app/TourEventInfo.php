<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourEventInfo extends Model
{
    protected $table = 'tour_event_info';
    public $timestamps = false;

    public
    function hotel_info()
    {
        return $this->belongsTo('App\HotelInfo');
    }
    public function hotel_master()
    {
        return $this->belongsTo('App\HotelMaster');
    }
}
