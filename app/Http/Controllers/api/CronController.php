<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Helpers\ErpHelper;

class CronController extends Controller
{
    

	public function showCronUser()
	{
		// check current date
	    $date = Carbon::now()->format('m-d-Y');
		$api = 'RFMsF1=site&RFMsV1=site&RFMsF2=DateModified&RFMsV2='.$date.'&RFMsF3=CompanyCode&RFMsV3=MSDDI';
        $path = 'http://ws.msd.net.my/RESTfm/contacts/layout/API_Staff.json?';
        $last = '&RFMkey=qwertyuio234567sdfgh&RFMmax=0';
		$total = 0;

	    // json have value
		if (false !== ($json = @file_get_contents($api))) {
			$url = json_decode($json, true);

			// loop all records
			foreach($url['data'] as $i) {
				$ic = str_replace("-", "", trim($i['NRIC']));
				$sitecode = trim($i['SiteCode::SiteCode']);
				$join_date = Carbon::parse(trim($i['DateCreated']))->format('Y-m-d');

				// check icno
				$q = \App\User::where('icno', $ic)->first();
		
				// not found icno
				if (empty($q)) {
					$total++;

					// insert users
                    $d1 = array(
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
                    $user_id = $a->id;

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

				// have record icno
				else {
					
                    // check if staff id is different
                    $check_staffid = \App\User::where('username', trim($i['ID Staff']))->first();
                    if (empty($check_staffid)) {
                        $update_username = \App\User::where('id', $q->id)->update(array('username' => trim($i['ID Staff'])));
                        $update_prevjob = \App\Models\UserJob::where('user_id', '=', $q->id)->where('status', '=', 1)->update(array('status' => 2));

                        // insert user_jobs
                        $d5 = array(
                            'user_id' => $q->id,
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
                    if ($q->updated_at != $modified) {
                        $total++;

                        // update users
                        $q->name = trim($i['Person Name']);
                        $q->email = trim($i['Work Email']);
                        $q->icno = trim($i['NRIC']);
                        $q->permanent_street_1 = trim($i['Permanent Street 1']);
                        $q->permanent_street_2 = trim($i['Permanent Street 2']);
                        $q->permanent_postcode = trim($i['Permanent Postcode']);
                        $q->permanent_city = trim($i['Permanent City']);
                        $q->permanent_state = trim($i['Permanent State']);
                        $q->correspondence_street_1 = trim($i['Correspondence Street 1']);
                        $q->correspondence_street_2 = trim($i['Correspondence Street 2']);
                        $q->correspondence_postcode = trim($i['Correspondence Postcode']);
                        $q->correspondence_city = trim($i['Correspondence City']);
                        $q->correspondence_state = trim($i['Correspondence State']);
                        $q->telno1 = trim($i['Phone No1']);
                        $q->telno2 = trim($i['Phone No2']);
                        $q->hpno = trim($i['Mobile No']);
                        $q->faxno = trim($i['Fax No']);
                        $q->website = trim($i['Website']);
                        $q->personal_email = trim($i['Personal Email']);
                        $q->work_email = trim($i['Work Email']);
                        $q->gender_id = ErpHelper::GenderName($i['Gender']);
                        $q->marital_id = ErpHelper::MaritialStatus($i['Maritial Status']);                          
                        $q->dob = Carbon::parse(trim($i['DOB']))->format('Y-m-d');
                        $q->pob = trim($i['POB']);
                        $q->nationality_id = ErpHelper::Nationality($i['Nationality']);
                        $q->race_id = ErpHelper::RaceName($i['Race']);
                        $q->religion_id = ErpHelper::ReligionName($i['Religion']);                          
                        $q->sitecode = $sitecode;
                        $q->itaxno = '';
                        $q->epfno = trim($i['EPF No']);
                        $q->socsono = '';
                        $q->bankname = trim($i['Bank Registered']);
                        $q->bankno = trim($i['Bank Acc No']);
                        $q->status = ErpHelper::StatusEmployment(trim($i['StatusEmployment']));
                        $q->updated_at = $modified;
                        $q->save();
                    }

				}						
			} // end foreach
		} 
		if ($total > 0) {
			$data['data'] = array('message' => 'Synchronize complete.', 'total' => $total);
		}
		else {
			$data['data'] = array('message' => 'No record found.', 'total' => $total);
		}
		return Response::json($data);
	}

}
