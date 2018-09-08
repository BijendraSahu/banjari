<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class EnquiryMaster extends Model
{
    protected $table = "enquiry_master";
    public $timestamps = false;

    public static function GenerateEnquiryNumber()
    {
        $enq_no = DB::table('enquiry_master')->max('enquiry_no');
        if (is_null($enq_no)) $enq_no = 501;
        else $enq_no++;
        return $enq_no;
    }

    public static function checkEnqNo($enqno)
    {
        $user = EnquiryMaster::where(['is_active' => 1, 'enquiry_no' => $enqno])->first();
        if (is_null($user)) return true;
        else return false;
    }

    public function enquiry_category()
    {
        return $this->belongsTo('App\EnquiryCategory', 'enquiry_category_id');
    }

    public function scopegetEnquiryDropdown()
    {
        $enquiries = EnquiryMaster::where(['is_active' => 1])->get(['id', 'name']);
        $arr[0] = "SELECT";
        foreach ($enquiries as $enquiry) {
            $arr[$enquiry->id] = $enquiry->name;
        }
        return $arr;
    }


}
