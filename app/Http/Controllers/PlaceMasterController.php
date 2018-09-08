<?php

namespace App\Http\Controllers;

use App\PlaceMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlaceMasterController extends Controller
{
    public function index()
    {
        return view('place.view_place')->with('places', PlaceMaster::getActivePlaceMaster());
    }

    public function create()
    {
        return view('place.create_place');
    }

    public function store(Request $request)
    {
        $place = new PlaceMaster();
        $place->place_name = request('place_name');
        $place->save();
        return redirect('place');
    }

    public function edit($id)
    {
        $place = PlaceMaster::find($id);
        return view('place.edit_place')->with(['place' => $place]);
    }

    public function update($id, Request $request)
    {

        $place = PlaceMaster::find($id);
        $place->place_name = request('place_name');
        $place->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $place = PlaceMaster::find($id);
        $place->is_active = 1;
        return redirect('place');
    }
}
