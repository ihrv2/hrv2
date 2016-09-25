<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserDistrict extends Model
{

	protected $table = 'user_districts';


    protected $fillable = [
    	'user_id',
    	'sitecode'
    ];

	public function SiteName() {
		return $this->belongsTo('IhrV2\Models\Site', 'sitecode');
	}
    
}
