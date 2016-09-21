<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Session;


class MaintenanceController extends Controller
{



	public function showPublicHoliday()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Define Public Holiday', 
			'child' => 'All Public Holiday',
			'icon' => 'list',
			'title' => 'Public Holiday'
		);		
		$i = \App\Models\LeavePublic::whereYear('date', '=', date('Y'))->orderBy('date', 'ASC');
		$data['leave_public'] = $i->get();	
		$data['sessions'] = array(
			'year' => date('Y')
		);				
		return View('modules.public-holiday.index', $data);
	}





	public function postPublicHoliday(Request $request)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Define Public Holiday', 
			'child' => 'All Public Holiday',
			'icon' => 'list',
			'title' => 'Public Holiday'
		);		
		$year = date('Y');
		$i = \App\Models\LeavePublic::select('*');
		if ($request->year) {
			Session::put('year', $request->year);
		}				
		if (Session::has('year')) {			
			$year = Session::get('year');
		}		
		$i->whereYear('date', '=', $year)->orderBy('date', 'ASC');
		$data['leave_public'] = $i->get();	
		$data['sessions'] = array(
			'year' => $year
		);			
		return View('modules.public-holiday.index', $data);
	}





	public function showRegion()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Region Administration', 
			'child' => 'All Region',
			'icon' => 'location-pin',
			'title' => 'Region / Reporting Officer'
		);		
		$i = \App\Models\Region::orderBy('regions.id', 'ASC');		
		$data['regions'] = $i->get();		
		return View('modules.region.index', $data);		
	}




	public function showRegionEdit($id)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Region Administration', 
			'child' => 'All Region',
			'child-a' => route('hr.mod.region'),			
			'icon' => 'pencil',
			'title' => 'Edit Region'
		);
		$data['detail'] = \App\Models\Region::find($id);
		$rid = $data['detail']->id;
		$data['users'] = \App\User::whereHas('UserLatestJob', function($j) use ($rid) {
				$j->where('region_id', $rid);
			})	
			->where('group_id', 4)	
			->orderBy('name', 'ASC')
			->lists('name', 'id');		
		return View('modules.region.edit', $data);
	}





	public function updateRegionEdit(Requests\RegionUpdate $request)
	{

	}



}


