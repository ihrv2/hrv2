<?php

namespace App\Models;

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
		return $this->belongsTo('App\Models\State', 'state_id');
	}	


    
}
