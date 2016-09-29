<?php

namespace IhrV2\Http\Controllers\api;

use Illuminate\Http\Request;

use IhrV2\Http\Requests;
use IhrV2\Http\Controllers\Controller;
use Carbon\Carbon;
use IhrV2\Helpers\ErpHelper;

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

            $limit = 100; // limit process up to 100 records only (to encounter error maximum execution time)

			// loop all records
			foreach($url['data'] as $i) {
				$ic = str_replace("-", "", trim($i['NRIC']));
				$sitecode = trim($i['SiteCode::SiteCode']);
				$join_date = Carbon::parse(trim($i['DateCreated']))->format('Y-m-d');

				// check icno
				$q = \IhrV2\User::where('icno', $ic)->first();
		
				// not found icno
				if (empty($q) && $total < $limit) {
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
                    $a = new \IhrV2\User($d1);
                    $a->save();
                    $user_id = $a->id;

                    // insert user_jobs
                    $region_id = ($group_id == 4) ? trim($i['IDRegion::IDReg']) : '';
                    $dj = array(
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
                    $uj = new \IhrV2\Models\UserJob($dj);
                    $uj->save();

                    // insert user_contracts
                    if (trim($i['Contract Start']) != '' && trim($i['Contract End']) != '') {
                        $dc = array(
                            'user_id' => $user_id,
                            'date_from' => Carbon::parse(trim($i['Contract Start']))->format('Y-m-d'),
                            'date_to' => Carbon::parse(trim($i['Contract End']))->format('Y-m-d'),
                            'salary' => '',
                            'status_contract_id' => ErpHelper::JobStatus(trim($i['Level Staff'])),
                            'sitecode' => $sitecode,
                            'total_al' => trim($i['AL Entitlement']),
                            'status' => 1,
                        );
                        $uc = new \IhrV2\Models\UserContract($dc);
                        $uc->save();
                    }

                    // insert user_educations
                    if (trim($i['Qualitification']) != '' || trim($i['Qualitification']) != null) {
                        $de = array(
                            'user_id' => $user_id,
                            'name_education' => trim($i['Qualitification'])
                        );
                        $ue = new \IhrV2\Models\UserEducation($de);
                        $ue->save();
                    }

                    // insert user_emergency_contacts
                    if (trim($i['Emergency Contact']) != '' || trim($i['Emergency Contact']) != null) {
                        $dec = array(
                            'user_id' => $user_id,
                            'name' => trim($i['Emergency Contact']),
                            'telno' => trim($i['Emergency Contact No'])
                        );
                        $uec = new \IhrV2\Models\UserEmergency($dec);
                        $uec->save();
                    }  
				}

				// have record icno
				else {
				}						
			} // end foreach
		} 
		if ($total > 0) {
			$data['data'] = array('message' => 'Synchronize complete.', 'total' => $total);
		}
		else {
			$data['data'] = array('message' => 'No record found.', 'total' => $total);
		}
		return response()->json($data);
	}

}




