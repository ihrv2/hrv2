<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeavePublic extends Model
{
    


    protected $table = 'leave_public';



	public function LeavePublicState() {
		return $this->hasMany('App\Models\LeavePublicState', 'leave_public_id');
	}




}
