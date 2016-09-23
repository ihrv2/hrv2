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
		return View('modules.leave.index', $data);
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
		$data['leave_types'] = $this->leave_repo->getLeaveType();
		return View('modules.leave.select', $data);	    	
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
			return View('modules.leave.create', $data);
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
		return View('modules.leave.summary', $data);
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
		return View('modules.replacement-leave.index', $data);
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
		return View('modules.replacement-leave.index', $data);
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
		return View('modules.replacement-leave.add', $data);	    	
    }


    
    public function storeLeaveRepCreate()
    {

    }


}
