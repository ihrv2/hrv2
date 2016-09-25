<?php

namespace IhrV2\Http\Controllers;

use IhrV2\Http\Requests;
use Illuminate\Http\Request;
use Auth;
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


    public function showProfile(\IhrV2\Repositories\UserRepository $user_repo) 
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Profile', 
            'child' => false,           
            'icon' => 'picture',
            'title' => 'View Profile'
        );          
        $data['marital'] = $user_repo->getMaritalStatusByID(Auth::user()->marital_id);
        $data['nationality'] = $user_repo->getNationalityByID(Auth::user()->nationality_id);
        $data['race'] = $user_repo->getRaceByID(Auth::user()->race_id);
        $data['religion'] = $user_repo->getReligionByID(Auth::user()->religion_id);
        return view('auth.profile', $data);
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
        return view('auth.password', $data);
    }

    


    public function updatePassword(Requests\AuthPasswordUpdate $request)
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
