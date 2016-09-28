<?php namespace IhrV2\Repositories;

use IhrV2\User;
use IhrV2\Models\LeaveApplication;
use Carbon\Carbon;

class LeaveRepository {


	public function getLeaveType()
	{
		return \IhrV2\Models\LeaveType::where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[Leave Type]', '');
	}


	public function getLeaveTypeWithPrefix()
	{
		return \IhrV2\Models\LeaveType::select(\DB::raw('concat (code, " - ", name) as name, id'))->where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[Leave Type]', '');
	}


	public function getLeaveTypeName($id)
	{
		return \IhrV2\Models\LeaveType::find($id);
	}




	// get this when to create / update user_contracts row
	public function getTotalAL($from_date, $to_date) {
		$leap = 0;
		$from = Carbon::parse($from_date); // 2016-01-01
		$to = Carbon::parse($to_date); // 2016-12-01

		// get different date
		$diff = $from->diff($to)->days;

		// check leap year
		if ($to->isLeapYear()) {
			$leap = 1;		
			$total = round(($diff / 366) * 12);
		}
		else {
			$total = round(($diff / 365) * 12);
		}
		return $total;
	}	




	public function CheckIfExpired($date) {
		$today_date = Carbon::now();
		$end_date = Carbon::createFromFormat('Y-m-d', $date);
		if ($today_date->gt($end_date)) {
			$x = 1;
		}
		else {
			$x = 0;
		}
		return $x;
	}



	public function DateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {
	    $dates = array();
	    $current = strtotime($first);
	    $last = strtotime($last);
	    while( $current <= $last ) {
	        $dates[] = date($output_format, $current);
	        $current = strtotime($step, $current);
	    }
	    return $dates;
	}



	public function getUserStateID($sitecode) {
		$x = \IhrV2\Models\Site::where('id', $sitecode)->first();
		return $x;
	}	





	// get taken leave (date is within the current contract)
	public function getLeaveTaken($uid, $leave_type_id, $date1, $date2)
	{
		$filters = array($date1, $date2);
		$total = 0;				
		$query = \IhrV2\Models\LeaveApplication::whereHas('LeaveApprove', function($x) use ($filters) { 
			$x->whereDate('date_from', '>=', $filters[0]);
			$x->whereDate('date_to', '<=', $filters[1]);
		})
		->with('LeaveApprove')	
		->where('user_id', $uid)
		->where('leave_type_id', $leave_type_id)
		->get();
		if (count($query) > 0) {
			foreach ($query as $i) {
				$total += $i->LeaveApprove->date_value;
			}
		}
		return $total;	
	}




	public function getLeaveEntitled($user_id, $leave_type_id)
	{
		if ($leave_type_id == 1) {
			$query = \IhrV2\Models\UserContract::where('user_id', $user_id)->where('status', 1)->first();
			$total = $query->total_al;
		}
		else {
			$query = \IhrV2\Models\LeaveType::find($leave_type_id);
			$total = $query->total;
		}
		return $total;
	}




	public function getLeaveBalance($user_id, $leave_type_id, $contract_id)
	{
		$query = \IhrV2\Models\LeaveBalance::where('user_id', $user_id)
			->where('leave_type_id', $leave_type_id)
			->where('contract_id', $contract_id)
			->first();
		return $query;
	}




	// leave application


	// leave approve


	// leave attachment


	// leave balance


	// leave date


	// leave extra


	// leave history


	// leave public
	public function getLeavePublicList()
	{

	}

	public function getLeavePublicByID()
	{

	}

	public function getLeavePublicAll()
	{
		
	}


	// leave public date




	// leave status
	public function getLeaveStatusList()
	{
		return \IhrV2\Models\LeaveStatus::orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[All Status]', '');
	}

	public function getLeaveStatusByID()
	{

	}

	public function getLeaveStatusAll()
	{

	}




	// leave type
	public function getLeaveTypeList()
	{
	}

	public function getLeaveTypeByID($leave_type_id)
	{
		return \IhrV2\Models\LeaveType::find($leave_type_id);
	}

	public function getLeaveTypeAll()
	{

	}





	// replacement leave application


	// replacement leave approve


	// replacement leave attachment


	// replacement leave history


	// 


















}


