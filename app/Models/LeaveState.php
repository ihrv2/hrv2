<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveState extends Model
{
    //
	protected $table = 'leave_states';


    protected $fillable = [
    	''
    ];



	public function StateName() {
		return $this->belongsTo('IhrV2\Models\State', 'state_id');
	}		
	

    
}
