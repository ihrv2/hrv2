<?php

namespace IhrV2;

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



    // always encrypt value password when user enter the password
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = bcrypt($value);
    // }



    public function scopeIsActive($q)
    {
        $q->where('status', 1);
    }


    public function scopeIsActiveAndIDDesc($q)
    {
        $q->where('status', 1)->orderBy('id', 'DESC');
    } 


    // belongs to
    public function GroupName() {
        return $this->belongsTo('IhrV2\Models\Group', 'group_id');
    }

    public function GenderName() {
        return $this->belongsTo('IhrV2\Models\Gender', 'gender_id');
    }

    public function MaritalName() {
        return $this->belongsTo('IhrV2\Models\MaritalStatus', 'marital_id');
    }

    public function RaceName() {
        return $this->belongsTo('IhrV2\Models\Race', 'race_id');
    }

    public function ReligionName() {
        return $this->belongsTo('IhrV2\Models\Religion', 'religion_id');
    }

    public function NationalityName() {
        return $this->belongsTo('IhrV2\Models\Nationality', 'nationality_id');
    }   

    public function SiteName() {
        return $this->belongsTo('IhrV2\Models\Site', 'sitecode');
    }       

    public function StatusName() {
        return $this->belongsTo('IhrV2\Models\UserStatus', 'status');
    }   





    // has one
    public function UserLatestJob() {
        return $this->hasOne('IhrV2\Models\UserJob', 'user_id')->where('status', 1);
    }





    // has many
    public function UserJob() {
        return $this->hasMany('IhrV2\Models\UserJob', 'user_id');
    }

    public function UserContract() {
        return $this->hasMany('IhrV2\Models\UserContract', 'user_id');
    }   

    public function UserFamily() {
        return $this->hasMany('IhrV2\Models\UserFamily', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEducation() {
        return $this->hasMany('IhrV2\Models\UserEducation', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserLanguage() {
        return $this->hasMany('IhrV2\Models\UserLanguage', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserSkill() {
        return $this->hasMany('IhrV2\Models\UserSkill', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEmployment() {
        return $this->hasMany('IhrV2\Models\UserEmployment', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserReference() {
        return $this->hasMany('IhrV2\Models\UserReference', 'user_id')->orderBy('id', 'DESC');
    }

    public function UserEmergency() {
        return $this->hasMany('IhrV2\Models\UserEmergency', 'user_id')->orderBy('id', 'DESC');
    }   

    public function UserDistrict() {
        return $this->hasMany('IhrV2\Models\UserDistrict', 'user_id');
    }   

    public function UserCheckIn() {
        return $this->hasMany('IhrV2\Models\UserCheckIn', 'user_id');
    }   





    public function user_create($data) 
    {
        // users
        $sitecode = isset($data['sitecode']) ? $data['sitecode'] : '';
        $d1 = array(
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
        $user_id = $u->id;

        // user_jobs
        $region_id = isset($data['region_id']) ? $data['region_id'] : '';
        $phase_id = isset($data['phase_id']) ? $data['phase_id'] : '';
        $d2 = array(
            'user_id' => $user_id,
            'staff_id' => $data['staff_id'],
            'join_date' => Carbon::now()->format('Y-m-d'),
            'position_id' => $data['position_id'],
            'phase_id' => $phase_id,
            'region_id' => $region_id,
            'sitecode' => $sitecode,
            'status' => 1,
        );
        $uj = new IhrV2\Models\UserJob($d2);
        $uj->save();
        return true;
    }









    
}
