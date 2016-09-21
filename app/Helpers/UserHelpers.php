<?php 

namespace App\Helpers;

class UserHelper {




	// position name
	public static function PositionName($x) {
		$q = \App\Models\Position::find($x);
		if (!empty($q)) {
			$z = $q->name;
		}
		else {
			$z = '-';
		}
		return $z;
	}






}


