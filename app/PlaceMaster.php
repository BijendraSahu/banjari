<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaceMaster extends Model
{
    protected $table = 'place_master';
    public $timestamps = false;

    public function scopeGetActivePlaceMaster($query)
    {
        return $query->get();
    }

    public
    function scopegetPlaceDropdown()
    {
        $places = PlaceMaster::where(['is_active' => '1'])->get(['id', 'place_name']);
        $arr[0] = "SELECT";
        foreach ($places as $place) {
            $arr[$place->id] = $place->place_name;
        }
        return $arr;
    }
}
