<?php namespace App\Repositories;

use App\User;
use App\Models\LeaveApplication;

class LeaveRepository {







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














	public function getLeaveType()
	{
		return \App\Models\LeaveType::where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[Leave Type]', '');
	}


	public function getLeaveTypeWithPrefix()
	{
		return \App\Models\LeaveType::select(\DB::raw('concat (code, " - ", name) as name, id'))->where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[Leave Type]', '');
	}


	public function getLeaveTypeName($id)
	{
		return \App\Models\LeaveType::find($id);
	}


	public function getUserJobByID($id)
	{
		\App\Models\UserJob::where('user_id', $id)->where('status', 1)->first();
	}



	public function getRegionManager($sitecode) {
		$x = \App\Models\Site::select('id', 'region_id')
		->where('id', $sitecode)
		->with(array('RegionName' => function($h) { 
			$h->select('id', 'name', 'report_to');
			$h->with('RegionManager');
		}))
		->first();
		return $x;
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







}


