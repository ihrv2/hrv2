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
        return $this->belongsTo('\App\Models\Position', 'position_id');
    }
    
    public function PhaseName() {
        return $this->belongsTo('\App\Models\Phase', 'phase_id');
    }

    public function RegionName() {
        return $this->belongsTo('\App\Models\Region', 'region_id');
    }

    public function SiteName() {
        return $this->belongsTo('\App\Models\Site', 'sitecode');
    }

    public function StatusName() {
        return $this->belongsTo('\App\Models\Status', 'status');
    }


    
}
