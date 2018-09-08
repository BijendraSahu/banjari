<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EnquiryCategory extends Model
{
    protected $table = 'enquiry_category';
    public $timestamps = false;

    public function scopeGetActiveCategory($query)
    {
        return $query->get();
    }
    public
    function scopegetCategoryDropdown()
    {
        $categories = EnquiryCategory::where(['is_active' => '1'])->get(['id', 'category_name']);
        $arr[0] = "SELECT";
        foreach ($categories as $category) {
            $arr[$category->id] = $category->category_name;
        }
        return $arr;
    }
}
