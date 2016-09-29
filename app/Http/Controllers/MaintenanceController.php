<?php

namespace IhrV2\Http\Controllers;

use Illuminate\Http\Request;

use IhrV2\Http\Requests;
use Session;
use IhrV2\Repositories\UserRepository;


class MaintenanceController extends Controller
{



    private $user_repo;
	public function __construct(\IhrV2\Repositories\UserRepository $UserRepo)
	{
		$this->user_repo = $UserRepo;
	}




	// public holiday
	public function showPublicHoliday()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Define Public Holiday', 
			'child' => 'All Public Holiday',
			'icon' => 'list',
			'title' => 'Public Holiday'
		);		
		$i = \IhrV2\Models\LeavePublic::whereYear('date', '=', date('Y'))->orderBy('date', 'ASC');
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
		$i = \IhrV2\Models\LeavePublic::select('*');
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





	// region
	public function showRegionIndex()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Region Administration', 
			'child' => 'All Region',
			'icon' => 'location-pin',
			'title' => 'Region / Reporting Officer'
		);		
		$data['regions'] = $this->user_repo->getRegionAll();
		return View('modules.region.index', $data);		
	}

	public function showRegionEdit($id)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Region Administration', 
			'child' => 'All Region',
			'child-a' => route('mod.region.index'),			
			'icon' => 'pencil',
			'title' => 'Edit Region'
		);
		$data['detail'] = $this->user_repo->getRegionByID($id);
		$data['region_managers'] = \IhrV2\User::whereHas('UserLatestJob', function($j) use ($id) {
				$j->where('region_id', $id);
			})	
			->where('group_id', 4)
			->where('status', 1)	
			->orderBy('name', 'ASC')
			->lists('name', 'id');		
		return View('modules.region.edit', $data);
	}

	public function updateRegionEdit(Requests\RegionUpdate $request, $id)
	{
		$region = $this->user_repo->getRegionByID($id);
    	$save = $region->region_update($request->all());
        return redirect()->route('mod.region.index')->with([
            'message' => $save[0], 
            'label' => 'alert alert-'.$save[1].' alert-dismissible'
        ]);
	}




	// site
	public function showSiteIndex()
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Site Administration', 
			'child' => 'All Site',
			'icon' => 'flag',
			'title' => 'Site'
		);	
		$i = \IhrV2\Models\Site::orderBy('code', 'ASC');

		// check session
		if (Session::has('search')) {		
			$search = Session::get('search');					
			$i->where("sites.code", "like", "%".$search."%");
			$i->orWhere("sites.address", "like", "%".$search."%");
		}
		else {
			$search = null;
		}

		$data['sites'] = $i->paginate(20);	
		$data['sessions'] = array(
			'search' => $search
		);			
		return View('modules.site.index', $data);	
	}



	public function postSiteIndex(Request $request)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Site Administration', 
			'child' => 'All Site',
			'icon' => 'flag',
			'title' => 'Site'
		);	

		// register session
		if ($request->search && !empty($request->search)) {
			Session::put('search', $request->search);	
			$search = Session::get('search');		
		}	
		else {
			Session::forget('search');
			$search = null;			
		}

		// query 					
		$i = \IhrV2\Models\Site::orderBy('code', 'ASC');
		if (Session::has('search')) {	
			$i->where("sites.code", "like", "%".$search."%");
			$i->orWhere("sites.address", "like", "%".$search."%");
		}	
		$data['sites'] = $i->paginate(20);
		$data['sessions'] = array(
			'search' => $search
		);		
		return View('modules.site.index', $data);	
	}



	public function showSiteEdit($id)
	{
		$data = array();
		$data['header'] = array(
			'parent' => 'Site Administration', 
			'child' => 'All Site',
			'child-a' => route('mod.site.index'),			
			'icon' => 'flag',
			'title' => 'Edit Site'
		);
		$data['detail'] = $this->user_repo->getSiteByID($id);	
		return View('modules.site.edit', $data);
	}

	public function updateSiteEdit(Requests\SiteUpdate $request)
	{
		
	}

	public function createSiteAdd()
	{
		
	}

	public function storeSiteAdd()
	{
		
	}		



}


