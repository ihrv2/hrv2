<?php 

namespace App\Helpers;

use Carbon\Carbon;

class LeaveHelper {


	public static function getTotalAL($from_date, $to_date) {
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


}