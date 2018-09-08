<?php

namespace App\Http\Controllers\EnquiryMaster;

use App\EnquiryCategory;
use App\Model\EnquiryMaster;
use App\Model\LeadMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

session_start();

class EnquiryMasterController extends Controller
{
    public function index()
    {
        $enquiry = EnquiryMaster::where(['is_active' => 1, 'is_proceed_to_lead' => '0'])->get();
        return view('LeadManage.EnquiryMaster.index_Enquiry')->with(['enquiry' => $enquiry]);
    }

    public function create()
    {
        $enq_no = EnquiryMaster::GenerateEnquiryNumber();
        $categories = EnquiryCategory::getCategoryDropdown();
        return view('LeadManage.EnquiryMaster.create_Enquiry')->with(['enq_no' => $enq_no, 'categories' => $categories]);
    }

    public function store()
    {
        $en = new EnquiryMaster();
        if (!$en->checkEnqNo(request('enquiry_no'))) {
            return Redirect::back()->withInput()->withErrors('Inquiry no already exists in the system');
        } else {
            $enquiry = new EnquiryMaster();
            $enquiry->enquiry_no = request('enquiry_no');
            $enquiry->full_enquiry_no = request('full_enquiry_no');
//        $enquiry->enquiry_date = Carbon::parse(request('enquiry_date'))->format('Y-m-d');
            $enquiry->name = request('name');
            $enquiry->contact = request('contact');
            $enquiry->email = request('email');
            $enquiry->no_of_person = request('no_of_person');
            $enquiry->no_of_child_upto_5 = request('no_of_child_upto_5');
            $enquiry->no_of_child_above_5 = request('no_of_child_above_5');
            $enquiry->travel_duration = request('travel_duration') . " days";
            $enquiry->travel_date = Carbon::parse(request('travel_date'))->format('Y-m-d');
            $enquiry->tour_end_date = Carbon::parse(request('tour_end_date'))->format('Y-m-d');
//        $enquiry->departure_date = Carbon::parse(request('departure_date'))->format('Y-m-d');
            $enquiry->tour_start_from = request('tour_start_from');
            $enquiry->departure_destination = request('departure_destination');
            $enquiry->current_location = request('current_location');
            $enquiry->any_requirement = request('any_requirement');
            $enquiry->is_proceed_to_lead = 0;
            $enquiry->enquiry_category_id = request('category_id');
            $enquiry->save();
            return redirect('enquiry');
        }
    }

    public function edit($id)
    {
        $enquiry = EnquiryMaster::find($id);
        $categories = EnquiryCategory::getCategoryDropdown();
        return view('LeadManage.EnquiryMaster.edit_Enquiry')->with(['enquiry' => $enquiry, 'categories' => $categories]);
    }

    public function show($id)
    {
        $enquiry = EnquiryMaster::find($id);
        return view('LeadManage.EnquiryMaster.view_enquiry_info')->with(['enquiry' => $enquiry]);
    }

    public function update($id)
    {
        $enquiry = EnquiryMaster::find($id);
//        $enquiry->enquiry_date = Carbon::parse(request('enquiry_date'))->format('Y-m-d');
        $enquiry->name = request('name');
        $enquiry->contact = request('contact');
        $enquiry->email = request('email');
        $enquiry->no_of_person = request('no_of_person');
        $enquiry->no_of_child_upto_5 = request('no_of_child_upto_5');
        $enquiry->no_of_child_above_5 = request('no_of_child_above_5');
        $enquiry->travel_duration = request('travel_duration') . " days";
        $enquiry->travel_date = Carbon::parse(request('travel_date'))->format('Y-m-d');
        $enquiry->tour_end_date = Carbon::parse(request('tour_end_date'))->format('Y-m-d');
//        $enquiry->departure_date = Carbon::parse(request('departure_date'))->format('Y-m-d');
        $enquiry->tour_start_from = request('tour_start_from');
        $enquiry->departure_destination = request('departure_destination');
        $enquiry->current_location = request('current_location');
        $enquiry->any_requirement = request('any_requirement');
        $enquiry->enquiry_category_id = request('category_id');
        $enquiry->save();

        $lead = LeadMaster::where(['enquiry_master_id' => $id])->first();
        if (isset($lead)) {
            $lead->name = request('name');
            $lead->contact = request('contact');
            $lead->email = request('email');
            $lead->address = request('address');
            $lead->save();
        }


        return Redirect::back();
    }

    public function destroy($id)
    {
        $enquiry = EnquiryMaster::find($id);
        $enquiry->is_active = 0;
        $enquiry->save();
    }
}
