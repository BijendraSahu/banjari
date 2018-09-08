<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryMaster extends Model
{
    protected $table = 'enquiry_master';
    public $timestamps = false;

    public function scopeGetActiveEnquiry($query)
    {
        return $query->where('is_active', 1)->orderBy('id', 'DESC')->get();
    }

    public
    function enquiry_category()
    {
        return $this->belongsTo('App\EnquiryCategory');
    }

}
