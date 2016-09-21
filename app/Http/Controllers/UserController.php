<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;



class UserController extends Controller
{
    



	public function showUserIndex() {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'icon' => 'people',
			'title' => 'Staff'
		);	
		$group_id = 3;

		$i = \App\User::with(array('UserLatestJob' => function($x) { 
			$x->with('PositionName');
		}));	
		$i->with('StatusName');	
		$i->where('group_id', $group_id);
		$i->orderBy('id', 'DESC');
		$data['users'] = $i->paginate(10);		

		// dd($data['users']);
		$data['groups'] = \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group Level]', ''); 
		$data['sessions'] = array(
			'group_id' => $group_id,
		);		
		return View('modules.user.index', $data);
	}	



	public function showSelectGroup()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('hr.mod.user.index'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
			);

		$data['groups'] = \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Please Select]', ''); 
		return View('modules.user.group', $data);		
	}





	public function postSelectGroup(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'group_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
        	return redirect()->route('hr.mod.user.create')->withInput();
        }	
	}




	public function showUserCreate(Request $request)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('hr.mod.user.index'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
		);
		if (old('group_id')) {
			\Session::put('group_id', old('group_id'));
			$data['positions'] = \App\Models\Position::where('group_id', Session::get('group_id'))->orderBy('name', 'ASC')->lists('name', 'id');
			// show lists of region if group regional manager
			if (Session::get('group_id') == 4) {
				$data['regions'] = \App\Models\Region::orderBy('name', 'ASC')->lists('name', 'id');
			}
			// show lists of sites if group site supervisor
			if (Session::get('group_id') == 3) {			
				$data['sites'] = \App\Models\Site::select(\DB::raw('concat (id, " - ", name) as name, id'))->orderBy('name', 'ASC')->lists('name', 'id');	
				$data['phases'] = \App\Models\Phase::orderBy('name', 'ASC')->lists('name', 'id');						
			}			
			return View('modules.user.create', $data);
		}
		else {
        	return redirect()->route('hr.mod.user.select.group');			
		}
	}



	public function storeUserCreate(Requests\UserCreate $request, \App\User $user)
	{	
		if ($user->UserCreate($request->all())) {
            $msg = array('User successfully added.', 'success');
        }
        else {
            $msg = array('Insert is fail.', 'danger');
        }		
        return redirect()->route('hr.mod.user.index')->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);		
	}




}
