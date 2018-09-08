<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourMaster extends Model
{
    protected $table = 'tour_master';
    public $timestamps = false;

    public function scopeGetActiveTourMaster($query)
    {
        return $query->orderBy('created_time', 'desc')->get();
    }

    public function lead_master()
    {
        return $this->belongsTo('App\Model\LeadMaster');
    }

    public function vehicle_master()
    {
        return $this->belongsTo('App\VehicleMaster');
    }
}
