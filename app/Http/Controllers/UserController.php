<?php

namespace IhrV2\Http\Controllers;

use Illuminate\Http\Request;
use IhrV2\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Session;
use Carbon\Carbon;


class UserController extends Controller
{
    


    private $user_repo;
    private $leave_repo;

	public function __construct(\IhrV2\Repositories\UserRepository $UserRepo, \IhrV2\Repositories\LeaveRepository $LeaveRepo)
	{
		$this->user_repo = $UserRepo;
		$this->leave_repo = $LeaveRepo;
	}




	// public function setUserRepo(\IhrV2\Repositories\UserRepository $UserRepo)
	// {
	// 	$this->user_repo = $UserRepo;
	// }




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

		$i = \IhrV2\User::with(array('UserLatestJob' => function($x) { 
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

		$i->where('group_id', $group_id);
		$i->IsActiveAndIDDesc();
		$data['users'] = $i->paginate(10);		
		$data['groups'] = $this->user_repo->getGroupList();
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
		$i = \IhrV2\User::with(array('UserLatestJob' => function($x) { 
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
		$i->IsActiveAndIDDesc();
		$data['users'] = $i->paginate(10);			
		$data['groups'] = $this->user_repo->getGroupList();
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
			'child-a' => route('mod.user.index'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
			);
		$data['groups'] = $this->user_repo->getGroupList();
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
			'child-a' => route('mod.user.index'),
			'icon' => 'user-follow',
			'title' => 'Add Staff'
		);
		if (old('group_id')) {
			\Session::put('group_id', old('group_id'));
			$data['positions'] = $this->user_repo->getPositionListByGroup(\Session::get('group_id'));
			// show lists of region if group regional manager
			if (Session::get('group_id') == 4) {
				$data['regions'] = $this->user_repo->getRegionList();
			}
			// show lists of sites if group site supervisor
			if (Session::get('group_id') == 3) {			
				$data['sites'] = $this->user_repo->getSiteListWithID();
				$data['phases'] = $this->user_repo->getPhaseList();
			}			
			return View('modules.user.create', $data);
		}
		else {
        	return redirect()->route('mod.user.group');			
		}
	}



	public function storeUser(Requests\UserCreate $request, \IhrV2\User $user)
	{	
		if ($user->user_create($request->all())) {
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




	public function showUserPassword($id, $token)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',	
			'child-a' => route('mod.user.index'),						
			'icon' => 'lock',
			'title' => 'Change Password'
		);		
    	$check = $this->user_repo->getUserByIDToken($id, $token);				
		return View('modules.user.password', $data);
	}




    public function updateUserPassword(Requests\UserPasswordUpdate $request, $id, $token)
    {
    	$user = $this->user_repo->getUserByIDToken($id, $token);
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
		$data['detail'] = $this->user_repo->getUserByIDToken($id, $token);
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user.index'),					
			'icon' => 'user',
			'title' => $data['detail']->name
		);			
		// job info
		$data['curr_job'] = \IhrV2\Models\UserJob::where('user_id', '=', $id)->where('status', '=', 1)->first();
		$data['prev_job'] = \IhrV2\Models\UserJob::where('user_id', '=', $id)->where('status', '=', 2)->orderBy('id', 'DESC')->get();

		// contract info
		$data['curr_contract'] = \IhrV2\Models\UserContract::where('user_id', $id)->where('status', 1)->first();
		$data['prev_contract'] = \IhrV2\Models\UserContract::where('user_id', $id)->where('status', 2)->orderBy('id', 'DESC')->get();

		// get age value
		$data['age'] = date('Y') - date('Y', strtotime($data['detail']->dob));

		// photos
		$data['photo'] = \IhrV2\Models\UserPhoto::where('user_id', $id)->where('status', 1)->first();

		return View('modules.user.view', $data);
    }





    // user contract
    public function createUserContract($uid, $token)
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user.index'),	
			'sub' => 'User Detail',
			'sub-a' => route('mod.user.view', array($uid, $token)),				
			'icon' => 'graph',
			'title' => 'Add/Renew Contract'
		);		
		$check = $this->user_repo->getUserByIDToken($uid, $token);
		$data['status_contracts'] = $this->user_repo->getUserContractStatusList();
		return View('modules.user.contract.create', $data);
    }





    public function storeUserContract(Requests\UserContractCreate $request, $id, $token, \IhrV2\Models\UserContract $contract)
    {
    	$save = $contract->contract_create($request->all(), $id);	
        return redirect()->route($save[2], array($id, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]);	
    }





    public function editUserContract($id, $uid, $token)
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Staff Administration', 
			'child' => 'All Staff',
			'child-a' => route('mod.user.index'),	
			'sub' => 'User Detail',
			'sub-a' => route('mod.user.view', array($uid, $token)),	
			'icon' => 'graph',
			'title' => 'Edit Contract'
			);		
		$data['status_contracts'] = $this->user_repo->getUserContractStatusList();
		$data['detail'] = $this->user_repo->getUserContractWithUser($id, $uid, $token);
		return View('modules.user.contract.edit', $data);    	
    }





    public function updateUserContract(Requests\UserUpdateContract $request, $id, $uid, $token)
    {
    	$contract = \IhrV2\Models\UserContract::find($id);
    	$save = $contract->contract_update($request->all(), $id);
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




    // user photo
    public function updateUserPhoto(Request $request)
    {
		$validator = Validator::make();		
		if ($validator->fails()) {
			$array['msg'] = array('status' => 0, 'error' => $validator->messages()->all());			
		}
		else {					
			$id = Input::get('id');		
			if (old('photo')) {			
				    	
			}	
			else {
				$array['msg'] = array('status' => 0, 'id' => $id, 'filename' => 0);
			}
		}
        return response()->json($data);	
    }




    public function destroyUserPhoto(Request $request)
    {
		// inactive current photo, status set to 0
		$update = \IhrV2\Models\UserPhoto::where('user_id', $request->id)->where('status', 1)->update(array('status' => 0));
		if ($update) {
			$data['msg'] = array('message' => 'Ok', 'status' => 1);
		}
		else {
			$data['msg'] = array('message' => 'Delete fail', 'status' => 0);
		}
        return response()->json($data);           
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





