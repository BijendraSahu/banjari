<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourInclusion extends Model
{
    protected $table = 'tour_inclusion';
    public $timestamps = false;

    public function tour_master()
    {
        return $this->belongsTo('App\TourMaster');
    }
    public function inclusion_master()
    {
        return $this->belongsTo('App\InclusionMaster');
    }
}
