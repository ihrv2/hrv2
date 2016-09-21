<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDistrict extends Model
{

	protected $table = 'user_districts';


	public function SiteName() {
		return $this->belongsTo('\App\Models\Site', 'sitecode');
	}
    
}
