<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourInfoDetails extends Model
{
    protected $table = 'tour_info_details';
    public $timestamps = false;

    public
    function hotel_master()
    {
        return $this->belongsTo('App\HotelMaster');
    }
    public
    function vehicle_master()
    {
        return $this->belongsTo('App\VehicleMaster');
    }
}
