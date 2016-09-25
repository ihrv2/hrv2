<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class LeavePublicState extends Model
{
    protected $table = 'leave_public_states';
    

    protected $fillable = [
    	'leave_public_id',
    	'date',
    	'state_id'
    ];



	public function StateName() {
		return $this->belongsTo('IhrV2\Models\State', 'state_id');
	}	


    
}
