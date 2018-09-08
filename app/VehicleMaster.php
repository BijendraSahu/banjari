<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleMaster extends Model
{
    protected $table = 'vehicle_master';
    public $timestamps = false;

    public function scopeGetActiveVehicleMaster($query)
    {
        return $query->get();
    }

    public
    function scopegetVehicleDropdown()
    {
        $vehicles = VehicleMaster::where(['is_active' => '1'])->get();
        $arr[0] = "SELECT";
        foreach ($vehicles as $vehicle) {
            $arr[$vehicle->id] = $vehicle->vehicle_name . " " . $vehicle->seat . " " . $vehicle->rate;
        }
        return $arr;
    }
}
