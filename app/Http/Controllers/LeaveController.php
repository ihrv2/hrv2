<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Validator;

class LeaveController extends Controller
{



    public function showLeaveIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All leave',
			'icon' => 'grid',
			'title' => 'View Request Leave'
		);		
		return View('modules.leave.index', $data);
    }



    public function showLeaveSelect()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Add Leave',
			'icon' => 'grid',
			'title' => 'Leave Type'
		);
		$data['leave_types'] = \App\Models\LeaveType::where('id', '!=', 6)->orderBy('id', 'ASC')->pluck('name', 'id');
		return View('modules.leave.select', $data);	    	
    }




    public function postLeaveSelect(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'leave_type_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else {
        	// dd($request->leave_type_id);
        	// return redirect()->action('\App\Http\Controllers\sv\LeaveController@showLeaveAdd', 1);
        	return redirect()->route('sv.leave.add')->with('leave_type_id', $request->leave_type_id);
        }
    }



    public function showLeaveCreate(Request $request)
    {
    	// dd($request);
    	dd($request->old('leave_type_id'));
    	// dd(old('leave_type_id'));
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Add Leave',
			'icon' => 'grid',
			'title' => 'Add Leave'
		);
		if ($request->old('leave_type_id')) {
			return View('sv.leave.add', $data);
		}
		else {
			return redirect()->route('sv.leave.select');
		}	    	
    }



    public function storeLeaveCreate()
    {
    	return 'sdfdfsdf';
    }



    public function showLeaveSummary()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'Leave Summary',
			'icon' => 'grid',
			'title' => 'Leave Summary'
		);			
		return View('modules.leave.summary', $data);
    }




    public function showLeaveRepIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement leave',
			'icon' => 'note',
			'title' => 'Replacement Leave'
		);
		return View('modules.replacement-leave.index', $data);
    }



    public function postLeaveRepIndex()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement leave',
			'icon' => 'note',
			'title' => 'Replacement Leave'
		);
		return View('modules.replacement-leave.index', $data);
    }



    public function showLeaveRepCreate()
    {
		$data = array();
		$data['header'] = array(
			'parent' => 'Leave Application', 
			'child' => 'All Replacement Leave',
			'child-a' => route('sv.mod.leave.replacement.index'),			
			'icon' => 'note',
			'title' => 'Add Replacement Leave'
		);			
		return View('modules.replacement-leave.add', $data);	    	
    }


    
    public function storeLeaveRepCreate()
    {

    }


}
