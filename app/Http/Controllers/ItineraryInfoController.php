<?php

namespace App\Http\Controllers;

use App\HotelMaster;
use App\InclusionMaster;
use App\ItineraryEventInfo;
use App\ItineraryInfo;
use App\PlaceMaster;
use App\Policy;
use App\SentenceMaster;
use App\TourEventInfo;
use App\TourInclusion;
use App\TourInfo;
use App\TourMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

session_start();

class ItineraryInfoController extends Controller
{
    public function create($id)
    {
//        $vehicles = VehicleMaster::getVehicleDropdown();
        $hotels = HotelMaster::getHotelDropdown();
//        $inclusions = InclusionMaster::getInclusionDropdown();
        $places = PlaceMaster::getPlaceDropdown();
//        return view('tour.create_itinerary_content')->with(['id' => $id, 'hotels' => $hotels, 'inclusions' => $inclusions, 'places' => $places]);
        return view('tour.create_day_event')->with(['id' => $id, 'hotels' => $hotels, 'places' => $places]);

    }

    /********************Event Added(Tour Info Details)*************************/
    public function store(Request $request)
    {
//        echo count(request('room_no')) . "<br>";
//        echo count(request('list'));
        $countsentence = count(request('sentence'));
        if (request('list') != null)
            $count = count(request('list'));
        else
            $count = 0;
        if ($countsentence == 0) {
            return Redirect::back()->withInput()->withErrors('Oops...Please select any sentence');
        }
        if ($countsentence > 1) {
            return Redirect::back()->withInput()->withErrors('Oops...You can select only one sentence');
        }
        if (request('hotel_master_id') > 0 & $count == 0) {
            return Redirect::back()->withInput()->withErrors('Oops...Please select any room');
        }

        $tour_info = TourInfo::find(request('tour_info_id'));
        $tour_info->is_event_created = 1;
        $tour_info->hotel_master_id = request('hotel_master_id');
        $sentence_master_arr = request('sentence');
        foreach ($sentence_master_arr as $sentence_id) {
            $tour_info->sentence_master_id = $sentence_id;
        }
        $tour_info->save();
        if ($count > 0) {
            $this->addNewRows($tour_info->id, $count);
        }
        return redirect('tour/' . $tour_info->tour_master_id . '/itinerary');
//        return redirect()->back()->with('message', 'Event has been created successfully...!');
    }
    /********************Event Added(Tour Info Details)*************************/

    /********************Event Info Added*************************/
    public function addNewRows($id, $count)
    {
        $hotel_info_arr = request('list');
        $hotel_room_arr = request('room_no');
        foreach (array_combine($hotel_info_arr, $hotel_room_arr) as $hotel_info_id => $hotel_room_count) {
            $tour_event_info = new TourEventInfo();
            $tour_event_info->tour_info_id = $id;
            $tour_event_info->hotel_master_id = request('hotel_master_id');
            $tour_event_info->hotel_info_id = $hotel_info_id;
            if ($hotel_room_count > 0)
                $tour_event_info->room_count = $hotel_room_count;
            else
                $tour_event_info->room_count = 1;
            $tour_event_info->save();
        }
    }

    /********************Event Info Added*************************/

    public function view_itinerary()
    {
        $tour_info = TourInfo::find(request('data'));
        $tour = TourMaster::find($tour_info->tour_master_id);
        $tour_event_info = TourEventInfo::where(['tour_info_id' => request('data')])->get();
        return view('tour.view_itinerary_event')->with(['tour' => $tour, 'tour_infoes' => $tour_info, 'tour_event_info' => $tour_event_info]);
    }

    public function hotel_information()
    {
//        echo request('data');
        $tour_info = TourInfo::find(request('data'));
//        echo json_encode($tour_info);
        $tour = TourMaster::find($tour_info->tour_master_id);
        $tour_event_info = TourEventInfo::where(['tour_info_id' => request('data')])->get();
        return view('tour.view_hotel_info')->with(['tour' => $tour, 'tour_info' => $tour_info, 'tour_event_info' => $tour_event_info]);
    }

    public function print_itinerary($id)
    {
        $tour = TourMaster::find($id);
        $tour_inclusion = TourInclusion::where(['tour_master_id' => $id])->get();
        $tour_info = TourInfo::where(['tour_master_id' => $id])->get();
        $policy = Policy::where(['is_active' => 1])->get();

        $sql = 'SELECT SUM(v.rate) as vehicle_sum from tour_master t, vehicle_master v WHERE v.id= "' . $tour->vehicle_master_id . '"  AND t.id = "' . $id . '"';
        $vehicle_sum = DB::select($sql);
        if ($vehicle_sum[0]->vehicle_sum == null)
            $vehicle_sum[0]->vehicle_sum = 0;
        else
            $vehicle_sum = DB::select($sql);


        $sql = 'SELECT SUM(h.rate*te.room_count) as total_room from hotel_info h, tour_event_info te, tour_info t WHERE h.id= te.hotel_info_id AND te.tour_info_id = t.id AND t.tour_master_id = "' . $id . '"';
        $total_room = DB::select($sql);
        if ($total_room[0]->total_room == null)
            $total_room[0]->total_room = 0;
        else
            $total_room = DB::select($sql);

        $sql = 'SELECT SUM(rate) as inclusion_sum from inclusion_master WHERE id in (SELECT inclusion_master_id FROM tour_inclusion WHERE tour_master_id = "' . $id . '")';

        $inclusion_sum = DB::select($sql);
        if ($inclusion_sum[0]->inclusion_sum == null)
            $inclusion_sum[0]->inclusion_sum = 0;
        else
            $inclusion_sum = DB::select($sql);


//        echo json_encode($vehicle_sum[0]->vehicle_sum * $tour->total_days);
//        echo json_encode($total_room[0]->total_room + $vehicle_sum[0]->vehicle_sum + $inclusion_sum[0]->inclusion_sum);
        $grand_total = $total_room[0]->total_room + $vehicle_sum[0]->vehicle_sum * $tour->total_days + $inclusion_sum[0]->inclusion_sum;

        $grand_total_c = $grand_total + $grand_total * $tour->lead_master->enquiry_master->enquiry_category->percent / 100;
        return view('tour.print_itinerary')->with(['tour' => $tour, 'tour_info' => $tour_info, 'tour_inclusion' => $tour_inclusion, 'grand_total' => $grand_total_c, 'policy' => $policy]);
    }

    public function removetourinfo($id)
    {
        $tour_info = TourInfo::find($id);
        $tour_info->is_event_created = 0;
        $tour_info->sentence_master_id = null;
        $tour_info->hotel_master_id = null;
        $tour_info->save();
        $tour_event_info = TourEventInfo::where(['tour_info_id' => $id])->get();
        if (count($tour_event_info) > 0) {
            foreach ($tour_event_info as $item) {
                $item->delete();
            }
        }
        return Redirect::back();
    }


    public function remove_event($id)
    {
        $itinerary_info = ItineraryInfo::find($id);
        $tour_info = TourInfo::find($itinerary_info->tour_info_id);
        $tour_info->is_event_created = 0;
        $tour_info->save();
        $itinerary_event_info = ItineraryEventInfo::where(['itinerary_info_id' => $id])->get();
        if (count($itinerary_event_info) > 0) {
            foreach ($itinerary_event_info as $item) {
                $item->delete();
            }
        }
        $itinerary_info->delete();
        return Redirect::back();
    }

    public function autoComplete(Request $request)
    {
        $items = ItineraryInfo::getpickup($request->term);
        return response()->json($items);
    }

    public function transfer_search(Request $request)
    {
        $items = ItineraryInfo::transferto($request->term);
        return response()->json($items);
    }


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
        $tour->is_active = 0;
        $tour->save();
        return redirect('tour');
    }

    public
    function getRoomList()
    {
        $List = HotelInfo::where(['is_active' => 1, 'hotel_master_id' => request('data')])->get();
        return view('tour.get_hotel_room_info')->with('lists', $List);
    }

    public function getSentenceList()
    {
//        echo request('data1');
        $List = SentenceMaster::where(['is_active' => 1, 'start_location_id' => request('data1'), 'end_location_id' => request('data2')])->get();
//        echo json_encode($List);
        return view('tour.get_sentence_list')->with('lists', $List);
    }
}
