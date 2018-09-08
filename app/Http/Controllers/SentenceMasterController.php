<?php

namespace App\Http\Controllers;

use App\PlaceMaster;
use App\SentenceMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SentenceMasterController extends Controller
{
    public function index()
    {
        return view('sentence.view_sentence')->with('sentences', SentenceMaster::getActiveSentenceMaster());
    }

    public function create()
    {
        $places = PlaceMaster::getPlaceDropdown();
        return view('sentence.create_sentence')->with(['places' => $places]);
    }

    public function store(Request $request)
    {
        $sentence = new SentenceMaster();
        $sentence->start_location_id = request('start_location_id');
        $sentence->end_location_id = request('end_location_id');
        $sentence->sentence = request('sentence');
        $sentence->save();
        return redirect()->back()->with('message', 'Record has been created successfully...!');
    }

    public function edit($id)
    {
        $sentence = SentenceMaster::find($id);
        $places = PlaceMaster::getPlaceDropdown();
        return view('sentence.edit_sentence')->with(['sentence' => $sentence, 'places' => $places]);
    }

    public function update($id, Request $request)
    {

        $sentence = SentenceMaster::find($id);
        $sentence->start_location_id = request('start_location_id');
        $sentence->end_location_id = request('end_location_id');
        $sentence->sentence = request('sentence');
        $sentence->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $sentence = SentenceMaster::find($id);
        $sentence->is_active = 0;
        $sentence->save();
        return redirect('sentence');
    }
}
