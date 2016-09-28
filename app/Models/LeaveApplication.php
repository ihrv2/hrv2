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
		return $this->belongsTo('IhrV2\User', 'user_id');
	}

	public function LeaveSiteName() {
		return $this->belongsTo('IhrV2\Models\Site', 'sitecode');
	}	

	// belongs to
	public function LeaveTypeName() {
		return $this->belongsTo('IhrV2\Models\LeaveType', 'leave_type_id');
	}

	public function LeaveReportToName() {
		return $this->belongsTo('IhrV2\User', 'report_to');
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
		$invalid = 0; // 1 = date range is incorrect
		$balance = 0; // 1 = no record | 2 = no balance or equal entitled | 3 = have balance
		$more = 0; // 1 = total apply leave more than entitled
		$success = 0; // 1 = success insert new leave
		$empty = 0; // 1 = entitled is 0
		$tally = 0; // 1 = total balance on db and (entitled - taken) is same

		$user_id = \Auth::id();
		$leave_type_id = $data['leave_type_id'];
		$leave_repo = new LeaveRepository;
		$user_repo = new UserRepository;

		$leave_type = $leave_repo->getLeaveTypeByID($leave_type_id);
		$contract = $user_repo->getUserContractByUserIDStatus($user_id);

		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check date to
		if (empty($data['date_to'])) {
			$to = Carbon::createFromFormat('d/m/Y', $data['date_from'])->addDays($leave_type->total)->subDay(1)->toDateTimeString();
		}
		else {
			$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d');
		}

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) {

			// get date range
			$duration = $leave_repo->DateRange($from, $to);	

			// check entitled leave 
			if ($leave_type_id == 1) {
				$entitled = $contract->total_al;
				if (count($duration) > $contract->total_al) {
					$more = 1; // skip insert leave
				}
			}
			else {
				$entitled = $leave_type->total;
				if (count($duration) > $leave_type->total) {
					$more = 1; 
				}
			}

			// annual leave is 0 when contract date is short / total at leave type is 0
			if ($entitled == 0) { 
				$empty = 1;
			}

			// selected date is valid and have entitled
			if ($more != 1 && $empty != 1) {				
				// check leave taken
				$taken = $leave_repo->getLeaveTaken($user_id, $leave_type_id, $contract->date_from, $contract->date_to);
				
				// taken and entitled same
				if ($taken == $entitled) { 
					$balance = 2;
				}

				// calculate balance 
				$bal = $entitled - $taken;

				// check balance at leave_balances
				$check_bal = $leave_repo->getLeaveBalance($user_id, $leave_type_id, $contract->id);	
				if ($check_bal) {	
					// no balance leave
					if ($check_bal->balance == 0) {
						$balance = 2;
					}
					// have balance 
					else {
						$balance = 3;
						if ($check_bal->balance == $bal) {
							$tally = 1;
						}
					}
				}
				// no record on leave_balances
				else {
					$balance = 1;
				}
			}

			// balance is tally or no record on leave_balances
			if ($tally == 1 || $balance == 1) {
				// insert leave_applications
				$this->user_id = $user_id;
				$this->leave_type_id = $leave_type_id;
				$this->date_apply = date('Y-m-d');
				$this->report_to = $data['report_to'];
				$this->date_from = $from;
				$this->date_to = $to;			
				if (!empty($data['is_half_day']) && count($duration) == 1) {
					$this->is_half_day = $data['is_half_day'];
				}
				$this->desc = $data['desc'];
				$this->sitecode = \Auth::user()->sitecode;
				$this->active = 1;
				$this->save();
				$leave_id = $this->id;

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
						'status' => $status
					);
					$ld = new \IhrV2\Models\LeaveDate($d);
					$ld->save();					
				}
				
				// insert leave_histories
                $dh = array(
                    'user_id' => $user_id,
                    'leave_id' => $leave_id,
                    'action_date' => date('Y-m-d'),
                    'action_remark' => '',
                    'status' => 1, // pending
                    'flag' => 1, // active 1st
                );				
				$lh = new \IhrV2\Models\LeaveHistory($dh);
				$lh->save();
	
				// insert leave_balances
				if ($balance == 1) {
					$db = array(
						'user_id' => $user_id,
						'leave_type_id' => $leave_type_id,
						'balance' => $entitled,
						'contract_id' => $contract->id,
						'year' => date('Y')
					);
					$lb = new \IhrV2\Models\LeaveBalance($db); 
					$lb->save();
				}

				// check if have attachment
				if (!empty($data['leave_file'])) {		
					$file = $data['leave_file'];
					$path = public_path().'/assets/files/leave/';
					$filename = date('YmdHis').'_'.\Auth::user()->sitecode.'_'.str_random(20);
					$fileext = $file->getClientOriginalExtension();
					$filesize = $file->getSize();						
					$filenew = $filename.'.'.$fileext;
					$upload = $file->move($path, $filenew);

					// insert leave_attachments
					$da = array(
						'user_id' => $user_id,
						'leave_id' => $leave_id,
						'filename' => $filename,
						'ext' => $fileext,
						'size' => $filesize,
						'status' => 1
					);
					$la = new \IhrV2\Models\LeaveAttachment($da);
					$la->save();
				}

				// return success
				$success = 1;	
			}
		} 
		else {
			$invalid = 1;
		}
		// end check invalid

		// return message
		if ($invalid == 1) {
			$msg = array('Selected Date is invalid.', 'danger', 'sv.leave.select');
		}
		if ($more == 1) {
			$msg = array('Total selected days is more than entitled leave.', 'danger', 'sv.leave.select');				
		}
		if ($balance == 2) {
			$msg = array('Entitled Leave currently empty.', 'danger', 'sv.leave.select');
		}
		if ($success == 1) {			
			// get region manager
			$rm = \IhrV2\User::find($data['report_to']);
			if ($rm) {
				// send email notification
			}
			$msg = array('Leave successfully added.', 'success', 'sv.leave.index');
		}

		// future note:
		// a) how to cater if leave for hj/um/pa/ma/mr including one or more public holiday date. total is not same
		// b) what type of leave to required the attachment

		return $msg;
	}	





	public function leave_update()
	{

	}



}
