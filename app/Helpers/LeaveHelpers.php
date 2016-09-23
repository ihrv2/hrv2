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


	public static function CheckIfExpired($date) {
		$today_date = Carbon::now();
		$end_date = Carbon::createFromFormat('Y-m-d', $date);
		if ($today_date->gt($end_date)) {
			$x = 1;
		}
		else {
			$x = 0;
		}
		return $x;
	}



}