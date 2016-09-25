<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Repositories\LeaveRepository;


class UserContract extends Model
{
    //

 //    private $leave_repo;
	// public function __construct(\App\Repositories\LeaveRepository $LeaveRepo)
	// {
	// 	$this->leave_repo = $LeaveRepo;
	// }

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
		return $this->belongsTo('App\Models\UserContractStatus', 'status_contract_id');
	}





	public function user_contract_create($data, $id) {
		$invalid = 0;
		// convert date
		$from = Carbon::createFromFormat('d/m/Y', $data['date_from'])->format('Y-m-d'); // "YYYY-MM-DD"
		$to = Carbon::createFromFormat('d/m/Y', $data['date_to'])->format('Y-m-d'); // "YYYY-MM-DD"

		// check if date from is less than or equal date to
		if (Carbon::parse($from)->lte(Carbon::parse($to))) { // true

	    	// update current contract to inactive
			$update = \App\Models\UserContract::where('user_id', '=', $id)->where('status', '=', 1)->update(array('status' => 2));

			// get total al
			$total_al = LeaveRepository::getTotalAL($from, $to);

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
			$msg = array('Selected Date is invalid.', 'danger', 'mod.user.contract.create');
		}
		else {
			$msg = array('Contract successfully added.', 'success', 'mod.user.view');						
		}		
		return $msg;	
	}	





	public function user_contract_update($data) {	
	
	}	



	public function contract_delete($id) {
		$this->delete();
		return true;		
	}


    
}
