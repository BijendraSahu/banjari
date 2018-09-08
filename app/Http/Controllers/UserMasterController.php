<?php

namespace App\Http\Controllers;

use App\RoleMaster;
use App\UserMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

session_start();

class UserMasterController extends Controller
{
    public function index()
    {
        return view('user.view_user_master')->with('user_masters', UserMaster::getActiveUserMaster());
    }

    public function create()
    {
        $role_masters = RoleMaster::getRoleDropdown();
        $user_no = UserMaster::GenerateUserNumber();
        return view('user.create_user_master')->with(['role_masters' => $role_masters, 'user_no' => $user_no]);
    }

    public function store(Request $request)
    {
//        if (request('id_proof') != null)
//            echo "No";
        $user_master = new UserMaster();
        if (!$user_master->checkUsername(request('username'))) {
            return Redirect::back()->withInput()->withErrors('Username already exists in the system. Please type a different username.');
        }
        if (strlen(request('username')) < 5 || strlen(request('password')) < 5) {
            return Redirect::back()->withInput()->withErrors('Username or password must be at least 5 character long');
        }

        $user = new UserMaster();
        $user->name = request('name');
        $user->contact = request('contact');
        $user->username = request('username');
        $user->password = md5(request('password'));
        $user->role_master_id = request('role_master_id');
        $user->full_user_no = request('full_user_no');
        $user->user_no = request('user_no');
        $user->save();
        return redirect('user_master');
    }

    public function edit($id)
    {
        $role_masters = RoleMaster::getRoleDropdown();
        $user_master = UserMaster::find($id);
        return view('user.edit_user_master')->with(['user_master' => $user_master, 'role_masters' => $role_masters]);
    }

    public function update($id, Request $request)
    {

        $user_master = UserMaster::find($id);
        $user_master->name = request('name');
        $user_master->contact = request('contact');
        $user_master->role_master_id = request('role_master_id');
        $user_master->save();
        return Redirect::back();
    }

    public
    function destroy($id)
    {
        $user_master = UserMaster::find($id);
        $user_master->is_active = 0;
        $user_master->save();
        return redirect('user_master');
    }
//
    public function activate($id)
    {
        $user_master = UserMaster::find($id);
        $user_master->is_active = 1;
        $user_master->save();
        return redirect('user_master');
    }

    public
    function checkUsername($username)
    {
        $user = UserMaster::where(['is_active' => 1, 'username' => $username])->first();
        if (is_null($user)) return true;
        else return false;
    }
}
