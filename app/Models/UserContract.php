<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class UserContract extends Model
{
    //



	protected $table = 'user_contracts';




	public function ContractName() {
		return $this->belongsTo('\App\Models\UserContractStatus', 'status_contract_id');
	}





	public function UserContractCreate($data, $id) {
		$invalid = 0;
		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true

	    	// update current contract to inactive
			$update = \App\Models\UserContract::where('user_id', '=', $id)->where('status', '=', 1)->update(array('status' => 2));

			// get total al
			$total_al = \App\Helpers\LeaveHelper::getTotalAL($from, $to);

			$this->user_id = $id;			
			$this->date_from = $from;
			$this->date_to = $to;
			$this->salary = $data['salary'];
			$this->status_contract_id = $data['status_contract_id'];	
			$this->sitecode = \App\User::find($id)->sitecode;
			$this->total_al = $total_al;
			$this->status = 1;
			$this->save();
		}
		else {
			$invalid = 1;
		}
		if ($invalid == 1) {
			$msg = array('message' => 'Selected Date is invalid.', 'label' => 'danger');
		}
		else {
			$msg = array('message' => 'Contract successfully added.', 'label' => 'success');						
		}		
		return $msg;	
	}	





	public function UserContractEdit($data) {	
		$invalid = 0;
		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true
			
			// get total al
			$total_al = \App\Helpers\LeaveHelper::getTotalAL($from, $to);

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
			$msg = array('message' => 'Selected Date is invalid.', 'label' => 'danger');
		}
		else {
			$msg = array('message' => 'Contract successfully updated.', 'label' => 'success');						
		}		
		return $msg;		
	}	



	public function contract_delete($id) {
		$this->delete();
		return true;		
	}


    
}
