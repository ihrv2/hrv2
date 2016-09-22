<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Repositories\UserRepository;



class UserController extends Controller
{
    


    private $user_repo;
	public function __construct(UserRepository $UserRepo)
	{
		$this->user_repo = $UserRepo;
	}



	public function showUserIndex() {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'icon' => 'people',
			'title' => 'Staff'
		);	
		$group_id = 3;
		$keyword = null;

		$i = \App\User::with(array('UserLatestJob' => function($x) { 
			$x->with('PositionName');
		}));	
		$i->with('StatusName');	

		// check search session
		if (!empty(Session::get('i-search')['text-search'])) {
			$keyword = Session::get('i-search')['text-search'];
			$searchTerms = explode(' ', $keyword);
			foreach ($searchTerms as $term) {
				$i->where("users.name", "like", "%".$term."%");
				$i->orWhere("users.icno", "like", "%".$term."%");
				$i->orWhere("users.username", "like", "%".$term."%");
			}
		}	
		if (!empty(Session::get('i-search')['group_id'])) {
			$group_id = Session::get('i-search')['group_id'];
		}	

		$i->orderBy('id', 'DESC');
		$data['users'] = $i->paginate(10);		
		$data['groups'] = \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group Level]', ''); 
		$data['sessions'] = array(
			'group_id' => $group_id,
			'keyword' => $keyword
		);		
		return View('modules.user.index', $data);
	}	




	public function postUserIndex(Request $request)
	{
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

		// searching
		Session::put('i-search', $request->all());		
		if (!empty(Session::get('i-search')['text-search'])) {
			$keyword = Session::get('i-search')['text-search'];
			$searchTerms = explode(' ', $keyword);
			foreach ($searchTerms as $term) {
				$i->where("users.name", "like", "%".$term."%");
				$i->orWhere("users.icno", "like", "%".$term."%");
				$i->orWhere("users.username", "like", "%".$term."%");
			}
		}	
		else {
			$keyword = null;
		}
		if (!empty(Session::get('i-search')['group_id'])) {
			$group_id = Session::get('i-search')['group_id'];
		}			

		$i->where('group_id', $group_id);
		$i->orderBy('id', 'DESC');
		$data['users'] = $i->paginate(10);	

		// dd($data['users']);
		$data['groups'] = \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group Level]', ''); 
		$data['sessions'] = array(
			'group_id' => $group_id,
			'keyword' => $keyword
		);		
		return View('modules.user.index', $data);
	}


	// getName
	// getPrefix
	// getPath
	// getActionName


	public function showSelectGroup()
	{
		// dd($this->getRouter()->getCurrentRoute()->getPrefix());
		// $prefix = $this->getRouter()->getCurrentRoute()->getName();
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => '',
			// 'child-a' => route($prefix.'.mod.user.index'),
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
			'child-a' => '',
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
			return View('modules.user.add', $data);
		}
		else {
        	return redirect()->route('mod.user.select.group');			
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




	public function showUserPassword($id, $token)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',	
			'child-a' => '',				
			'icon' => 'lock',
			'title' => 'Change Password'
			);			
		return View('modules.user.password', $data);
	}




    public function updateUserPassword(Requests\UserChangePassword $request, $id, $token)
    {
    	$user = $this->user_repo->getUserDetailByToken($id, $token);
        $user->fill(['password' => \Hash::make($request->new_password)])->save();            
        $msg = array('Password successfully updated.', 'success');
        return redirect()->back()->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);
    }	




    public function showUserView($id, $token)
    {
		$data = array();
		$data['detail'] = $this->user_repo->getUserDetailByToken($id, $token);
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => '',					
			'icon' => 'user',
			'title' => $data['detail']->name
		);			
		// job info
		$data['curr_job'] = \App\Models\UserJob::where('user_id', '=', $id)->where('status', '=', 1)->first();
		$data['prev_job'] = \App\Models\UserJob::where('user_id', '=', $id)->where('status', '=', 2)->orderBy('id', 'DESC')->get();

		// contract info
		$data['curr_contract'] = \App\Models\UserContract::where('user_id', '=', $id)->where('status', '=', 1)->first();
		$data['prev_contract'] = \App\Models\UserContract::where('user_id', '=', $id)->where('status', '=', 2)->orderBy('id', 'DESC')->get();

		// get age value
		$data['age'] = date('Y') - date('Y', strtotime($data['detail']->dob));

		// photos
		$data['photo'] = \App\Models\UserPhoto::where('user_id', $id)->where('status', 1)->first();
		return View('modules.user.view', $data);
    }






}





