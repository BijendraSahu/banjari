<?php

namespace App\Http\Controllers;

use App\HotelInfo;
use App\HotelMaster;
use App\TourEventInfo;
use App\TourInfo;
use App\TourInfoDetails;
use App\TourMaster;
use App\VehicleMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TourPlanningController extends Controller
{
//    public function index()
//    {
//        return view('tour.view_tour')->with('tours', TourMaster::getActiveTourMaster());
//    }

    public function create($id)
    {
        $vehicles = VehicleMaster::getVehicleDropdown();
        $hotels = HotelMaster::getHotelDropdown();
        return view('tour.create_event')->with(['id' => $id, 'vehicles' => $vehicles, 'hotels' => $hotels]);
    }

    /********************Event Added(Tour Info Details)*************************/
    public function store(Request $request)
    {
        $count = count(request('list'));
//        if ($count == 0) {
//            return Redirect::back()->withInput()->withErrors('Oops...Please select hotel rooms');
//        }
        $info = new TourInfoDetails();
        $info->tour_info_id = request('tour_info_id');
        $info->vehicle_master_id = request('vehicle_master_id');
        if (request('hotel_master_id') > 0)
            $info->hotel_master_id = request('hotel_master_id');
        $info->category = request('category');
        $info->type = request('type');
        $info->time = request('time');
        $info->title = request('title');
        $info->notes = request('notes');
        $info->duration = request('duration');
        $info->save();


        if ($count > 0) {
            $this->addNewRows($info->id, $count);
        }
        $tour_info = TourInfo::find(request('tour_info_id'));
        return redirect('tour/' . $tour_info->tour_master_id . '/planning');
//        return redirect()->back()->with('message', 'Event has been created successfully...!');
    }
    /********************Event Added(Tour Info Details)*************************/

    /********************Event Info Added*************************/
    public function addNewRows($id, $count)
    {
        $hotel_info_arr = request('list');
        foreach ($hotel_info_arr as $hotel_info_id) {
            $tour_event_info = new TourEventInfo();
            $tour_event_info->tour_info_details_id = $id;
            $tour_event_info->tour_info_id = request('tour_info_id');
            $tour_event_info->hotel_master_id = request('hotel_master_id');;
            $tour_event_info->hotel_info_id = $hotel_info_id;
            $tour_event_info->save();
        }
    }

    /********************Event Info Added*************************/

    public function view_event()
    {
        $tour_info = TourInfo::find(request('data'));
        $tour = TourMaster::find($tour_info->tour_master_id);
        $tour_info_details = TourInfoDetails::where(['tour_info_id' => request('data')])->get();
        $result = array();
        foreach ($tour_info_details as $tour_info_detail) {
            if (isset($tour_info_detail->hotel_master_id)) {
                $result[] = TourEventInfo::where(['tour_info_details_id' => $tour_info_detail->id, 'hotel_master_id' => $tour_info_detail->hotel_master_id])->get();
            }
        }
//        echo json_encode($result);
        return view('tour.view_event')->with(['tour' => $tour, 'tour_info' => $tour_info, 'tour_info_details' => $tour_info_details, 'tour_event' => $result]);
    }

//    public function view_hotel_info()
//    {
//        $tour_event_info = TourEventInfo::where(['tour_info_details_id' => request('data')])->get();
//        return view('tour.view_hotel_info')->with(['tour_event_info' => $tour_event_info]);
//    }

//    public function create_planning($id)
//    {
//        $tour = TourMaster::find($id);
//        $tour_info = TourInfo::where(['tour_master_id' => $id])->get();
////        echo json_encode($tour_info);
//        return view('tour.create_planning')->with(['tour' => $tour, 'tour_info' => $tour_info]);
//    }

//    public function update($id, Request $request)
//    {
//
//        $tour = TourMaster::find($id);
//        $tour->tour_name = request('tour_name');
//        $start = Carbon::parse(request('start_date'));
//        $end = Carbon::parse(request('end_date'));
//        $tour->total_days = $start->diffInDays($end) + 1;
//        $tour->start_date = Carbon::parse(request('start_date'))->format('Y-m-d');
//        $tour->end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
//        $tour->save();
//        $tour->save();
//        return Redirect::back();
//    }

    public
    function destroy($id)
    {
        $tour = TourMaster::find($id);
//        if ($tour->is_booked == 1) {
//            return Redirect::back()->withInput()->withErrors('Oops...tour is already booked...can not be delete right now');
//        }
        $tour->delete();
        return redirect('tour');
    }

//    public function getRoom()
//    {
//        $result = array();
//        $List = HotelInfo::where(['is_active' => 1, 'hotel_master_id' => request('data')])->get(['id', 'room_type']);
//        $result = ['arr' => $List];
//        return json_encode($result);
//
//    }

    public
    function getRoomList()
    {
        $List = HotelInfo::where(['is_active' => 1, 'hotel_master_id' => request('data')])->get();
        return view('tour.get_hotel_room_info')->with('lists', $List);
    }

}
