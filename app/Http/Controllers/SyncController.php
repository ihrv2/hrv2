<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

use Carbon\Carbon;
use App\Helpers\ErpHelper;
// use Illuminate\Support\Facades\DB;

class SyncController extends Controller
{
    


    public function showSyncUser()
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Synchronize', 
            'child' => 'ERP',   
            'icon' => 'refresh',
            'title' => 'Staff'
            );  
        $currentDate = Carbon::now();
        $data['prev_week'] = $currentDate->subDays($currentDate->dayOfWeek)->subWeeks(2)->format('d-m-Y');
        return View('modules.sync.user.index', $data);    
    }





    public function updateSyncUser(Request $request)
    {
        $group_id = $request->group_id;
        $date_from = Carbon::parse($request->date_from)->format('m-d-Y'); // selected date "07-24-2016"
        $date_to = Carbon::now()->format('m-d-Y');
        $path = 'http://ws.msd.net.my/RESTfm/contacts/layout/API_Staff.json?';
        $last = '&RFMkey=qwertyuio234567sdfgh&RFMmax=0';

        if ($group_id == 3) { // site supervisor
            $api = 'RFMsF1=site&RFMsV1=site&RFMsF2=DateModified&RFMsV2='.$date_from.'...'.$date_to.'&RFMsF3=CompanyCode&RFMsV3=MSDDI';
        }
        else if ($group_id == 4) { // region manager
            $api = 'RFMsF1=Location&RFMsV1=branch&RFMsF3=CompanyCode&RFMsV3=MSDDI&RFMsF4=IDPosition&RFMsV4=1';
        }
        else if ($group_id == 2) { // human resourcey
            $api = 'RFMsF1=Department&RFMsV1=Human%20Resource&RFMsF3=CompanyCode&RFMsV3=MSDDI';
        }     
        
        $total = 0;
        if (false !== ($json = @file_get_contents($path.$api.$last))) {
            $url = json_decode($json, true);            

            // loop all records
            foreach($url['data'] as $i) {
                $ic = str_replace("-", "", trim($i['NRIC']));
                $sitecode = trim($i['SiteCode::SiteCode']);
                $join_date = Carbon::parse(trim($i['DateCreated']))->format('Y-m-d');

                // check icno
                $check_icno = \App\User::where('icno', $ic)->first();
                if (empty($check_icno)) {
                    $total++;
                    $user_id = \DB::table('users')->max('id') + 1;

                    // insert users
                    $d1 = array(
                        'id' => $user_id,
                        'username' => trim($i['ID Staff']),
                        'name' => trim($i['Person Name']),
                        'email' => trim($i['Work Email']),
                        'password' => \Hash::make('password'),
                        'api_token' => str_random(60),
                        'group_id' => $group_id,
                        'icno' => $ic,
                        'permanent_street_1' => trim($i['Permanent Street 1']),
                        'permanent_street_2' => trim($i['Permanent Street 2']),
                        'permanent_postcode' => trim($i['Permanent Postcode']),
                        'permanent_city' => trim($i['Permanent City']),
                        'permanent_state' => trim($i['Permanent State']),
                        'correspondence_street_1' => trim($i['Correspondence Street 1']),
                        'correspondence_street_2' => trim($i['Correspondence Street 2']),
                        'correspondence_postcode' => trim($i['Correspondence Postcode']),
                        'correspondence_city' => trim($i['Correspondence City']),
                        'correspondence_state' => trim($i['Correspondence State']),
                        'telno1' => trim($i['Phone No1']),
                        'telno2' => trim($i['Phone No2']),
                        'hpno' => trim($i['Mobile No']),
                        'faxno' => trim($i['Fax No']),
                        'website' => trim($i['Website']),
                        'personal_email' => trim($i['Personal Email']),
                        'work_email' => trim($i['Work Email']),
                        'gender_id' => ErpHelper::GenderName(trim($i['Gender'])),
                        'marital_id' => ErpHelper::MaritialStatus(trim($i['Maritial Status'])),
                        'dob' => Carbon::parse(trim($i['DOB']))->format('Y-m-d'),
                        'pob' => trim($i['POB']),
                        'nationality_id' => ErpHelper::Nationality($i['Nationality']),
                        'race_id' => ErpHelper::RaceName($i['Race']),
                        'religion_id' => ErpHelper::ReligionName($i['Religion']),
                        'sitecode' => $sitecode,
                        'epfno' => trim($i['EPF No']),
                        'bankname' => trim($i['Bank Registered']),
                        'bankno' => trim($i['Bank Acc No']),
                        'status' => ErpHelper::StatusEmployment(trim($i['StatusEmployment'])),
                        'created_at' => Carbon::parse($i['DateCreated'])->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::parse($i['DateModified'])->format('Y-m-d H:i:s')
                    );
                    $a = new \App\User($d1);
                    $a->save();

                    // insert user_jobs
                    $region_id = ($group_id == 4) ? trim($i['IDRegion::IDReg']) : '';
                    $d2 = array(
                        'user_id' => $user_id,
                        'staff_id' => trim($i['ID Staff']),
                        'join_date' => $join_date,
                        'position_id' => ErpHelper::JobTitle(trim($i['Job Title'])),
                        'phase_id' => trim($i['Phase::PhaseID']),
                        'region_id' => $region_id,
                        'notes' => trim($i['Notes']),
                        'sitecode' => $sitecode,
                        'status' => 1,
                    );
                    $b = new \App\Models\UserJob($d2);
                    $b->save();

                    // insert user_educations
                    if (trim($i['Qualitification']) != '' || trim($i['Qualitification']) != null) {
                        $d3 = array(
                            'user_id' => $user_id,
                            'name_education' => trim($i['Qualitification'])
                        );
                        $c = new \App\Models\UserEducation($d3);                        
                        $c->save();
                    }

                    // insert user_emergency_contacts
                    if (trim($i['Emergency Contact']) != '' || trim($i['Emergency Contact']) != null) {
                        $d4 = array(
                            'user_id' => $user_id,
                            'name' => trim($i['Emergency Contact']),
                            'telno' => trim($i['Emergency Contact No'])
                        );
                        $d = new \App\Models\UserEmergency($d4);                        
                        $d->save();
                    }                    
                }

                // icno exist
                else {

                    // check if staff id is different
                    $check_staffid = \App\Models\User::where('username', trim($i['ID Staff']))->first();
                    if (empty($check_staffid)) {
                        $update_username = \App\Models\User::where('user_id', $check_icno->id)->update(array('username' => $i['ID Staff']));
                        $update_prevjob = \App\Models\UserJob::where('user_id', '=', $check_icno->id)->where('status', '=', 1)->update(array('status' => 2));

                        // insert user_jobs
                        $d5 = array(
                            'user_id' => $check_icno->id,
                            'staff_id' => trim($i['ID Staff']),
                            'join_date' => $join_date,
                            'position_id' => ErpHelper::JobTitle(trim($i['Job Title'])),
                            'phase_id' => trim($i['Phase::PhaseID']),
                            'notes' => trim($i['Notes']),
                            'sitecode' => $sitecode,
                            'status' => 1,
                        );
                        $e = new \App\Models\UserJob($d5);
                        $e->save();                                              
                    }

                    // check modified date
                    $modified = Carbon::parse($i['DateModified'])->format('Y-m-d H:i:s');
                    if ($check_icno->updated_at != $modified) {

                    }
                }
            }
        }
        if ($total > 0) {
            $data['message'] = 'Synchronize completed. '.$total.' records effected.';
        }
        else {
            $data['message'] = 'No record found.';
        }
        return response()->json($data);           
    }





    public function showSyncPublicHoliday()
    {
        $data = array();
        $data['header'] = array(
            'parent' => 'Synchronize', 
            'child' => 'ERP',   
            'icon' => 'refresh',
            'title' => 'Public Holiday'
            );  
        return View('modules.sync.public-holiday.index', $data);
    }





    public function updateSyncPublicHoliday(Request $request)
    {
        $year = $request->year;
        $api = 'http://ws.msd.net.my/RESTfm/Cuti/layout/Public_Holiday.json?RFMsF1=DateCuti&RFMsV1='.$year.'&RFMkey=qwertyuio234567sdfgh&RFMmax=0';
        $total = 0;

        // json have value
        if (false !== ($json = @file_get_contents($api))) {
            $url = json_decode($json, true);

            // loop api records
            foreach($url['data'] as $i) {

                // check year and desc
                $year_api = Carbon::parse($i['DateCuti'])->format('Y');
                $desc_api = $i['Regarding'];                
                $q = \App\Models\LeavePublic::whereYear('date', '=', $year_api)->where('desc', '=', $desc_api)->first();

                // insert leave_public
                if (empty($q)) {
                    $total++;

                    // insert leave_public
                    $public_id = \DB::table('leave_public')->max('id') + 1;  
                    $a = new \App\Models\LeavePublic();
                    $a->id = $public_id;
                    $a->desc = $i['Regarding'];
                    $a->date = Carbon::parse($i['DateCuti'])->format('Y-m-d');
                    $a->created_at = date('Y-m-d H:i:s');
                    $a->updated_at = date('Y-m-d H:i:s');
                    $a->save();

                    // separate each state id in ListStateID
                    $states = preg_split('/\r\n|\r|\n/', $i['ListStateID']);
                    
                    // insert leave_public_states
                    foreach ($states as $s) {
                        $data = array(
                            'leave_public_id' => $public_id,
                            'date' => Carbon::parse($i['DateCuti'])->format('Y-m-d'),
                            'state_id' => ErpHelper::StateName($s),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                        );
                        \App\Models\LeavePublicState::insert($data);
                    }                           
                }           
            }
        }
        if ($total > 0) {
            $data['message'] = 'Synchronize completed. '.$total.' records effected.';
        }
        else {
            $data['message'] = 'No record found.';
        }
        return response()->json($data);        
    }





}
