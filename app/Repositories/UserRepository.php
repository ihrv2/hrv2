<?php namespace IhrV2\Repositories;

use IhrV2\User;
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
		return \IhrV2\Models\UserContract::find($id);
	}

	public function getUserContractByToken()
	{

	}

	public function getUserContractWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserContract::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}







	// user job
	public function getUserJobWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserJob::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}




	// user education
	public function getUserEducationWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserEducation::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user emergency contact
	public function getUserEmergencyWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserEmergency::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}







	// user employment
	public function getUserEmploymentWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserEmployment::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user families
	public function getUserFamilyWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserFamily::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user language
	public function getUserLanguageWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserLanguage::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user photo
	public function getUserPhotoWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserPhoto::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user reference
	public function getUserReferenceWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserReference::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}





	// user skill
	public function getUserSkillWithUser($id, $uid, $token)
	{
		$filters = array('id' => $uid, 'api_token' => $token);
		$query = \IhrV2\Models\UserSkill::whereHas('UserDetail', function($x) use ($filters) { 
		    foreach ($filters as $column => $key) {
		        if (!is_null($key)) $x->where($column, $key);
		    }
		})
		->where('id', $id)
		->firstOrFail();	
		return $query;	
	}






	// user status
	public function getUserStatusByID($id)
	{
		return \IhrV2\Models\UserStatus::find($id);

	}

	public function getUserStatusList()
	{
		return \IhrV2\Models\UserStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[User Status]', '');

	}




	// user contract status
	public function getUserContractStatusList()
	{
		return \IhrV2\Models\UserContractStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Contract Status]', '');
	}

	public function getUserContractStatusByID($id)
	{

	}





	// district
	public function getDistrictList()
	{
		return \IhrV2\Models\District::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[District]', '');

	}

	public function getDistrictByID($id)
	{
		return \IhrV2\Models\District::find($id);

	}



	// gender
	public function getGenderList()
	{
		return \IhrV2\Models\Gender::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Gender]', '');

	}

	public function getGenderByID($id)
	{
		return \IhrV2\Models\Gender::find($id);

	}




	// marital status
	public function getMaritalStatusList()
	{
		return \IhrV2\Models\MaritalStatus::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Marital Status]', '');

	}

	public function getMaritalStatusByID($id)
	{
		return \IhrV2\Models\MaritalStatus::find($id);

	}



	// month
	public function getMonthList()
	{
		return \IhrV2\Models\Month::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Month]', '');

	}

	public function getMonthByID($id)
	{
		return \IhrV2\Models\Month::find($id);

	}




	// mukim
	public function getMukimList()
	{
		return \IhrV2\Models\Mukim::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Mukim]', '');

	}

	public function getMukimByID($id)
	{
		return \IhrV2\Models\Mukim::find($id);

	}



	// nationality
	public function getNationalityList()
	{
		return \IhrV2\Models\Nationality::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Nationality]', '');

	}

	public function getNationalityByID($id)
	{
		return \IhrV2\Models\Nationality::find($id);

	}



	// occupation
	public function getOccupationList()
	{
		return \IhrV2\Models\Occupation::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Occupation]', '');

	}

	public function getOccupationByID($id)
	{
		return \IhrV2\Models\Occupation::find($id);

	}




	// group
	public function getGroupList()
	{
		return \IhrV2\Models\Group::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Group]', '');
	}

	public function getGroupAll()
	{

	}

	public function getGroupByID($id)
	{
		return \IhrV2\Models\Group::find($id);

	}



	// phase
	public function getPhaseList()
	{
		return \IhrV2\Models\Phase::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Phase]', '');
	}

	public function getPhaseAll()
	{

	}

	public function getPhaseByID($id)
	{
		return \IhrV2\Models\Phase::find($id);

	}



	// region
	public function getRegionList()
	{
		return \IhrV2\Models\Region::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Region]', '');
	}

	public function getRegionAll()
	{
		return \IhrV2\Models\Region::orderBy('name', 'ASC')->get();
	}

	public function getRegionByID($id)
	{
		return \IhrV2\Models\Region::find($id);

	}





	// site
	public function getSiteListWithID()
	{
		return \IhrV2\Models\Site::select(\DB::raw('concat (id, " - ", name) as name, id'))->orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Site]', '');
	}

	public function getSiteList()
	{
		return \IhrV2\Models\Site::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Site]', '');

	}

	public function getSiteAll()
	{

	}

	public function getSiteByID($id)
	{
		return \IhrV2\Models\Site::find($id);

	}



	// position
	public function getPositionByID($id)
	{
		return \IhrV2\Models\Position::find($id);
	}

	public function getPositionList()
	{
		return \IhrV2\Models\Position::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Position]', '');

	}

	public function getPositionAll()
	{

	}

	public function getPositionListByGroup($group_id)
	{
		return \IhrV2\Models\Position::where('group_id', $group_id)->orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Position]', '');
	}



	// project
	public function getProjectList()
	{
		return \IhrV2\Models\Project::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Project]', '');

	}

	public function getProjectByID($id)
	{
		return \IhrV2\Models\Project::find($id);

	}




	// race
	public function getRaceList()
	{
		return \IhrV2\Models\Race::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Race]', '');

	}

	public function getRaceByID($id)
	{
		return \IhrV2\Models\Race::find($id);

	}





	// religion
	public function getReligionList()
	{
		return \IhrV2\Models\Religion::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Religion]', '');

	}

	public function getReligionByID($id)
	{
		return \IhrV2\Models\Religion::find($id);

	}




	// skill level
	public function getSkillLevelList()
	{
		return \IhrV2\Models\SkillLevel::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Skill Level]', '');

	}

	public function getSkillLevelByID($id)
	{
		return \IhrV2\Models\SkillLevel::find($id);

	}




	// state
	public function getStateList()
	{
		return \IhrV2\Models\State::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[State]', '');

	}

	public function getStateByID($id)
	{
		return \IhrV2\Models\State::find($id);

	}




	// status
	public function getStatusList()
	{
		return \IhrV2\Models\Status::orderBy('name', 'ASC')->pluck('name', 'id')->prepend('[Status]', '');

	}

	public function getStatusByID($id)
	{
		return \IhrV2\Models\Status::find($id);

	}












}



