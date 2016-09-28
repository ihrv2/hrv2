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
		$year = date('Y'); 
		$filters = [
			'flag' => 1,		
		];
		$i = \IhrV2\Models\LeaveApplication::whereHas('LeaveLatestHistory', function($q) use ($filters) {
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $q->where($column, $key);
		    }
		})
		->with(array('LeaveLatestHistory' => function($h) { 
			$h->with('LeaveStatusName');
			$h->where('flag', 1);
		}))
		->with('LeaveTypeName')
		->with('LeaveDate')
		->with('LeaveDateAll')
    	->where('user_id', \Auth::id())
    	->where('leave_type_id', '!=', 6)
    	->whereYear('date_from', '=', $year)
    	->whereYear('date_to', '=', $year)	
		->orderBy('id', 'DESC')
		->get();
		$data['leaves'] = $i;
		$data['types'] = \IhrV2\Models\LeaveType::where('id', '!=', 6)->get();
		$data['leave_status'] = $this->leave_repo->getLeaveStatusList();
		$data['sessions'] = array(
			'year' => $year,
			'leave_status' => null
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
        	return redirect()->route('sv.leave.create')->withInput();
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

			$data['leave_type'] = \IhrV2\Models\LeaveType::find($leave_type_id);			
			$data['job'] = $this->user_repo->getUserJobByID($user_id);					
			$data['rm'] = $this->user_repo->getRegionManager(\Auth::user()->sitecode);

			// check if reporting officer is not set
			if (!$data['rm']['RegionName']['RegionManager']) {
				return redirect()->route('sv.leave.select')
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
			else { // others leave
				$data['leave_total'] = $data['leave_type']->total;				
			}

			// check leave taken
			$data['leave_taken'] = $this->leave_repo->getLeaveTaken($user_id, $leave_type_id, $data['contract']->date_from, $data['contract']->date_to);

			// total leave is 0
			if ($data['leave_total'] < 1) {
				return redirect()->route('sv.leave.select')
					->with('message', 'Entitled Leave is empty. Please contact HR.')
					->with('label', 'alert alert-danger alert-dismissible');				
			}

			// leave entitled and leave taken is same 		
			if ($data['leave_total'] == $data['leave_taken']) {
				return redirect()->route('sv.leave.select')
					->with('message', 'Balance is empty. Please contact HR.')
					->with('label', 'alert alert-danger alert-dismissible');				
			}

			// check leave balance (all leave types)
			$balance = \IhrV2\Models\LeaveBalance::where('user_id', $user_id)
				->where('leave_type_id', $leave_type_id)
				->where('contract_id', $data['contract']->id)
				->first();
			if ($balance) {

				// check balance on the fly and leave_balances
				if ($balance->balance != ($data['leave_total'] - $data['leave_taken'])) {
					return redirect()->route('sv.leave.select')
						->with('message', 'Leave Balance is incorrect. Please contact HR.')
						->with('label', 'alert alert-danger alert-dismissible');						
				}
				$data['leave_balance'] = $balance->balance;
			}
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
			return redirect()->route('sv.leave.select');
		}	    	
    }





    public function storeLeaveCreate(Requests\LeaveApplicationCreate $request, \IhrV2\Models\LeaveApplication $leave_app)
    {
		$save = $leave_app->leave_create($request->all());	
        return redirect()->route($save[2])->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
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
			'child-a' => route('sv.leave.replacement.index'),			
			'icon' => 'note',
			'title' => 'Add Replacement Leave'
		);			
		return View('replacement-leave.add', $data);	    	
    }


    
    public function storeLeaveRepCreate()
    {

    }


}
