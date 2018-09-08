<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Policy extends Model
{
    protected $table = 'policy';
    public $timestamps = false;

    public function scopeGetActivepolicy($query)
    {
        return $query->where(['is_active' => 1])->get();
    }
}
