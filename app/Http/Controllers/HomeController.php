<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showHome()
    {
        $data = array();
        return view('home', $data);
    }


    public function showProfile() 
    {
        // dd(Auth::user());
        $data = array();
        $data['header'] = array(
            'parent' => 'Profile', 
            'child' => false,           
            'icon' => 'picture',
            'title' => 'View Profile'
        );          
        // $data['marital'] = MaritalStatus::find(Auth::user()->marital_id);
        // $data['nationality'] = Nationality::find(Auth::user()->nationality_id);
        // $data['race'] = Race::find(Auth::user()->race_id);
        // $data['religion'] = Religion::find(Auth::user()->religion_id);
        return view('profile', $data);
    }



    public function editProfile()
    {

    }

    public function updateProfile()
    {

    }




    public function editPassword()
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Profile', 
            'child' => false,
            'icon' => 'lock',
            'title' => 'Change Password'
        );                  
        return view('change_password', $data);
    }


    public function updatePassword(Requests\UserChangePassword $request)
    {
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();            
            $msg = array('Password successfully updated.', 'success');
        }
        else {
            $msg = array('Current password is incorrect.', 'danger');
        }
        return redirect()->back()->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);
    }



}
