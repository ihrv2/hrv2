<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;




class LeaveApplication extends Model
{
    //


	protected $table = 'leave_applications';



    protected $fillable = [
        'user_id', 
        'leave_type_id', 
        'date_apply', 
        'report_to', 
        'date_from', 
        'date_to',
        'is_half_day',        
        'desc',
        'sitecode',
        'active'
    ];



    public function setDateApplyAttribute($date)
    {
    	// $this->attributes['date_apply'] = Carbon::createFromFormat('Y-m-d', $date); // with date and time
    	$this->attributes['date_apply'] = Carbon::parse($date); // only date
    }


	public function LeaveUserDetail() {
		return $this->belongsTo('App\Models\User', 'user_id');
	}

	public function LeaveSiteName() {
		return $this->belongsTo('App\Models\Site', 'sitecode');
	}	

	// belongs to
	public function LeaveTypeName() {
		return $this->belongsTo('App\Models\LeaveType', 'leave_type_id');
	}

	public function LeaveReportToName() {
		return $this->belongsTo('App\Models\User', 'report_to');
	}

	// get only latest history
	public function LeaveLatestHistory() {
		return $this->hasOne('App\Models\LeaveHistory', 'leave_id')->where('flag', 1);
	}

	public function LeavePending() {
		return $this->hasOne('App\Models\LeaveHistory', 'leave_id')->where('flag', 1)->where('status', 1);
	}

	// hasmany
	public function LeaveAllHistory() {
		return $this->hasMany('App\Models\LeaveHistory', 'leave_id');
	}

	public function LeaveDateAll() {
		return $this->hasMany('App\Models\LeaveDate', 'leave_id');
	}
		
	public function LeaveDate() {
		return $this->hasMany('App\Models\LeaveDate', 'leave_id')->where('status', '=', 1);
	}







	public function leave_create($data) 
	{
		$d1 = array(
			'user_id' => 1,
			'leave_type_id' => 1,
			'date_apply' => '2016-01-01',
			'report_to' => 1,
			'date_from' => date('Y-m-d'),
			'date_to' => date('Y-m-d'),
			'is_half_day' => 1,
			'desc' => 'test',
			'sitecode' => 'X01C001',
			'active' => 1,
		);
        $l = new App\Models\LeaveApplication($d1);        
        $l->save();		
		$msg = array('message' => 'Leave successfully added.', 'label' => 'success');			
		return $msg;
	}	





	public function leave_update()
	{

	}



}
