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
		// get age value
		$data['age'] = date('Y') - date('Y', strtotime($data['detail']->dob));
		return View('modules.user.view', $data);
    }






    // tabs
    public function showUserViewPersonal($uid, $token)
    {
        $data['personal'] = $this->user_repo->getUserPersonalByUserIDToken($uid, $token);
        $data['age'] = date('Y') - date('Y', strtotime($data['personal']->dob));        
        return View('modules.user.tab.personal', $data);
    }

    public function showUserViewJob($uid, $token)
    {
		$data['job'] = $this->user_repo->getUserJobByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
		return View('modules.user.tab.job', $data);
    }

    public function showUserViewContract($uid, $token)
    {
        $data['curr_contract'] = $this->user_repo->getUserContractCurrByUserIDToken($uid, $token);
        $data['prev_contract'] = $this->user_repo->getUserContractPrevByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.contract', $data);
    }

    public function showUserViewFamily($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserFamilyByUserIDToken($uid, $token);        
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.family', $data);
    }

    public function showUserViewEducation($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserEducationByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.education', $data);
    }

    public function showUserViewLanguage($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserLanguageByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.language', $data);
    }

    public function showUserViewSkill($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserSkillByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.skill', $data);
    }

    public function showUserViewEmployment($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserEmploymentByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.employment', $data);
    }
    public function showUserViewReference($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserReferenceByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.reference', $data);
    }

    public function showUserViewEmergency($uid, $token)
    {
        $data['detail'] = $this->user_repo->getUserEmergencyByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);
        return View('modules.user.tab.emergency', $data);       
    }

    public function showUserViewPhoto($uid, $token)
    {
        $data['photo'] = $this->user_repo->getUserPhotoByUserIDToken($uid, $token);
        $data['user'] = array('id' => $uid, 'token' => $token);        
        return View('modules.user.tab.photo', $data);
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





    public function updateUserContract(Requests\UserContractUpdate $request, $id, $uid, $token)
    {
    	$contract = \IhrV2\Models\UserContract::find($id);
    	$save = $contract->contract_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
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
    public function createUserFamily($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'people',
            'title' => 'Add Family'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        return View('modules.user.family.create', $data);
    }

    public function storeUserFamily(Requests\UserFamilyCreate $request, $uid, $token, \IhrV2\Models\UserFamily $family)
    {
        $save = $family->family_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserFamily($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'people',
            'title' => 'Edit Family'
            );              
        $data['detail'] = $this->user_repo->getUserFamilyWithUser($id, $uid, $token);        
        return View('modules.user.family.edit', $data);
    }

    public function updateUserFamily(Requests\UserFamilyUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserFamily::find($id);
        $save = $i->family_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function destroyUserFamily(Request $request)
    {
        $uid = 1387;
        $token = 'lHxFerLjjhKCmsPc3vnQs64Jz00gdSJL1X294ZFzLPLzHBhxwz3bRXT1KwwT';
        $family = \IhrV2\Models\UserFamily::find(1);
        $save = $family->family_delete($request->all());        
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }




    // user education
    public function createUserEducation($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'graduation',
            'title' => 'Add Education'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        return View('modules.user.education.create', $data);
    }

    public function storeUserEducation(Requests\UserEducationCreate $request, $uid, $token, \IhrV2\Models\UserEducation $i)
    {
        $save = $i->education_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserEducation($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'graduation',
            'title' => 'Edit Education'
            );              
        $data['detail'] = $this->user_repo->getUserEducationWithUser($id, $uid, $token);        
        return View('modules.user.education.edit', $data);
    }

    public function updateUserEducation(Requests\UserEducationUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserEducation::find($id);
        $save = $i->education_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserEducation()
    {

    }





    // user language
    public function createUserLanguage($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'speech',
            'title' => 'Add language'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        $data['levels'] = $this->user_repo->getSkillLevelList();
        return View('modules.user.language.create', $data);
    }

    public function storeUserLanguage(Requests\UserLanguageCreate $request, $uid, $token, \IhrV2\Models\UserLanguage $i)
    {
        $save = $i->language_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserLanguage($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'speech',
            'title' => 'Edit Language'
            );              
        $data['detail'] = $this->user_repo->getUserLanguageWithUser($id, $uid, $token);
        $data['levels'] = $this->user_repo->getSkillLevelList();            
        return View('modules.user.language.edit', $data);
    }

    public function updateUserLanguage(Requests\UserLanguageUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserLanguage::find($id);
        $save = $i->language_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserLanguage()
    {

    }



    // user skills
    public function createUserSkill($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'heart',
            'title' => 'Add Skill'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        $data['skill_levels'] = $this->user_repo->getSkillLevelList();        
        return View('modules.user.skill.create', $data);
    }

    public function storeUserSkill(Requests\UserSkillCreate $request, $uid, $token, \IhrV2\Models\UserSkill $i)
    {
        $save = $i->skill_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserSkill($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'heart',
            'title' => 'Edit Skill'
            );              
        $data['detail'] = $this->user_repo->getUserSkillWithUser($id, $uid, $token);        
        $data['skill_levels'] = $this->user_repo->getSkillLevelList();                
        return View('modules.user.skill.edit', $data);
    }

    public function updateUserSkill(Requests\UserSkillUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserSkill::find($id);
        $save = $i->skill_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserSkill()
    {

    }




    // user employment history
    public function createUserEmployment($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'briefcase',
            'title' => 'Add Employment'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        return View('modules.user.employment.create', $data);
    }

    public function storeUserEmployment(Requests\UserEmploymentCreate $request, $uid, $token, \IhrV2\Models\UserEmployment $i)
    {
        $save = $i->employment_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserEmployment($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'briefcase',
            'title' => 'Edit Employment'
            );              
        $data['detail'] = $this->user_repo->getUserEmploymentWithUser($id, $uid, $token);        
        return View('modules.user.employment.edit', $data);
    }

    public function updateUserEmployment(Requests\UserEmploymentUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserEmployment::find($id);
        $save = $i->employment_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserEmployment()
    {

    }




    // user references
    public function createUserReference($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'pin',
            'title' => 'Add Reference'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        return View('modules.user.reference.create', $data);
    }

    public function storeUserReference(Requests\UserReferenceCreate $request, $uid, $token, \IhrV2\Models\UserReference $i)
    {
        $save = $i->reference_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserReference($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'pin',
            'title' => 'Edit Reference'
            );              
        $data['detail'] = $this->user_repo->getUserReferenceWithUser($id, $uid, $token);        
        return View('modules.user.reference.edit', $data);
    }

    public function updateUserReference(Requests\UserReferenceUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserReference::find($id);
        $save = $i->reference_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserReference()
    {

    }





    // user emergency contacts
    public function createUserEmergency($uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),   
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),             
            'icon' => 'phone',
            'title' => 'Add Emergency Contact'
        );      
        $check = $this->user_repo->getUserByIDToken($uid, $token);
        return View('modules.user.emergency.create', $data);
    }

    public function storeUserEmergency(Requests\UserEmergencyCreate $request, $uid, $token, \IhrV2\Models\UserEmergency $emergency)
    {
        $save = $emergency->emergency_create($request->all(), $uid);   
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }

    public function editUserEmergency($id, $uid, $token)
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Staff Administration', 
            'child' => 'All Staff',
            'child-a' => route('mod.user.index'),          
            'sub' => 'User Detail',
            'sub-a' => route('mod.user.view', array($uid, $token)),                  
            'icon' => 'phone',
            'title' => 'Edit Emergency Contact'
            );              
        $data['detail'] = $this->user_repo->getUserEmergencyWithUser($id, $uid, $token);        
        return View('modules.user.emergency.edit', $data);
    }

    public function updateUserEmergency(Requests\UserEmergencyUpdate $request, $id, $uid, $token)
    {
        $i = \IhrV2\Models\UserEmergency::find($id);
        $save = $i->emergency_update($request->all());
        return redirect()->route($save[2], array($uid, $token))->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]); 
    }
    
    public function destroyUserEmergency()
    {

    }






}





