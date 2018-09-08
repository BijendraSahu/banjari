<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InclusionMaster extends Model
{
    protected $table = 'inclusion_master';
    public $timestamps = false;

    public function scopeGetActiveInclusionMaster($query)
    {
        return $query->where(['is_active' => 1])->orderBy('rate', 'asc')->get();
    }

    public function place_master()
    {
        return $this->belongsTo('App\PlaceMaster');
    }

    public function scopegetInclusionDropdown()
    {
        $inclusions = InclusionMaster::where(['is_active' => '1'])->get();
        $arr[0] = "SELECT";
        foreach ($inclusions as $inclusion) {
            $arr[$inclusion->id] = $inclusion->name;
        }
        return $arr;
    }
}
