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
	public function getTakenLeave($uid, $leave_type_id, $date1, $date2)
	{
		$filters = array('date_from' => $date1, 'date_to' => $date2);
		$query = \IhrV2\Models\LeaveApplication::whereHas('LeaveApprove', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('user_id', $uid)
		->where('leave_type_id', $leave_type_id)
		->get();	
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

	public function getLeaveTypeByID()
	{

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


