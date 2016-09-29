<?php 

namespace IhrV2\Helpers;

class UserHelper {

	// user for backend


	// position name
	public static function UserJobInfo($x) {
		return \IhrV2\Models\UserJob::where('user_id', $x)->first();
	}


	// region manager name
	public static function getRegionManager($sitecode) {
		$x = \IhrV2\Models\Site::select('code', 'region_id')
		->where('code', $sitecode)
		->with(array('RegionName' => function($h) { 
			$h->select('id', 'name', 'report_to');
			$h->with('RegionManager');
		}))
		->first();
		return $x;
	}





}


