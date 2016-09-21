<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

// use Illuminate\Database\Eloquent\Model;


class User extends Authenticatable
{



    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 
        'name', 
        'email', 
        'password', 
        'api_token', 
        'group_id',
        'is_admin',        
        'icno',
        'sitecode',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token',
    ];




    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }





    // belongs to
    public function GroupName() {
        return $this->belongsTo('\App\Models\Group', 'group_id');
    }

    public function GenderName() {
        return $this->belongsTo('\App\Models\Gender', 'gender_id');
    }

    public function MaritalName() {
        return $this->belongsTo('\App\Models\MaritalStatus', 'marital_id');
    }

    public function RaceName() {
        return $this->belongsTo('\App\Models\Race', 'race_id');
    }

    public function ReligionName() {
        return $this->belongsTo('\App\Models\Religion', 'religion_id');
    }

    public function NationalityName() {
        return $this->belongsTo('\App\Models\Nationality', 'nationality_id');
    }   

    public function SiteName() {
        return $this->belongsTo('\App\Models\Site', 'sitecode');
    }       

    public function StatusName() {
        return $this->belongsTo('\App\Models\UserStatus', 'status');
    }   





    // has one
    public function UserLatestJob() {
        return $this->hasOne('\App\Models\UserJob', 'user_id')->where('status', 1);
    }





    // has many
    public function UserJob() {
        return $this->hasMany('\App\Models\UserJob', 'user_id');
    }

    public function UserContract() {
        return $this->hasMany('\App\Models\UserContract', 'user_id');
    }   

    public function UserFamily() {
        return $this->hasMany('\App\Models\UserFamily', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEducation() {
        return $this->hasMany('\App\Models\UserEducation', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserLanguage() {
        return $this->hasMany('\App\Models\UserLanguage', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserSkill() {
        return $this->hasMany('\App\Models\UserSkill', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEmployment() {
        return $this->hasMany('\App\Models\UserEmployment', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserReference() {
        return $this->hasMany('\App\Models\UserReference', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEmergency() {
        return $this->hasMany('\App\Models\UserEmergency', 'user_id')->orderBy('id', 'DESC');
    }   

    public function UserDistrict() {
        return $this->hasMany('\App\Models\UserDistrict', 'user_id');
    }   

    public function UserCheckIn() {
        return $this->hasMany('\App\Models\UserCheckIn', 'user_id');
    }   





    public function UserCreate($data) 
    {
        // users
        $id = \DB::table('users')->max('id') + 1; 
        $sitecode = isset($data['sitecode']) ? $data['sitecode'] : '';
        $d1 = array(
            'id' => $id,
            'username' => $data['staff_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => \Hash::make($data['password']),
            'api_token' => str_random(60),
            'group_id' => $data['group_id'],
            'icno' => $data['icno'],   
            'sitecode' => $sitecode,        
            'status' => 1,
        );
        $u = new User($d1);        
        $u->save();

        // user_jobs
        $region_id = isset($data['region_id']) ? $data['region_id'] : '';
        $phase_id = isset($data['phase_id']) ? $data['phase_id'] : '';
        $d2 = array(
            'user_id' => $id,
            'staff_id' => $data['staff_id'],
            'join_date' => Carbon::now()->format('Y-m-d'),
            'position_id' => $data['position_id'],
            'phase_id' => $phase_id,
            'region_id' => $region_id,
            'sitecode' => $sitecode,
            'status' => 1,
        );
        $uj = new \App\Models\UserJob($d2);
        $uj->save();
        return true;
    }









    
}
