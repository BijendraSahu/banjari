<?php

namespace App\Http\Controllers\LeadMaster;

//use App\Http\Controllers\ValidateUserAccess;
use App\Model\EnquiryMaster;
use App\Model\LeadLog;
use App\Model\LeadMaster;
//use App\Model\UserMaster;
use App\UserMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;


class LeadMasterController extends Controller
{
    public function index()
    {
//        $lead = LeadMaster::where(['is_active' => 1])->orderBy('created_date', 'DESC')->get();
//        return view('LeadManage.LeadMaster.index_Lead')->with('lead', $lead);
        return redirect('lead/1/filter');
    }

    public function getFilteredIndex($id)
    {
//        echo $id;
        session_start();
        $pageno = request('pageno');
        $btn = request('btn');
        $role_master_id = $_SESSION['user_master']->role_master_id;
        $filtered_values = LeadMaster::filterLead($id);
        return view('LeadManage.LeadMaster.lead_master_table')->with(['lead' => $filtered_values, 'role_master_id' => $role_master_id, 'btn' => $btn, 'pageno' => $pageno]);
    }

    #region /*... BASIC CRUD ...*/
    public function create()
    {
//        if (!ValidateUserAccess::Validate()) return view('access_denied_modal');
        $enq = null;
        $enquiries = EnquiryMaster::getEnquiryDropdown();
        return view('LeadManage.LeadMaster.create_Lead')->with(['enq' => $enq, 'enquiries' => $enquiries]);
    }

    public function store()
    {
        $lead = new LeadMaster();
        $lead->name = request('name');
        $lead->contact = request('contact');
        $lead->email = request('email');
        $lead->address = request('address');
        $lead->communication = request('communication');
        $lead->is_converted = 0;
        $lead->is_followup = 0;
        $lead->last_visited_date = null;
//        $lead->enquiry_master_id = (request('enqId') != null) ? request('enqId') : null;
        $lead->enquiry_master_id = request('enqId');
        $lead->user_master_id = request('user_master_id');
        $lead->save();

        $enquiry = EnquiryMaster::find(request('enqId'));
        $enquiry->is_proceed_to_lead = 1;
        $enquiry->save();
        return redirect('lead');
    }

    public function edit($id)
    {
//        if (!ValidateUserAccess::Validate()) return view('access_denied_modal');
        $lead = LeadMaster::find($id);
        return view('LeadManage.LeadMaster.edit_Lead')->with('lead', $lead);
    }

    public function update($id)
    {
        $lead = LeadMaster::find($id);
        $lead->name = request('name');
        $lead->contact = request('contact');
        $lead->email = request('email');
        $lead->address = request('address');
        $lead->save();
        return redirect('lead');
    }
    #region /*... CUSTOM ACTIONS ...*/
    // From Enquiry Form with Enquiry Id
    public function setEnquiryToLead($id)
    {
        $enq = EnquiryMaster::Find($id);
        $enquiries = EnquiryMaster::getEnquiryDropdown();
        $users = UserMaster::getCounsellorDropdown();
        return view('LeadManage.LeadMaster.create_Lead')->with(['enq' => $enq, 'enquiries' => $enquiries, 'users' => $users]);
    }

//    public function counsellorHome()
//    {
////        if (!isset($_SESSION)) {
////            session_start();
////        }
//        $counsellor_id = $_SESSION['user_master']->id;
//        $lead = LeadMaster::where(['is_active' => 1, 'user_master_id' => $counsellor_id])->orderBy('created_date', 'desc')->get();
//        return view('counsellor.home')->with('lead', $lead);
//    }

    public function getFollowUpForm()
    {
        $lead = LeadMaster::find(request('id'));
        return view('counsellor.counsellor_LeadFollowUp')->with('lead', $lead);
    }

    public function getFollowUp($id)
    {
        session_start();
        $user_id = $_SESSION['user_master']->id;
        $user_name = $_SESSION['user_master']->name;
        $lead = LeadMaster::find($id);
//        $lead-> user_master_id= null;
        $lead->is_followup = 1;
        $lead->communication .= "<br/><b>FollowUp By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('communication');
        $lead->response = request('response');
        $lead->lead_status_id = 3;
        $lead->is_assigned = 0;
        $date = Carbon::parse(request('last_visited_date'))->format('Y-m-d');
        $next_date = Carbon::parse(request('next_followup_date'))->format('Y-m-d');
        $lead->last_visited_date = $date;
        $lead->next_followup_date = $next_date;
        $lead->save();

        $leadlog = new LeadLog();
        $leadlog->lead_master_id = $lead->id;
        $leadlog->user_master_id = $user_id;
        $leadlog->date_allocation = null;
        $leadlog->date_visited = $date;
        $leadlog->next_followup_date = $next_date;
        $leadlog->created_date = null;
        $leadlog->save();

        return Redirect::back();

        //return redirect('home_counsellor');

    }

    public function getLeadConvertForm()
    {
        $lead = LeadMaster::find(request('id'));
        return view('counsellor.counsellor_leadconversion')->with('lead', $lead);
    }

    public function getLeadConversion($id)
    {
        session_start();
        $user_id = $_SESSION['user_master']->id;
        $user_name = $_SESSION['user_master']->name;
        $lead = LeadMaster::find($id);
//        $lead->user_master_id = null;
        $lead->is_converted = 1;
        $lead->is_assigned = 0;
        $lead->is_followup = 0;
        $lead->lead_status_id = 6;
        $lead->communication .= "<br/><b>Converted By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('communication');
        $date = Carbon::parse(request('last_visited_date'))->format('Y-m-d');
        $lead->last_visited_date = $date;
        $lead->response = 'Positive';
        $lead->save();

        $leadlog = new LeadLog();
        $leadlog->lead_master_id = $lead->id;
        $leadlog->user_master_id = $user_id;
        $leadlog->date_allocation = null;
        $leadlog->date_visited = $date;
        $leadlog->created_date = null;
        $leadlog->save();

        return Redirect::back();

        //return redirect('home_counsellor');
    }

    public function getLeadNoResponseForm()
    {
        $lead = LeadMaster::find(request('id'));
        return view('counsellor.counsellor_LeadNoResponse')->with('lead', $lead);
    }

    public function getLeadNoResponse($id)
    {
        session_start();
        $user_id = $_SESSION['user_master']->id;
        $user_name = $_SESSION['user_master']->name;

        $lead = LeadMaster::find($id);
//        $lead->user_master_id = null;
//        $lead->is_assigned = 0;
        $date = Carbon::parse(request('last_visited_date'))->format('Y-m-d');
        $lead->last_visited_date = $date;
        $lead->communication .= "<br/><b>Response By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('communication');
        $lead->response = 'Negative';
        $lead->is_converted = 0;
        $lead->lead_status_id = 4;
        $lead->save();

        $leadlog = new LeadLog();
        $leadlog->lead_master_id = $lead->id;
        $leadlog->user_master_id = $user_id;
        $leadlog->date_allocation = null;
        $leadlog->date_visited = $date;
        $leadlog->created_date = null;
        $leadlog->save();

        return Redirect::back();

        //return redirect('home_counsellor');
    }

    public function assignLeadToCounsellor()
    {
        $lead = LeadMaster::Find(request('data'));
        $counsellor = UserMaster::getCounsellorDropdown();
        return view('partial_views.LeadMaster.assignToCounsellor')->with(['lead' => $lead, 'counsellor' => $counsellor]);
    }

    public function updateLeadAfterAssign($id)
    {
        session_start();
        $user_name = $_SESSION['user_master']->name;
        $lead = LeadMaster::Find($id);
        $lead->user_master_id = request('user_master_id');
//        $lead->is_assigned = 1;
        $lead->lead_status_id = 1;
        $lead->is_converted = 0;
        $lead->is_followup = 0;
        $lead->is_completed = 0;

        if ($lead->is_completed == 1) {
            $lead->communication .= "<br/><b>Reassigned By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('communication');
            $lead->is_completed = 0;
        } else
            $lead->communication .= "<br/><b>Assigned By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('communication');

        $lead->save();

        $leadlog = new LeadLog();
        $leadlog->lead_master_id = $lead->id;
        $leadlog->user_master_id = request('user_master_id');
        $date = Carbon::now()->format('Y-m-d');
        $leadlog->date_allocation = $date;
        $leadlog->created_date = $lead->created_date;
        $leadlog->save();

        return redirect('lead');
    }

    public function closeLeadConfirm()
    {
        $lead = LeadMaster::Find(request('data'));
        return view('partial_views.LeadMaster.closeLead')->with('lead', $lead);
    }

    public function closeLeadAfterAssign($id)
    {
        $lead = LeadMaster::Find($id);
        $lead->is_completed = 1;
        $lead->is_converted = 0;
        $lead->lead_status_id = 5;
        $lead->save();
        return redirect('lead');
    }

    public function destroy($id)
    {
        $lead = LeadMaster::find($id);
        $lead->is_active = 0;
        $lead->save();
        return redirect('lead');
    }

    public function addComment($id)
    {
        $lead = LeadMaster::find($id);
        return view('LeadManage.LeadMaster.add_comment')->with(['lead' => $lead]);
    }

    public function storeComment($id)
    {
        session_start();
        $user_name = $_SESSION['user_master']->name;
        $lead = LeadMaster::find($id);
        $lead->communication .= "<br/><b>Added By " . $user_name . ": " . Carbon::now()->format('d-m-Y h:m:s') . "</b><br/>" . request('text');
        $lead->save();
        echo $lead->communication;
    }


    // filter values count

    public static function getCount($id)
    {
        $filter = "";

        if ($id == "1")
            $filter = LeadMaster::where(['is_active' => 1])->count();
        elseif ($id == "2")
            $filter = LeadMaster::where(['is_active' => 1, 'is_assigned' => 1, 'lead_status_id'=>5])->count();
        elseif ($id == "3")
            $filter = LeadMaster::where(['is_active' => 1, 'is_followup' => 1, 'lead_status_id'=>3])->count();
        elseif ($id == "4")
            $filter = LeadMaster::where(['is_active' => 1, 'is_converted' => 1, 'lead_status_id'=>6])->count();
        elseif ($id == "5")
            $filter = LeadMaster::where(['is_active' => 1, 'is_completed' => 1, 'lead_status_id'=>5])->count();
        elseif ($id == "6")
            $filter = LeadMaster::where(['is_active' => 1, 'is_assigned' => 0, 'lead_status_id' => 1])->count();
        elseif ($id == "7")
            $filter = LeadMaster::where(['is_active' => 1, 'lead_status_id' => 4])->count();
        elseif ($id == "8")
            $filter = LeadMaster::where(['is_active' => 1, 'next_followup_date' => Carbon::today()])->orWhere(['next_followup_date' => Carbon::yesterday()])->count();

        return $filter;
    }


}
