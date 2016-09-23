<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Repositories\UserRepository;
use Carbon\Carbon;


class UserController extends Controller
{
    


    private $user_repo;

	public function __construct(UserRepository $UserRepo)
	{
		$this->user_repo = $UserRepo;
	}




	public function showUser() {
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
		$data['groups'] = $this->user_repo->getGroup();
		$data['sessions'] = array(
			'group_id' => $group_id,
			'keyword' => $keyword
		);		
		return View('modules.user.index', $data);
	}	




	public function postUser(Request $request)
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
		$data['groups'] = $this->user_repo->getGroup();
		$data['sessions'] = array(
			'group_id' => $group_id,
			'keyword' => $keyword
		);		
		return View('modules.user.index', $data);
	}




	public function showGroup()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
			);
		$data['groups'] = $this->user_repo->getGroup();
		return View('modules.user.group', $data);		
	}





	public function postGroup(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'group_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
        	return redirect()->route('mod.user.create')->withInput();
        }	
	}




	public function createUser(Request $request)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
		);
		if (old('group_id')) {
			\Session::put('group_id', old('group_id'));
			$data['positions'] = \App\Models\Position::where('group_id', Session::get('group_id'))->orderBy('name', 'ASC')->lists('name', 'id');
			// show lists of region if group regional manager
			if (Session::get('group_id') == 4) {
				$data['regions'] = $this->user_repo->getRegion();
			}
			// show lists of sites if group site supervisor
			if (Session::get('group_id') == 3) {			
				$data['sites'] = $this->user_repo->getSite();
				$data['phases'] = $this->user_repo->getPhase();
			}			
			return View('modules.user.create', $data);
		}
		else {
        	return redirect()->route('mod.user.group');			
		}
	}



	public function storeUser(Requests\UserCreate $request, \App\User $user)
	{	
		if ($user->UserCreate($request->all())) {
            $msg = array('User successfully added.', 'success');
        }
        else {
            $msg = array('Insert is fail.', 'danger');
        }		
        return redirect()->route('mod.user.index')->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);		
	}




	public function editUserPassword($id, $token)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',	
			'child-a' => route('mod.user'),						
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
			'child-a' => route('mod.user'),					
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





    // user contract
    public function createUserContract($uid, $token)
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user'),	
			'sub' => 'User Detail',
			'sub-a' => route('mod.user.view', array($uid, $token)),				
			'icon' => 'graph',
			'title' => 'Add/Renew Contract'
		);		
		$data['status_contracts'] = $this->user_repo->getUserContractStatus();
		return View('modules.user.contract.create', $data);
    }





    public function storeUserContract(Requests\UserCreateContract $request, $id, $token, \App\Models\UserContract $contract)
    {
    	$save = $contract->UserContractCreate($request->all(), $id);
		if ($save) {
			$msg = array($save['message'], $save['label']);
        }
        else {
            $msg = array('Insert is fail.', 'danger');
        }		
        return redirect()->route('mod.user.view', array($id, $token))->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);	
    }





    public function editUserContract($id, $uid, $token)
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user'),	
			'sub' => 'User Detail',
			'sub-a' => route('mod.user.view', array($uid, $token)),	
			'icon' => 'graph',
			'title' => 'Edit Contract'
			);		
		$data['status_contracts'] = $this->user_repo->getUserContractStatus();
		$data['detail'] = \App\Models\UserContract::find($id);
		return View('modules.user.contract.edit', $data);    	
    }





    public function updateUserContract(Requests\UserUpdateContract $request, $id, $uid, $token)
    {
    	$contract = \App\Models\UserContract::find($id);
    	$save = $contract->UserContractEdit($request->all(), $id);
		if ($save) { 
        	$msg = array($save['message'], $save['label']);
        }
        else {
        	$msg = array('Update is fail.', 'danger');
        }
        return redirect()->route('mod.user.view', array($uid, $token))->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);
    }

    public function destroyUserContract()
    {
    	
    }





    // user family
    public function createUserFamily()
    {

    }

    public function storeUserFamily()
    {

    }

    public function editUserFamily()
    {

    }

    public function updateUserFamily()
    {

    }
    
    public function destroyUserFamily()
    {

    }




    // user education
    public function createUserEducation()
    {

    }

    public function storeUserEducation()
    {

    }

    public function editUserEducation()
    {

    }

    public function updateUserEducation()
    {

    }
    
    public function destroyUserEducation()
    {

    }


    // user language
    public function createUserLanguage()
    {

    }

    public function storeUserLanguage()
    {

    }

    public function editUserLanguage()
    {

    }

    public function updateUserLanguage()
    {

    }
    
    public function destroyUserLanguage()
    {

    }



    // user skills
    public function createUserSkill()
    {

    }

    public function storeUserSkill()
    {

    }

    public function editUserSkill()
    {

    }

    public function updateUserSkill()
    {

    }
    
    public function destroyUserSkill()
    {

    }


    // user employment history
    public function createUserEmployment()
    {

    }

    public function storeUserEmployment()
    {

    }

    public function editUserEmployment()
    {

    }

    public function updateUserEmployment()
    {

    }
    
    public function destroyUserEmployment()
    {

    }



    // user references
    public function createUserReference()
    {

    }

    public function storeUserReference()
    {

    }

    public function editUserReference()
    {

    }

    public function updateUserReference()
    {

    }
    
    public function destroyUserReference()
    {

    }





    // user emergency contacts
    public function createUserEmergency()
    {

    }

    public function storeUserEmergency()
    {

    }

    public function editUserEmergency()
    {

    }

    public function updateUserEmergency()
    {

    }
    
    public function destroyUserEmergency()
    {

    }






}





