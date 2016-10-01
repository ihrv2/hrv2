<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use IhrV2\Repositories\LeaveRepository;

class UserContract extends Model
{
   

	protected $table = 'user_contracts';



    protected $fillable = [
    	'user_id',
    	'date_from',
    	'date_to',
    	'salary',
    	'status_contract_id',
    	'sitecode',
    	'total_al',
    	'status'
    ];


	public function ContractName() {
		return $this->belongsTo('IhrV2\Models\UserContractStatus', 'status_contract_id');
	}

    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


    // new contract
	public function contract_create($data, $uid) {
		$invalid = 0;
		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true

	    	// update current contract to inactive
			$update = \IhrV2\Models\UserContract::where('user_id', '=', $uid)->where('status', '=', 1)->update(array('status' => 2));

			// get total al
			$leave_repo = new LeaveRepository; // call leave repository
			$total_al = $leave_repo->getTotalAL($from, $to);

			$this->user_id = $uid;			
			$this->date_from = $from;
			$this->date_to = $to;
			$this->salary = $data['salary'];
			$this->status_contract_id = $data['status_contract_id'];	
			$this->sitecode = \IhrV2\User::find($id)->sitecode;
			$this->total_al = $total_al;
			$this->status = 1;
			$this->save();
		}
		else {
			$invalid = 1;
		}
		if ($invalid == 1) {
			$msg = array('Selected Date is invalid.', 'danger', 'mod.user.contract.create');
		}
		else {
			$msg = array('Contract successfully added.', 'success', 'mod.user.view');						
		}		
		return $msg;	
	}	




	// update contract
	public function contract_update($data) {	
		$invalid = 0;
		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true
			
			// get total al
			$leave_repo = new LeaveRepository; // call leave repository
			$total_al = $leave_repo->getTotalAL($from, $to);

			// update data
			$this->date_from = $from;
			$this->date_to = $to;
			$this->salary = $data['salary'];				
			$this->status_contract_id = $data['status_contract_id'];
			$this->total_al = $total_al;	
			$this->save();	
		}
		else {
			$invalid = 1;
		}
		if ($invalid == 1) {
			$msg = array('Selected Date is invalid.', 'danger', 'mod.user.contract.create');			
		}
		else {
			$msg = array('Contract successfully updated.', 'success', 'mod.user.view');						
		}		
		return $msg;	
	}	





	public function contract_delete($id) {
		$this->delete();
		return true;		
	}


    
}
