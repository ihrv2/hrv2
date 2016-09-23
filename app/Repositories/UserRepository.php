<?php namespace App\Repositories;

use App\User;
use Carbon\Carbon;

class UserRepository {


	public function getUserDetailByID($id)
	{
		return User::find($id);
	}


	public function getUserDetailByToken($id, $token)
	{
		return User::where('id', $id)->where('api_token', $token)->first();
	}


	public function getUserContractStatus()
	{
		return \App\Models\UserContractStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Contract Status]', '');
	}


	public function getGroup()
	{
		return \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group]', '');
	}


	public function getPhase()
	{
		return \App\Models\Phase::orderBy('name', 'ASC')->lists('name', 'id');
	}


	public function getRegion()
	{
		return \App\Models\Region::orderBy('name', 'ASC')->lists('name', 'id');
	}


	public function getSite()
	{
		return \App\Models\Site::select(\DB::raw('concat (id, " - ", name) as name, id'))->orderBy('name', 'ASC')->lists('name', 'id');
	}


	public function getPositionName($id)
	{
		return \App\Models\Position::find($id);
	}


}



