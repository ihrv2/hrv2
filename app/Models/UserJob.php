<?php

namespace App\Models;

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


    public function PositionName() {
        return $this->belongsTo('App\Models\Position', 'position_id');
    }
    
    public function PhaseName() {
        return $this->belongsTo('App\Models\Phase', 'phase_id');
    }

    public function RegionName() {
        return $this->belongsTo('App\Models\Region', 'region_id');
    }

    public function SiteName() {
        return $this->belongsTo('App\Models\Site', 'sitecode');
    }

    public function StatusName() {
        return $this->belongsTo('App\Models\Status', 'status');
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
        return true;    
    }   





    public function job_update($data, $uid) {
        $this->join_date = date('Y-m-d', strtotime(str_replace('/', '-', $data['join_date'])));
        $this->position_id = $data['position_id'];
        $this->phase_id = $data['phase_id'];
        $this->sitecode = $data['sitecode'];
        $this->save();
        return true;    
    }





    
}
