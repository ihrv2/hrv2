<?php 

namespace App\Helpers;

class ErpHelper {

	// check status employment
	public static function StatusEmployment($x) {
		if ($x == 'Active') {
			$y = 1;
		}
		else if ($x == 'Not Active') {
			$y = 2;
		}
		else if ($x == 'Transfer') {
			$y = 3;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	public static function TitleName($x) {
		if ($x == 'Encik') {
			$y = 1;
		}
		else if ($x == 'Cik') {
			$y = 2;
		}
		else if ($x == 'Puan') {
			$y = 3;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	public static function GenderName($x) {
		if ($x == 'Male') {
			$y = 1;
		}
		else if ($x == 'Female') {
			$y = 2;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	public static function MaritialStatus($x) {
		if ($x == 'Single') {
			$y = 1;
		}
		else if ($x == 'Married') {
			$y = 2;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	public static function RaceName($x) {
		if ($x == 'Melayu') {
			$y = 1;
		}
		else if ($x == 'Cina') {
			$y = 2;
		}		
		else if ($x == 'India') {
			$y = 3;
		}		
		else if ($x == 'Lain-Lain') {
			$y = 4;
		}				
		else {
			$y = 0;
		}
		return $y;
	}

	public static function ReligionName($x) {
		if ($x == 'Islam') {
			$y = 1;
		}
		else if ($x == 'Kristian') {
			$y = 2;
		}		
		else if ($x == 'Buddha') {
			$y = 3;
		}		
		else if ($x == 'Hindu') {
			$y = 4;
		}		
		else if ($x == 'Lain-Lain') {
			$y = 5;
		}				
		else {
			$y = 0;
		}
		return $y;
	}

	public static function Nationality($x) {
		if ($x == 'Maaysia' || $x == 'Warganegara') {
			$y = 1;
		}
		else if ($x == 'Bukan Warganegara') {
			$y = 2;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	public static function JobStatus($x) {
		if ($x == 'Contract') {
			$y = 1;
		}
		else if ($x == 'Permanent') {
			$y = 2;
		}		
		else {
			$y = 0;
		}
		return $y;
	}

	// get screenshots from erp tables (shuhada)
	public static function StateName($x) {
		if ($x == 0) { // all
			$y = 0;
		}
		else if ($x == 1) { // perlis
			$y = 508;
		}	
		else if ($x == 2) { // perak
			$y = 507;
		}	
		else if ($x == 3) { // kedah
			$y = 502;
		}	
		else if ($x == 4) { // selangor
			$y = 512;
		}	
		else if ($x == 5) { // negeri sembilan
			$y = 505;
		}	
		else if ($x == 6) { // melaka
			$y = 504;
		}	
		else if ($x == 7) { // kelantan
			$y = 503;
		}	
		else if ($x == 8) { // pahang
			$y = 506;
		}	
		else if ($x == 9) { // terengganu
			$y = 513;
		}	
		else if ($x == 10) { // sarawak
			$y = 511;
		}	
		else if ($x == 11) { // sabah
			$y = 510;
		}	
		else if ($x == 12) { // johor
			$y = 501;
		}	
		else {
			$y = 0;
		}	
		return $y;			
	}

	public static function JobTitle($x) {
		if ($x == 'Assistant Manager') {
			$y = 4;
		}
		else if ($x == 'Manager') {
			$y = 3;
		}
		else if ($x == 'IT Supervisor') {
			$y = 5;
		}
		else if ($x == 'Supervisor') {
			$y = 9;
		}	
		else if ($x == 'Part Time') {
			$y = 6;
		}
		else if ($x == 'Penyelia IT') {
			$y = 8;
		}	
		else if ($x == 'HR Officer' || $x == 'HR Assistant' || $x == 'Junior HR Officer' || $x == 'Senior HR  Executive') {
			$y = 2;
		}	
		else if ($x == 'Regional Manager (Southern)' || $x == 'Regional Manager (Sabah & Sarawak)' || $x == 'Regional Manager (Kelantan & Terengganu)' || $x == 'Regional Manager (Northern)' || $x == 'Regional Manager (Pahang)' || 'Regional Manager (Central)') {
			$y = 7;
		}	
		else {
			$y = 9;
		}	
		return $y;	
	}


	public static function GenerateKey() {
		$x = base_convert(microtime(false), 10, 36);
		return $x;
	}


}


