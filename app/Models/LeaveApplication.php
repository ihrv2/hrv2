<?php

namespace IhrV2\Models;



use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use IhrV2\Repositories\LeaveRepository;
use IhrV2\Repositories\UserRepository;



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
		return $this->belongsTo('IhrV2\Models\User', 'user_id');
	}

	public function LeaveSiteName() {
		return $this->belongsTo('IhrV2\Models\Site', 'sitecode');
	}	

	// belongs to
	public function LeaveTypeName() {
		return $this->belongsTo('IhrV2\Models\LeaveType', 'leave_type_id');
	}

	public function LeaveReportToName() {
		return $this->belongsTo('IhrV2\Models\User', 'report_to');
	}

	// get only latest history
	public function LeaveLatestHistory() {
		return $this->hasOne('IhrV2\Models\LeaveHistory', 'leave_id')->where('flag', 1);
	}

	public function LeavePending() {
		return $this->hasOne('IhrV2\Models\LeaveHistory', 'leave_id')->where('flag', 1)->where('status', 1);
	}

	// hasmany
	public function LeaveAllHistory() {
		return $this->hasMany('IhrV2\Models\LeaveHistory', 'leave_id');
	}

	public function LeaveDateAll() {
		return $this->hasMany('IhrV2\Models\LeaveDate', 'leave_id');
	}
		
	public function LeaveDate() {
		return $this->hasMany('IhrV2\Models\LeaveDate', 'leave_id')->where('status', '=', 1);
	}



	public function LeaveApprove() {
		return $this->hasOne('IhrV2\Models\LeaveApprove', 'leave_id')->where('flag', 1);
	}



	public function leave_create($data) 
	{
		$msg = array();
		$invalid = 0;
		$status = 0;
		$balance = 0;
		$more = 0;
		$success = 0;
		$email = 0;

		$user_id = \Auth::id();
		$leave_repo = new LeaveRepository;

		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check date to
		if (!empty($data['date_to'])) {
			$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d');
		}
		else {
			// get date to automatically
			$to = Carbon::createFromFormat('d/m/Y', $data['date_from'])->addDays(2)->toDateTimeString();
		}

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true

			// get date range
			$duration = $leave_repo->DateRange($from, $to);	

			// check if selected date is more than entitled leave 
			if (!in_array($data['leave_type_id'], array(1, 6, 12))) { // exclude annual/replacement/unpaid
				$type = \IhrV2\Models\LeaveType::where('id', $data['leave_type_id'])->first(); // get total from leave_types
				if (count($duration) > $type->total) {
					$more = 1; // skip insert leave
				}
			}

			if ($more != 1) {
				// check record on leave_balances
				$q = \IhrV2\Models\LeaveBalance::where('user_id', $user_id)
					->where('leave_type_id', $data['leave_type_id'])
					->where('contract_id', 1)
					->first();		
				if ($q) {	
					// no balance leave
					if ($q->balance == 0) {
						$balance = 2; // skip insert leave
					}
					// balance still have value
					else {
						$status = 1;
						$balance = 0;
					}
				}
				// no record on leave_balances
				else {
					$status = 1;
					$balance = 1;
				}
			}

			if ($status == 1 && $more != 1) {
				// insert leave_applications
				$this->user_id = $user_id;
				$this->leave_type_id = $data['leave_type_id'];
				$this->date_apply = date('Y-m-d');
				$this->report_to = $data['report_to'];
				$this->date_from = $from;
				$this->date_to = $to;			
				if (!empty($data['is_half_day'])) {
					$this->is_half_day = $data['is_half_day'];
				}
				$this->desc = $data['desc'];
				$this->sitecode = \Auth::user()->sitecode;
				$this->active = 1; // leave active
				$this->save();


				// check public holiday date
				$s = $leave_repo->getUserStateID(\Auth::user()->sitecode);
				$s_p = array();			
				if ($s) {
					$state_id = $s->state_id;

					// get public date of current state and state_id equal 0 (all states)
					$p = \IhrV2\Models\LeavePublicState::where('state_id', $state_id)->orWhere('state_id', 0)->get();
					if ($p) {
						foreach ($p as $date) {
							$s_p[] = $date->date;
						}					
					}
				}

				// insert leave_dates
				$d = array();		
				$day = 0;	
				foreach ($duration as $date) {
					if (in_array($date, $s_p)) {
						$status = 0; // selected date is on public holiday (reject)
					}
					else {
						$status = 1;
						$day++;
					}
					$d = array(
						'user_id' => $user_id,			
						'leave_id' => $leave_id,
						'leave_date' => $date,
						'status' => $status,
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					\IhrV2\Models\LeaveDate::insert($d);
				}
				
				// insert leave_histories
				$h = new \IhrV2\Models\LeaveHistory();
				$h->user_id = $user_id;
				$h->leave_id = $leave_id;
				$h->action_date = date('Y-m-d');
				$h->action_remark = '';
				$h->status = 1; // pending
				$h->flag = 1; // active 1st
				$h->save();

				// check if have attachment
				if ($data['leave_file']) {			

				}	
				$success = 1;	
			}

			if ($balance == 1 && $more != 1) {
				// insert leave_balances									
				if ($data['leave_type_id'] == 1) { // annual lave
					
					// get total entitled days from contract date
					$total = $leave_repo->getTotalAL($data['contract_date_from'], $data['contract_date_to']); 					
				}
				else {
					// get total entitled days from leave_types
					$t = \IhrV2\Models\LeaveType::where('id', $data['leave_type_id'])->first(); 
					$total = $t->total;
				}

				// get contract id
				$c = \IhrV2\Models\UserContract::where('user_id', $user_id)->where('status', 1)->first();

				$b = new \IhrV2\Models\LeaveBalance();
				$b->user_id = $user_id;
				$b->leave_type_id = $data['leave_type_id'];
				$b->balance = $total;
				$b->contract_id = 0;
				$b->year = date('Y');
				$b->save();
				$success = 1;				
			}
		} 
		else {
			$invalid = 1;
		}
		// end check invalid

		// return message
		if ($invalid == 1) {
			$msg = array('Selected Date is invalid.', 'danger', 'sv.mod.leave.select');
		}
		if ($more == 1) {
			$msg = array('Total selected days is more than entitled leave.', 'danger', 'sv.mod.leave.select');				
		}
		if ($balance == 2) {
			$msg = array('Entitled Leave currently empty.', 'danger', 'sv.mod.leave.select');
		}
		if ($success == 1) {
			$msg = array('Leave successfully added.', 'success', 'sv.mod.leave.index');
		}

		// send email notification to regional manager
		if ($email == 1) {
			$user_repo = new UserRepository;
			$rm = $user_repo->getRegionManager(\Auth::user()->sitecode);
			if ($rm) {
				// $name = $rm['region_name']['region_manager']['name'];
				// $email = $rm['region_name']['region_manager']['work_email'];
			}
		}
		return $msg;
	}	





	public function leave_update()
	{

	}



}
