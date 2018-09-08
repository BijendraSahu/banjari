<?php

namespace App\Http\Controllers;

use App\EnquiryCategory;
use App\Model\EnquiryMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index()
    {
        return view('category.view_category')->with('categories', EnquiryCategory::getActiveCategory());
    }

    public function create()
    {
        return view('category.create_category');
    }

    public function store(Request $request)
    {
        $category = new EnquiryCategory();
        $category->category_name = request('category_name');
        $category->percent = request('percent');
        $category->save();
        return redirect('category');
    }

    public function edit($id)
    {
        $category = EnquiryCategory::find($id);
        return view('category.edit_category')->with(['category' => $category]);
    }

    public function update($id, Request $request)
    {

        $category = EnquiryCategory::find($id);
        $category->category_name = request('category_name');
        $category->percent = request('percent');
        $category->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $category = EnquiryCategory::find($id);
        $category->is_active = 0;
        $category->save();

        $enquiry = EnquiryMaster::where(['enquiry_category_id' => $id])->get();
        if (count($enquiry) > 0) {
            foreach ($enquiry as $item) {
                $item->enquiry_category_id = null;
                $item->save();
            }
        }

        return redirect('category');
    }
}
