<?php

namespace IhrV2\Models;

use Illuminate\Database\Eloquent\Model;

class UserJob extends Model
{
    //


	protected $table = 'user_jobs';




    protected $fillable = [
        'user_id',
        'staff_id',
        'join_date',
        'position_id',
        'phase_id',
        'region_id',
        'notes',
        'sitecode', 
        'status'
    ];

    public function UserDetail() {
        return $this->belongsTo('IhrV2\User', 'user_id');
    }


    public function PositionName() {
        return $this->belongsTo('IhrV2\Models\Position', 'position_id');
    }
    
    public function PhaseName() {
        return $this->belongsTo('IhrV2\Models\Phase', 'phase_id');
    }

    public function RegionName() {
        return $this->belongsTo('IhrV2\Models\Region', 'region_id');
    }

    public function SiteName() {
        return $this->belongsTo('IhrV2\Models\Site', 'sitecode');
    }

    public function StatusName() {
        return $this->belongsTo('IhrV2\Models\Status', 'status');
    }




    public function job_create($data, $uid) {
        // add new jobs
        $user = User::find($uid);
        $this->user_id = $data['uid'];  
        $this->staff_id = $user->username;
        $this->join_date = date('Y-m-d', strtotime(str_replace('/', '-', $data['join_date'])));
        $this->position_id = $data['position_id'];
        $this->phase_id = $data['phase_id'];
        $this->sitecode = $data['sitecode'];        
        $this->status = 1;
        $this->save();                  
        $msg = array('Job successfully added.', 'success', 'mod.user.view');  
        return $msg;   
    }   





    public function job_update($data, $uid) {
        $this->join_date = date('Y-m-d', strtotime(str_replace('/', '-', $data['join_date'])));
        $this->position_id = $data['position_id'];
        $this->phase_id = $data['phase_id'];
        $this->sitecode = $data['sitecode'];
        $this->save();                  
        $msg = array('Job successfully updated.', 'success', 'mod.user.view');  
        return $msg;    
    }




    public function family_delete($data) {
        $msg = array('Family successfully deleted.', 'success', 'mod.user.view');           
        return $msg;        
    }




    
}
