<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{



    private $leave_repo;
    
	public function __construct(\App\Repositories\LeaveRepository $LeaveRepo)
	{
		$this->leave_repo = $LeaveRepo;
	}




    public function showLeaveIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All leave',
			'icon' => 'grid',
			'title' => 'View Request Leave'
		);		
		return View('leave.index', $data);
    }




    public function showLeaveSelect()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Add Leave',
			'icon' => 'grid',
			'title' => 'Leave Type'
		);
		$empty = 0;
		$expired = 0;

		// check current contract
		$current = \App\Models\UserContract::where('user_id', \Auth::user()->id)->where('status', 1)->first();
		if (empty($current)) {	
			$empty = 1;
		}
		else {
			// check if current contract is expired
			$check_exp = $this->leave_repo->CheckIfExpired($current->date_to);
			if ($check_exp == 1) {
				$expired = 1;
			}
			else {
				$data['leave_types'] = $this->leave_repo->getLeaveTypeWithPrefix();
			}
		}
		$data['x'] = array('empty' => $empty, 'expired' => $expired);		
		return View('leave.select', $data);	    	
    }




    public function postLeaveSelect(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
        	return redirect()->route('sv.mod.leave.create')->withInput();
        }
    }




    public function showLeaveCreate(Request $request)
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Add Leave',
			'icon' => 'grid',
			'title' => 'Add Leave'
		);
		if (old('leave_type_id')) {
			\Session::put('leave_type_id', old('leave_type_id'));	
			$data['leave_type'] = \App\Models\LeaveType::find(\Session::get('leave_type_id'));			
			$data['job'] = $this->leave_repo->getUserJobByID(\Auth::user()->id);		
			$data['site'] = \App\Models\Site::where('sites.id', '=', \Auth::user()->sitecode)->first();					
			$data['rm'] = $this->leave_repo->getRegionManager(\Auth::user()->sitecode);
			return View('leave.create', $data);
		}
		else {
			return redirect()->route('sv.mod.leave.select');
		}	    	
    }



    public function storeLeaveCreate(Requests\LeaveCreate $request, \App\Models\LeaveApplication $leave_app)
    {
		if ($leave_app->LeaveCreate($request->all())) {
            $msg = array('Leave successfully added.', 'success');
        }
        else {
            $msg = array('Insert is fail.', 'danger');
        }		
        return redirect()->route('sv.mod.leave.index')->with([
            'message' => $msg[0], 
            'label' => 'alert alert-'.$msg[1].' alert-dismissible'
        ]);	
    }



    public function showLeaveSummary()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Leave Summary',
			'icon' => 'grid',
			'title' => 'Leave Summary'
		);			
		return View('leave.summary', $data);
    }




    public function showLeaveRepIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement leave',
			'icon' => 'note',
			'title' => 'Replacement Leave'
		);
		return View('replacement-leave.index', $data);
    }



    public function postLeaveRepIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement leave',
			'icon' => 'note',
			'title' => 'Replacement Leave'
		);
		return View('replacement-leave.index', $data);
    }



    public function showLeaveRepCreate()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement Leave',
			'child-a' => route('sv.mod.leave.replacement.index'),			
			'icon' => 'note',
			'title' => 'Add Replacement Leave'
		);			
		return View('replacement-leave.add', $data);	    	
    }


    
    public function storeLeaveRepCreate()
    {

    }


}
