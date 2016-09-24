<?php namespace App\Repositories;

use App\User;
use Carbon\Carbon;

class UserRepository {



	// user
	public function getUserByID($id)
	{
		return User::firstOrFail($id);
	}

	public function getUserByIDToken($id, $token)
	{
		return User::where('id', $id)->where('api_token', $token)->firstOrFail();
	}




	// user contract
	public function getUserContractByID($id)
	{
		return \App\Models\UserContract::find($id);
	}

	public function getUserContractByToken()
	{

	}




	// user job


	// user education


	// user emergency contact


	// user employment


	// user families


	// user language


	// user photo


	// user reference


	// user skill




	// user status
	public function getUserStatusByID($id)
	{
		return \App\Models\UserStatus::find($id);

	}

	public function getUserStatusList()
	{
		return \App\Models\UserStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[User Status]', '');

	}




	// user contract status
	public function getUserContractStatusList()
	{
		return \App\Models\UserContractStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Contract Status]', '');
	}

	public function getUserContractStatusByID($id)
	{

	}





	// district
	public function getDistrictList()
	{
		return \App\Models\District::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[District]', '');

	}

	public function getDistrictByID($id)
	{
		return \App\Models\District::find($id);

	}



	// gender
	public function getGenderList()
	{
		return \App\Models\Gender::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Gender]', '');

	}

	public function getGenderByID($id)
	{
		return \App\Models\Gender::find($id);

	}




	// marital status
	public function getMaritalStatusList()
	{
		return \App\Models\MaritalStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Marital Status]', '');

	}

	public function getMaritalStatusByID($id)
	{
		return \App\Models\MaritalStatus::find($id);

	}



	// month
	public function getMonthList()
	{
		return \App\Models\Month::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Month]', '');

	}

	public function getMonthByID($id)
	{
		return \App\Models\Month::find($id);

	}




	// mukim
	public function getMukimList()
	{
		return \App\Models\Mukim::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Mukim]', '');

	}

	public function getMukimByID($id)
	{
		return \App\Models\Mukim::find($id);

	}



	// nationality
	public function getNationalityList()
	{
		return \App\Models\Nationality::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Nationality]', '');

	}

	public function getNationalityByID($id)
	{
		return \App\Models\Nationality::find($id);

	}



	// occupation
	public function getOccupationList()
	{
		return \App\Models\Occupation::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Occupation]', '');

	}

	public function getOccupationByID($id)
	{
		return \App\Models\Occupation::find($id);

	}




	// group
	public function getGroupList()
	{
		return \App\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group]', '');
	}

	public function getGroupAll()
	{

	}

	public function getGroupByID($id)
	{
		return \App\Models\Group::find($id);

	}



	// phase
	public function getPhaseList()
	{
		return \App\Models\Phase::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Phase]', '');
	}

	public function getPhaseAll()
	{

	}

	public function getPhaseByID($id)
	{
		return \App\Models\Phase::find($id);

	}



	// region
	public function getRegionList()
	{
		return \App\Models\Region::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Region]', '');
	}

	public function getRegionAll()
	{
		return \App\Models\Region::orderBy('name', 'ASC')->get();
	}

	public function getRegionByID($id)
	{
		return \App\Models\Region::find($id);

	}





	// site
	public function getSiteListWithID()
	{
		return \App\Models\Site::select(\DB::raw('concat (id, " - ", name) as name, id'))->orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Site]', '');
	}

	public function getSiteList()
	{
		return \App\Models\Site::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Site]', '');

	}

	public function getSiteAll()
	{

	}

	public function getSiteByID($id)
	{
		return \App\Models\Site::find($id);

	}



	// position
	public function getPositionByID($id)
	{
		return \App\Models\Position::find($id);
	}

	public function getPositionList()
	{
		return \App\Models\Position::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Position]', '');

	}

	public function getPositionAll()
	{

	}

	public function getPositionListByGroup($group_id)
	{
		return \App\Models\Position::where('group_id', $group_id)->orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Position]', '');
	}



	// project
	public function getProjectList()
	{
		return \App\Models\Project::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Project]', '');

	}

	public function getProjectByID($id)
	{
		return \App\Models\Project::find($id);

	}




	// race
	public function getRaceList()
	{
		return \App\Models\Race::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Race]', '');

	}

	public function getRaceByID($id)
	{
		return \App\Models\Race::find($id);

	}





	// religion
	public function getReligionList()
	{
		return \App\Models\Religion::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Religion]', '');

	}

	public function getReligionByID($id)
	{
		return \App\Models\Religion::find($id);

	}




	// skill level
	public function getSkillLevelList()
	{
		return \App\Models\SkillLevel::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Skill Level]', '');

	}

	public function getSkillLevelByID($id)
	{
		return \App\Models\SkillLevel::find($id);

	}




	// state
	public function getStateList()
	{
		return \App\Models\State::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[State]', '');

	}

	public function getStateByID($id)
	{
		return \App\Models\State::find($id);

	}




	// status
	public function getStatusList()
	{
		return \App\Models\Status::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Status]', '');

	}

	public function getStatusByID($id)
	{
		return \App\Models\Status::find($id);

	}












}



