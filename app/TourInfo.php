<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourInfo extends Model
{
    protected $table = 'tour_info';
    public $timestamps = false;

    public function sentence_master()
    {
        return $this->belongsTo('App\SentenceMaster');
    }

    public function hotel_master()
    {
        return $this->belongsTo('App\HotelMaster');
    }

}
