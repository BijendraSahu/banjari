<?php

namespace App\Http\Controllers;

use App\InclusionMaster;
use App\PlaceMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InclusionMasterController extends Controller
{
    public function index()
    {
        return view('inclusion.view_inclusion')->with('inclusions', InclusionMaster::getActiveInclusionMaster());
    }

    public function create()
    {
        $places = PlaceMaster::getPlaceDropdown();
        return view('inclusion.create_inclusion')->with(['places' => $places]);
    }

    public function store(Request $request)
    {
        $inclusion = new InclusionMaster();
        $inclusion->place_master_id = request('place_master_id');
        $inclusion->name = request('name');
        $inclusion->rate = request('rate');
        $inclusion->description = request('description');
        $inclusion->save();
        return redirect('inclusion');
    }

    public function edit($id)
    {
        $inclusion = InclusionMaster::find($id);
        $places = PlaceMaster::getPlaceDropdown();
        return view('inclusion.edit_inclusion')->with(['inclusion' => $inclusion, 'places' => $places]);
    }

    public function update($id, Request $request)
    {

        $inclusion = InclusionMaster::find($id);
        $inclusion->place_master_id = request('place_master_id');
        $inclusion->name = request('name');
        $inclusion->rate = request('rate');
        $inclusion->description = request('description');
        $inclusion->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $inclusion = InclusionMaster::find($id);
        $inclusion->is_active = 0;
        $inclusion->save();
        return redirect('inclusion');
    }
}
