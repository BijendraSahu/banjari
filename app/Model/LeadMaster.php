<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LeadMaster extends Model
{
    protected $table = "lead_master";
    public $timestamps = false;

    public function scopegetLeadDropdown()
    {
        $leads = LeadMaster::where('is_active', '1')->get();
        $arr[0] = "SELECT";
        foreach ($leads as $lead) {
            $arr[$lead->id] = $lead->name . " " . $lead->contact;
        }
        return $arr;
    }

    public function enquiry_master()
    {
        return $this->belongsTo('App\EnquiryMaster');
    }

    public function user_master()
    {
        return $this->belongsTo('App\UserMaster');
    }

    public function lead_status()
    {
        return $this->belongsTo('App\Model\LeadStatus');
    }

    public function getLeadDD()
    {
        $lead = LeadMaster::where(['is_active' => 1])->lists('title', 'id');
        return $lead;
    }

    public static function filterLead($id)
    {
        $search_column = "";
        if ($id == 2) $search_column = 'is_assigned';
        if ($id == 3) $search_column = 'is_followup';
        if ($id == 4) $search_column = 'is_converted';
        if ($id == 5) $search_column = 'is_completed';
        if ($id == 6) $search_column = 'is_assigned';

        if ($id == 2) $l_status = '2';
        if ($id == 3) $l_status = '3';
        if ($id == 4) $l_status = '6';
        if ($id == 5) $l_status = '5';
        if ($id == 6) $l_status = '2';

        if ($id == 1)
            $filter_lead = LeadMaster::where(['is_active' => 1])->orderBy('created_date', 'DESC')->paginate(20);
        elseif ($id == 6)
            $filter_lead = LeadMaster::where(['is_active' => 1, 'lead_status_id' => 1])->orderBy('created_date', 'DESC')->paginate(20);
        elseif ($id == 7)
            $filter_lead = LeadMaster::where(['is_active' => 1, 'lead_status_id' => 4])->orderBy('created_date', 'DESC')->paginate(20);
        elseif ($id == 8)
            $filter_lead = LeadMaster::where(['is_active' => 1, 'next_followup_date' => Carbon::today()])->orWhere(['next_followup_date' => Carbon::yesterday()])->orderBy('created_date', 'DESC')->paginate(20);
        else
            $filter_lead = LeadMaster::where(['is_active' => 1, $search_column => 1, 'lead_status_id' => $l_status])->orderBy('created_date', 'DESC')->paginate(20);

        return $filter_lead;

    }

    public static function getNonConvertedLeadCount()
    {
        $lead_count = LeadMaster::where(['is_active' => 1, 'is_converted' => 0])->count();
        return ($lead_count != 0) ? $lead_count : 0;
    }
}
