<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentenceMaster extends Model
{
    protected $table = 'sentence_master';
    public $timestamps = false;

    public function scopeGetActiveSentenceMaster($query)
    {
        return $query->where(['is_active' => 1])->get();
    }

    public function start_location()
    {
        return $this->belongsTo('App\PlaceMaster', 'start_location_id');
    }

    public function end_location()
    {
        return $this->belongsTo('App\PlaceMaster', 'end_location_id');
    }
}
