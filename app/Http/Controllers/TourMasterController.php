<?php

namespace App\Http\Controllers;

use App\InclusionMaster;
use App\Model\LeadMaster;
use App\TourEventInfo;
use App\TourInclusion;
use App\TourInfo;
use App\TourMaster;
use App\VehicleMaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TourMasterController extends Controller
{
    public function index()
    {
        return view('tour.view_tour')->with('tours', TourMaster::getActiveTourMaster());
    }

    public function create($id)
    {
        $leads = LeadMaster::getLeadDropdown();
        if ($id > 0) {
            $enq_info = LeadMaster::find($id);
//            echo json_encode($enq_info->enquiry_master->tour_end_date);
            return view('tour.create_tour')->with(['leads' => $leads, 'lead_id' => $id, 'enq_info' => $enq_info]);
        } else {
            return view('tour.create_tour')->with(['leads' => $leads, 'lead_id' => $id, 'enq_info' => null]);
        }
    }

    public function store(Request $request)
    {
        if (request('lead_master_id') == 0) {
            return Redirect::back()->withInput()->withErrors('Please select any lead');
        }
//        $validation = Validator::make($request->all(), [
//            'tour_image' => 'required|image|mimes:jpeg,png|min:1|max:2500',
//        ]);
//
//        // Check if it fails //
//        if ($validation->fails()) {
//            return redirect()->back()->withInput()
//                ->with('errors', $validation->errors());
//        }

        $lead = LeadMaster::find(request('lead_master_id'));
        $lead->is_itinerary_created = 1;
        $lead->save();

        $tour = new TourMaster();
        $tour->lead_master_id = request('lead_master_id');
        $tour->tour_name = request('tour_name');
        $start = Carbon::parse(request('start_date'));
        $end = Carbon::parse(request('end_date'));
        $tour->total_days = $start->diffInDays($end) + 1;
        $tour->start_date = Carbon::parse(request('start_date'))->format('Y-m-d');
        $tour->end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
        $file = request('tour_image');
        if (request('tour_image') != null) {
            $destination_path = 'tours/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $tour->tour_image = $destination_path . $filename;
        }

        $tour->save();
        $this->addNewRows($tour->id, $tour->total_days);
        return redirect('tour/' . $tour->id . '/itinerary');
    }

    public function addNewRows($id, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            $tour_info = new TourInfo();
            $tour_info->tour_master_id = $id;
            $tour_info->date = Carbon::parse(request('start_date'))->addDays($i);
            $tour_info->save();
        }
    }

    public function edit($id)
    {
        $tour = TourMaster::find($id);
        return view('tour.edit_tour')->with(['tour' => $tour]);
    }

    public function create_planning($id)
    {
        $tour = TourMaster::find($id);
        $tour_info = TourInfo::where(['tour_master_id' => $id])->get();
//        echo json_encode($tour_info);
        return view('tour.create_planning')->with(['tour' => $tour, 'tour_info' => $tour_info]);
//        return view('tour.create_itinerary')->with(['tour' => $tour, 'tour_info' => $tour_info]);
    }

    public function create_itinerary($id)
    {
        $tour = TourMaster::find($id);

        $tour_info = TourInfo::where(['tour_master_id' => $id])->get();
        $itinerary_info_arr = array();
        foreach ($tour_info as $info_id) {
            $itinerary_info_arr[] = TourEventInfo::where(['tour_info_id' => $info_id->id])->get();
        }


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

        $grand_total = $total_room[0]->total_room + $vehicle_sum[0]->vehicle_sum * $tour->total_days + $inclusion_sum[0]->inclusion_sum;

//        echo json_encode($itinerary_info_arr);
//        return view('tour.create_planning')->with(['tour' => $tour, 'tour_info' => $tour_info]);
        return view('tour.create_itinerary')->with(['tour' => $tour, 'tour_info' => $tour_info, 'itinerary_info' => $itinerary_info_arr, 'grand_total' => $grand_total]);
    }

    public function create_itinerary_by_lead($id)
    {
        $tour = TourMaster::where(['lead_master_id' => $id])->first();
        $tour_info = TourInfo::where(['tour_master_id' => $tour->id])->get();
        $itinerary_info_arr = array();
        foreach ($tour_info as $info_id) {
            $itinerary_info_arr[] = TourEventInfo::where(['tour_info_id' => $info_id->id])->get();
        }


        $sql = 'SELECT SUM(v.rate) as vehicle_sum from tour_master t, vehicle_master v WHERE v.id= "' . $tour->vehicle_master_id . '"  AND t.id = "' . $tour->id . '"';
        $vehicle_sum = DB::select($sql);
        if ($vehicle_sum[0]->vehicle_sum == null)
            $vehicle_sum[0]->vehicle_sum = 0;
        else
            $vehicle_sum = DB::select($sql);


        $sql = 'SELECT SUM(h.rate*te.room_count) as total_room from hotel_info h, tour_event_info te, tour_info t WHERE h.id= te.hotel_info_id AND te.tour_info_id = t.id AND t.tour_master_id = "' . $tour->id . '"';
        $total_room = DB::select($sql);
        if ($total_room[0]->total_room == null)
            $total_room[0]->total_room = 0;
        else
            $total_room = DB::select($sql);

        $sql = 'SELECT SUM(rate) as inclusion_sum from inclusion_master WHERE id in (SELECT inclusion_master_id FROM tour_inclusion WHERE tour_master_id = "' . $tour->id . '")';

        $inclusion_sum = DB::select($sql);
        if ($inclusion_sum[0]->inclusion_sum == null)
            $inclusion_sum[0]->inclusion_sum = 0;
        else
            $inclusion_sum = DB::select($sql);

        $grand_total = $total_room[0]->total_room + $vehicle_sum[0]->vehicle_sum * $tour->total_days + $inclusion_sum[0]->inclusion_sum;

//        echo json_encode($itinerary_info_arr);
//        return view('tour.create_planning')->with(['tour' => $tour, 'tour_info' => $tour_info]);
        return view('tour.create_itinerary')->with(['tour' => $tour, 'tour_info' => $tour_info, 'itinerary_info' => $itinerary_info_arr, 'grand_total' => $grand_total]);
    }

    /*******************************Inclusion Added Tour****************************************************/
    public function add_inclusion($id)
    {
        $tour = TourMaster::find($id);
        $inclusions = InclusionMaster::getActiveInclusionMaster();
        return view('tour.add_inclusion')->with(['tour' => $tour, 'inclusions' => $inclusions]);
    }

    public function view_inclusion()
    {
        $inclusions = TourInclusion::where(['tour_master_id' => request('data')])->get();
        return view('tour.view_inclusion')->with(['inclusions' => $inclusions]);
    }

    public function store_inclusion($id)
    {
        $count = count(request('inclusion'));
        if ($count == 0) {
            return Redirect::back()->withInput()->withErrors('Oops...Please select any inclusion');
        }
        $tour_master = TourMaster::find($id);
        $tour_master->is_inclusion_added = 1;
        $tour_master->save();
        $tour = new TourInclusion();
        $tour->tour_master_id = request('tour_master_id');
        $tour->save();
        $this->addInclusion($id, $count);
//        return redirect('tour/' . $tour->id . '/itinerary');
        return Redirect::back();
    }

    public function addInclusion($id, $count)
    {
        $inclusion_info_arr = request('inclusion');
        foreach ($inclusion_info_arr as $inclusion_master_id) {
            $tour = new TourInclusion();
            $tour->tour_master_id = $id;
            $tour->inclusion_master_id = $inclusion_master_id;
            $tour->save();
        }
    }

    public function removeInclusion($id)
    {
        $tour_master = TourMaster::find($id);
        $tour_master->is_inclusion_added = 0;
        $tour_master->save();
        $tour_inclusion = TourInclusion::where(['tour_master_id' => $id])->get();
        foreach ($tour_inclusion as $item) {
            $item->delete();
        }
        return Redirect::back();
    }
    /*******************************Inclusion Added Tour****************************************************/

    /*******************************Vehicle Added Tour****************************************************/
    public function add_vehicle($id)
    {
        $tour = TourMaster::find($id);
        $vehicles = VehicleMaster::getVehicleDropdown();
        return view('tour.add_vehicle')->with(['tour' => $tour, 'vehicles' => $vehicles]);
    }

    public function view_vehicle()
    {
        $tour = TourMaster::find(request('data'));
        return view('tour.view_vehicle')->with(['tour' => $tour]);
    }

    public function remove_vehicle($id)
    {
        $tour = TourMaster::find($id);
        $tour->vehicle_master_id = null;
        $tour->vehicle_comment = null;
        $tour->save();
        return Redirect::back();
    }

    public function store_vehicle($id)
    {
        $tour = TourMaster::find($id);
        $tour->vehicle_master_id = request('vehicle_master_id');
        $tour->vehicle_comment = request('vehicle_comment');
        $tour->save();
        return Redirect::back();
    }

    /*******************************Vehicle Added Tour****************************************************/

    public function update($id, Request $request)
    {
//        $validation = Validator::make($request->all(), [
//            'tour_image' => 'required|image|mimes:jpeg,png|min:1|max:2500',
//        ]);

        // Check if it fails //
//        if ($validation->fails()) {
//            return redirect()->back()->withInput()
//                ->with('errors', $validation->errors());
//        }
        $tour = TourMaster::find($id);
        $tour->tour_name = request('tour_name');
        $start = Carbon::parse(request('start_date'));
        $end = Carbon::parse(request('end_date'));
        $tour->total_days = $start->diffInDays($end) + 1;
        $tour->start_date = Carbon::parse(request('start_date'))->format('Y-m-d');
        $tour->end_date = Carbon::parse(request('end_date'))->format('Y-m-d');
        $file = request('tour_image');
        if (request('tour_image') != null) {
            $destination_path = 'assets/tours/';
            $filename = str_random(6) . '_' . $file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $tour->tour_image = $destination_path . $filename;
        }
        $tour->save();
        return Redirect::back();
    }

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
    function add_days($tid)
    {
        $tour = TourMaster::find($tid);
        $tour->total_days += 1;
        $tour->end_date = Carbon::parse($tour->end_date)->addDay(1)->format('Y-m-d');
        $tour->save();

        $tour_info = new TourInfo();
        $tour_info->tour_master_id = $tid;
        $tour_info->date = $tour->end_date;
        $tour_info->save();

        return redirect('tour/' . $tid . '/itinerary')->with('message', 'Day has been added in tour...!');
    }

    public
    function remove_days($tid)
    {
        $tour = TourMaster::find($tid);
        $tour->total_days -= 1;
        $tour->end_date = Carbon::parse($tour->end_date)->addDay(-1)->format('Y-m-d');
        $tour_info = TourInfo::where(['date' => $tour->end_date, 'tour_master_id' => $tid])->delete();
        $tour->save();
        return redirect('tour/' . $tid . '/itinerary')->with('message', 'Day has been deleted in tour...!');
    }

}
