<?php

namespace IhrV2\Http\Controllers;

use Illuminate\Http\Request;

use IhrV2\Http\Requests;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{



    private $user_repo;
    private $leave_repo;

	public function __construct(\IhrV2\Repositories\UserRepository $UserRepo, \IhrV2\Repositories\LeaveRepository $LeaveRepo)
	{
		$this->user_repo = $UserRepo;
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
		$contract = $this->user_repo->getUserContractByUserIDStatus(\Auth::user()->id);
		if (empty($contract)) {	
			$empty = 1;
		}
		else {
			// check if current contract is expired
			$check_exp = $this->leave_repo->CheckIfExpired($contract->date_to);
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

			$user_id = \Auth::id();			
			$leave_type_id = \Session::get('leave_type_id');

			$data['leave_type'] = \IhrV2\Models\LeaveType::find(\Session::get('leave_type_id'));			
			$data['job'] = $this->user_repo->getUserJobByID(\Auth::user()->id);					
			$data['rm'] = $this->user_repo->getRegionManager(\Auth::user()->sitecode);

			// check if reporting officer is not set
			if (!$data['rm']['RegionName']['RegionManager']) {
				return redirect()->route('sv.mod.leave.select')
					->with('message', 'Reporting Officer is not set.')
					->with('label', 'alert alert-danger alert-dismissible');				
			}

			// only have start date if choose this leave
			// -----------------------------------------
			// haji - 40 days
			// umrah - 10 days
			// maternity - 60 days
			// paternity - 3 days
			// marriage - 3 days

			$data['to'] = 0;
			if (in_array($leave_type_id, array(5, 7, 8, 9, 10))) {
				$data['to'] = 1;
			}

			// get contract info
			$data['contract'] = $this->user_repo->getUserContractByUserIDStatus($user_id);

			// check leave entitled
			if ($leave_type_id == 1) { // annual leave
				$data['leave_total'] = $data['contract']->total_al;
			}			
			else if ($leave_type_id == 12) { // unpaid leave
				$data['leave_total'] = '-';
			}
			else { // others leave
				$data['leave_total'] = $data['leave_type']->total;				
			}

			// check leave taken
			$data['leave_taken'] = $this->leave_repo->getTakenLeave($user_id, $leave_type_id, $data['contract']->date_from, $data['contract']->date_to);

			// compare leave entitled and leave taken
			$data['no_bal'] = 0;
			if ($data['leave_total'] == $data['leave_taken']) {
				$data['no_bal'] = 1;
			}

			// check leave balance (all leave types)
			$balance = \IhrV2\Models\LeaveBalance::where('user_id', $user_id)
				->where('leave_type_id', $leave_type_id)
				->where('contract_id', $data['contract']->id)
				->first();
			// have record
			if ($balance) {
				$data['leave_balance'] = $balance->balance;
			}
			// no record
			else {
				if ($leave_type_id == 1) { // annual leave taken from total_al
					$data['leave_balance'] = $data['contract']->total_al;
				}
				else {
					$data['leave_balance'] = $data['leave_type']->total;
				}
			}
			return View('leave.create', $data);
		}
		else {
			return redirect()->route('sv.mod.leave.select');
		}	    	
    }





    public function storeLeaveCreate(Requests\LeaveCreate $request, \IhrV2\Models\LeaveApplication $leave_app)
    {
		$save = $leave_app->leave_create($request->all());	
        return redirect()->route($msg[2])->with([
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
