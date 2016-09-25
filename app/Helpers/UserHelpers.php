<?php 

namespace IhrV2\Helpers;

class UserHelper {




	// position name
	public static function PositionName($x) {
		$q = \IhrV2\Models\Position::find($x);
		if (!empty($q)) {
			$z = $q->name;
		}
		else {
			$z = '-';
		}
		return $z;
	}


	public static function GroupName($x) {
		$q = Group::find($x);
		if (!empty($q)) {
			$z = $q->name;
		}
		else {
			$z = '-';
		}
		return $z;
	}





}


