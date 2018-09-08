<?php

namespace App\Http\Controllers;

use App\VehicleMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VehicleMasterController extends Controller
{
    public function index()
    {
        return view('vehicle.view_vehicle')->with('vehicles', VehicleMaster::getActiveVehicleMaster());
    }

    public function create()
    {
        return view('vehicle.create_vehicle');
    }

    public function store(Request $request)
    {
        $vehicle = new VehicleMaster();
        $vehicle->vehicle_name = request('vehicle_name');
        $vehicle->seat = request('seat');
        $vehicle->rate = request('rate');
        $vehicle->save();
        return redirect('vehicle');
    }

    public function edit($id)
    {
        $vehicle = VehicleMaster::find($id);
        return view('vehicle.edit_vehicle')->with(['vehicle' => $vehicle]);
    }

    public function update($id, Request $request)
    {

        $vehicle = VehicleMaster::find($id);
        $vehicle->vehicle_name = request('vehicle_name');
        $vehicle->seat = request('seat');
        $vehicle->rate = request('rate');
        $vehicle->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $vehicle = VehicleMaster::find($id);
        if ($vehicle->is_booked == 1) {
            return Redirect::back()->withInput()->withErrors('Oops...Vehicle is already booked...can not be delete right now');
        }
        $vehicle->delete();
        return redirect('vehicle');
    }

//
    public function booked($id)
    {
        $vehicle = VehicleMaster::find($id);
        $vehicle->is_booked = 1;
        $vehicle->save();
        return redirect('vehicle');
    }

    public function available($id)
    {
        $vehicle = VehicleMaster::find($id);
        $vehicle->is_booked = 0;
        $vehicle->save();
        return redirect('vehicle');
    }
}
