<?php namespace App\Repositories;

use App\User;
use App\Models\LeaveApplication;

class LeaveRepository {



	public function getLeaveType()
	{
		return \App\Models\LeaveType::where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id')->prepend('[Leave Type]', '');
	}





}


