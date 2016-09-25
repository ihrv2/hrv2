<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeavePublic extends Model
{
    


    protected $table = 'leave_public';


    protected $fillable = [
    	''
    ];




	public function LeavePublicState() {
		return $this->hasMany('App\Models\LeavePublicState', 'leave_public_id');
	}




}
