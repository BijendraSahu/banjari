<?php

namespace App\Http\Controllers;

use App\Policy;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        return view('policy.view_policy')->with('policy', Policy::GetActivepolicy());
    }

    public function create()
    {
        return view('policy.create_policy');
    }

    public function store(Request $request)
    {
        $p = new Policy();
        $p->policy = request('policy');
        $p->save();
        return redirect('policy')->with('message', 'Policy has been added...!');
    }

    public function edit($id)
    {
        $policy = Policy::find($id);
        return view('policy.edit_policy')->with(['policy' => $policy]);
    }

    public function update($id, Request $request)
    {
        $p = Policy::find($id);
        $p->policy = request('policy');
        $p->save();
        return redirect('policy')->with('message', 'Policy has been updated...!');
    }

    public
    function delete($id)
    {
        $p = Policy::find($id);
        $p->is_active = 0;
        $p->save();
        return redirect('policy')->with('message', 'Policy has been deleted...!');
    }
}
