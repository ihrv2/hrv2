<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveState extends Model
{
    //
	protected $table = 'leave_states';


	public function StateName() {
		return $this->belongsTo('\App\Models\State', 'state_id');
	}		
	

    
}
