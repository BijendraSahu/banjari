<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ItineraryInfo extends Model
{
    protected $table = 'itinerary_info';
    public $timestamps = false;

    public
    function hotel_master()
    {
        return $this->belongsTo('App\HotelMaster');
    }

    public
    function place_master1()
    {
        return $this->belongsTo('App\PlaceMaster', 'pickup_from_id');
    }

    public
    function place_master2()
    {
        return $this->belongsTo('App\PlaceMaster', 'transfer_to_id');
    }

    public
    function inclusion_master()
    {
        return $this->belongsTo('App\InclusionMaster', 'full_day_inclusion_id');
    }

    public
    function place_master3()
    {
        return $this->belongsTo('App\PlaceMaster', 'night_stay_id');
    }

    public static function getpickup($key_term)
    {
        $results = array();
        $items = DB::table('itinerary_info')->where('pickup_from_text', 'like', '%' . $key_term . '%')->distinct('pickup_from_text')->take(8)->get();
        foreach ($items as $item)
            $results[] = ['label' => $item->pickup_from_text, 'id' => $item->id, 'pickup_from_text' => $item->pickup_from_text];
        return $results;
//        if (count($results))
//            return $results;
//        else
//            return ['value' => 'No Result Found', 'id' => ''];
    }

    public static function transferto($key_term)
    {
        $results = array();
        $items = DB::table('itinerary_info')->where('transfer_to_text', 'like', '%' . $key_term . '%')->distinct('transfer_to_text')->take(8)->get();
        foreach ($items as $item)
            $results[] = ['label' => $item->transfer_to_text, 'id' => $item->id, 'transfer_to_text' => $item->transfer_to_text];
        return $results;
    }
}
