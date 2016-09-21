@extends('layout/backend')

@section('content')



<div class="row">
	<div class="col-sm-12">
		<div class="well">




			<div class="panel-body">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#personal" aria-expanded="true">Personal</a></li>
					<li class=""><a data-toggle="tab" href="#job" aria-expanded="false">Jobs</a></li>

					@if ($detail->group_id == 3)
						<li class=""><a data-toggle="tab" href="#contract" aria-expanded="false">Contract</a></li>
						<li class=""><a data-toggle="tab" href="#family" aria-expanded="false">Family</a></li>
						<li class=""><a data-toggle="tab" href="#education" aria-expanded="false">Education</a></li>
						<li class=""><a data-toggle="tab" href="#language" aria-expanded="false">Language</a></li>
						<li class=""><a data-toggle="tab" href="#skill" aria-expanded="false">Skills</a></li>
						<li class=""><a data-toggle="tab" href="#employment" aria-expanded="false">Employment History</a></li>
						<li class=""><a data-toggle="tab" href="#reference" aria-expanded="false">References</a></li>
						<li class=""><a data-toggle="tab" href="#emergency" aria-expanded="false">Emergency Contact</a></li>
						<li class=""><a data-toggle="tab" href="#picture" aria-expanded="false">Photo</a></li>   					
					@endif


					<!-- appear if user is project officer -->
					@if ($detail->group_id == 5)
						<li class=""><a data-toggle="tab" href="#check-in" aria-expanded="false">Site Check In</a></li> 
					@endif                 
				</ul>





				<!-- Tab panes -->
				<div class="tab-content">



					<!-- site check in of project officer -->
					@if ($detail->group_id == 5)
						<div class="tab-pane" id="check-in">
							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Site Check In</h4>
										</div>						            
										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>State</th>
														<th>Region</th>
														<th>District</th>
														<th>Site Name</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>		
												@if (count($detail->UserCheckIn) > 0)
													<?php $no = 0; ?>											
													@foreach ($detail->UserCheckIn as $checkin)
														<?php $no++; ?>												
														<tr>
															<td>{{ $no }}</td>
															<td>{{ $checkin->StateName->name }}</td>
															<td>{{ $checkin->RegionName->name }}</td>
															<td>{{ $checkin->DistrictName->name }}</td>
															<td>{{ $checkin->sitecode }}</td>	              
															<td class="text-right"><a href="#" class="btn btn-primary btn-sm" title="Delete" href="#" id="skill-delete" alt="{{ $checkin->id }}"><i class="icon-pencil"></i></a>&nbsp;<a href="#" class="btn btn-primary btn-sm" title="Delete" href="#" id="skill-delete" alt="{{ $checkin->id }}"><i class="icon-trash"></i></a></td>
														</tr>
													@endforeach
												@else
													<tr><td colspan="6">No record</td></tr>
												@endif								               	
											</table>
											<div class=""><a href="" class="btn btn-success btn-sm" title="Add"><i class="icon-plus"></i>&nbsp;Add Check In</a></div>
											<br>								            				            
										</div>
									</div>
								</div>
							</div>
						</div>	
					@endif					           




					<!-- personal -->
					<div class="tab-pane active" id="personal">
						<div class="row">
							<div class="col-md-12">

								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4 class="panel-title">Personal</h4>
									</div>						            
									<div class="panel-body nopadding">

										<table class="table table-condensed table-striped table-responsive">
											<tr>
												<td>Status</td>
												<td>{{ $detail->StatusName->name }}</td>
											</tr>
											<tr>
												<td>Username</td>
												<td>{{ $detail->username }}</td>
											</tr>								            
											<tr>
												<td class="col-md-3">Full Name</td>
												<td class="col-md-9">{{ $detail->name }}</td>
											</tr>
											<tr>
												<td>IC No</td>
												<td>{{ $detail->icno }}</td>
											</tr>		
											<tr>
												<td>Telephone No 1</td>
												<td>{{ $detail->telno }}</td>
											</tr>
											<tr>
												<td>Telephone No 2</td>
												<td>{{ $detail->telno }}</td>
											</tr>											
											<tr>
												<td>Mobile No</td>
												<td>{{ $detail->hpno }}</td>
											</tr>
											<tr>
												<td>Permanent Street 1</td>
												<td></td>
											</tr>
											<tr>
												<td>Permanent Street 2</td>
												<td></td>
											</tr>
											<tr>
												<td>Permanent Postcode</td>
												<td></td>
											</tr>
											<tr>
												<td>Permanent City</td>
												<td></td>
											</tr>
											<tr>
												<td>Permanent State</td>
												<td></td>
											</tr>
											<tr>
												<td>Correspondence Street 1</td>
												<td></td>
											</tr>
											<tr>
												<td>Correspondence Street 2</td>
												<td></td>
											</tr>
											<tr>
												<td>Correspondence Postcode</td>
												<td></td>
											</tr>
											<tr>
												<td>Correspondence City</td>
												<td></td>
											</tr>
											<tr>
												<td>Correspondence State</td>
												<td></td>
											</tr>
											<tr>
												<td>Gender</td>
												<td>
													@if ($detail->GenderName) 
													{{ $detail->GenderName->eng }}
													@endif
												</td>
											</tr>	
											<tr>
												<td>Age</td>
												<td>{{ $age }}</td>
											</tr>		
											<tr>
												<td>Marital Status</td>
												<td>
													@if ($detail->MaritalStatus)
													{{ $detail->MaritalStatus->name }}
													@endif
												</td>
											</tr>
											<tr>
												<td>Height</td>
												<td>{{ $detail->height }}</td>
											</tr>	
											<tr>
												<td>Weight</td>
												<td>{{ $detail->weight }}</td>
											</tr>		
											<tr>
												<td>Race</td>
												<td>
													@if ($detail->RaceName)
														{{ $detail->RaceName->eng }}
													@endif
												</td>
											</tr>
											<tr>
												<td>Religion</td>
												<td>
													@if ($detail->ReligionName)
														{{ $detail->ReligionName->name }}
													@endif
												</td>
											</tr>	
											<tr>
												<td>Nationality</td>
												<td>
													@if ($detail->NationalityName)
													{{ $detail->NationalityName->eng }}
													@endif
												</td>
											</tr>		
											<tr>
												<td>Date of Birth</td>
												<td>{{ $detail->dob }}</td>
											</tr>
											<tr>
												<td>Place of Birth</td>
												<td>{{ $detail->pob }}</td>
											</tr>	
											<tr>
												<td>Email</td>
												<td>{{ $detail->email }}</td>
											</tr>
											<tr>
												<td>Staff Level</td>
												<td>
													@if ($detail->GroupName)
													{{ $detail->GroupName->name }}
													@endif
												</td>
											</tr>	
											<tr>
												<td>Income Tax No.</td>
												<td>{{ $detail->itaxno }}</td>
											</tr>
											<tr>
												<td>EPF No.</td>
												<td>{{ $detail->epfno }}</td>
											</tr>
											<tr>
												<td>Socso No.</td>
												<td>{{ $detail->socsono }}</td>
											</tr>
											<tr>
												<td>Bank Name</td>
												<td>{{ $detail->bankname }}</td>
											</tr>							            	
											<tr>
												<td>Bank Account No.</td>
												<td>{{ $detail->bankno }}</td>
											</tr>
										</table>
									</div>
								</div>

							</div>
						</div>                    	
					</div>






					<!-- job -->
					<div class="tab-pane" id="job">
						<div class="row">
							<div class="col-md-12">




								<div class="panel panel-primary">
									<div class="panel-heading">
										<h4 class="panel-title">Job Info</h4>
									</div>						      
									<div class="panel-body nopadding">




										@if ($curr_job)
											 <h5>Current Job</h5>
											<table class="table table-condensed table-striped table-responsive">	
												<tr>
													<td class="col-md-3">Staff ID</td>
													<td class="col-md-9">{{ $curr_job->staff_id }}</td>
												</tr>					
												<tr>
													<td>Join Date</td>
													<td>{{ $curr_job->join_date }}</td>
												</tr>	
												<tr>
													<td>Position</td>
													<td>{{ $curr_job->PositionName->name }}</td>
												</tr>	

												<!-- site supervisor -->
												@if ($detail->group_id == 3)
													<tr>
														<td>Phase</td>
														<td>
															@if ($curr_job->phase_id)
																{{ $curr_job->PhaseName->name }}
															@else
																{{ '-' }}
															@endif
														</td>
													</tr>	
													<!-- check if sitecode is empty -->
													@if ($curr_job->sitecode)
														<tr>
															<td>Sitecode</td>
															<td>{{ $curr_job->sitecode }}</td>
														</tr>			
														<tr>
															<td>Sitename</td>
															<td>{{ $curr_job->SiteName->name }}</td>
														</tr>
													@else
														<tr>
															<td>Sitecode</td>
															<td>-</td>
														</tr>
													@endif
												@endif

												<!-- regional officer -->
												@if ($detail->group_id == 4)
												<tr>
													<td>Region</td>
													<td>
													@if ($curr_job->RegionName)
														{{ $curr_job->RegionName->name }}
													@else
														{{ '-' }}
													@endif
													</td>
												</tr>	
												@endif												
				            	
											</table>	
										@else
											<div class=""><a href="{{ URL::route('mod.user.job.add', array($detail->id, $detail->key)) }}" class="btn btn-success btn-sm" title="Add"><i class="icon-plus"></i>&nbsp;Add Job</a></div>
											<br>
										@endif






										@if ($detail->group_id == 3)
										<legend>Previous Job</legend>
										<div class="well">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="bg-default">
														<th>No</th>
														<th>Join Date</th>
														<th>Position</th>
														<th>Phase</th>														
														<th>Site</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($prev_job) > 0)
													<?php $no = 0; ?>
													@foreach ($prev_job as $i)
													<?php $no++; ?>
													<tr>
														<td>{{ $no }}</td>
														<td>{{ $i->join_date }}</td>
														<td>{{ $i->PositionName->name }}</td>
														<td>{{ $i->PhaseName->name }}</td>
														<td>{{ $i->sitecode.' - '.$i->SiteName->name }}</td>
														<td class="text-right">
															<a href="{{ URL::route('mod.user.job.edit', array($detail->id, $i->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="#" alt="{{ $i->id }}" id="job-delete" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a>
														</td>
													</tr>
													@endforeach
												@else
													<tr>
														<td colspan="7">No record</td>
													</tr>
												@endif
											</table>
										</div>
										@endif



									</div>
								</div>
							</div>
						</div>
					</div>






					@if ($detail->group_id == 3)
						<!-- contract -->
						<div class="tab-pane" id="contract">
							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Contract Info</h4>
										</div>						      

										<div class="panel-body nopadding">
											@if (!empty($curr_contract)) 	
											<h5>Current Contract</h5>	
											<table class="table table-condensed table-striped table-responsive table-hover">	
												<tr>
													<td>Status Contract</td>
													<td>{{ $curr_contract->ContractName->name }}</td>
												</tr>											
												<tr>
													<td class="col-md-3">Start Date</td>
													<td class="col-md-9">{{ $curr_contract->date_from }}</td>
												</tr>
												<tr>
													<td>End Date</td>
													<td>{{ $curr_contract->date_to }}</td>
												</tr>
												<tr>
													<td>Salary (RM)</td>
													<td>{{ number_format($curr_contract->salary, 2) }}</td>
												</tr>
												<tr>
													<td>Entitled Leave</td>
													<td>{{ $curr_contract->total_al }}</td>
												</tr>
												<tr>
													<td colspan="2">
														<div class="text-right"><a href="{{ URL::route('mod.user.contract.edit', array($curr_contract->id, $detail->id, $detail->key)) }}" class="btn btn-danger" title="Edit"><i class="icon-note"></i>&nbsp;Edit</a>&nbsp;<a href="{{ URL::route('mod.user.contract.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;New</a></div>
													</td>
												</tr>						            
											</table>



											<legend>Previous Contract</legend>
											<div class="well">
												<table class="table table-striped table-condensed table-responsive table-hover">
													<thead>
														<tr class="bg-default">
															<th>No</th>
															<th>Status</th>
															<th>Date Start</th>
															<th>Date End</th>
															<th>Salary (RM)</th>
															<th class="actions text-right">Actions</th>
														</tr>
													</thead>
													@if (count($prev_contract) > 0)
													<?php $no = 0; ?>
													@foreach ($prev_contract as $contract)
													<?php $no++; ?>
													<tr>
														<td>{{ $no }}</td>
														<td>{{ $contract->ContractName->name }}</td>
														<td>{{ $contract->date_from }}</td>
														<td>{{ $contract->date_to }}</td>
														<td>{{ number_format($contract->salary, 2) }}</td>
														<td class="text-right">
															<a href="{{ URL::route('mod.user.contract.edit', array($contract->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.contract.delete', array($contract->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a>
														</td>
													</tr>
													@endforeach
													@else
													<tr>
														<td colspan="7">No record</td>
													</tr>
													@endif
												</table>
											</div>   
											@else
												<p>No record</p>
												<div class=""><a href="{{ URL::route('mod.user.contract.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a></div>
												<br>
											@endif



	         



										</div>
									</div>



								</div>
							</div>
						</div>






						<!-- family -->
						<div class="tab-pane" id="family">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Family</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Name</th>
														<th>Age</th>
														<th>Occupation</th>
														<th>School/Office</th>
														<th>Relation</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserFamily) > 0)
												<?php $no = 0; ?>											
												@foreach ($detail->UserFamily as $family)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $family->name }}</td>
													<td>{{ $family->age }}</td>
													<td>{{ $family->occupation }}</td>
													<td>{{ $family->school_office }}</td>
													<td>{{ $family->relation }}</td>
													<td class="text-right"><a href="{{ URL::route('mod.user.family.edit', array($family->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.family.delete', array($family->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
												</tr>

												@endforeach
												@else
												<tr><td colspan="7">No record</td></tr>
												@endif

											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.family.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>												
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>






						<!-- education -->
						<div class="tab-pane" id="education">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Education</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Year From</th>
														<th>Year To</th>
														<th>Institution</th>
														<th>Result</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserEducation) > 0)
												<?php $no = 0; ?>											
												@foreach ($detail->UserEducation as $education)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $education->year_from }}</td>
													<td>{{ $education->year_to }}</td>
													<td>{{ $education->name_education }}</td>
													<td>{{ $education->result }}</td>
													<td class="text-right"><a href="{{ URL::route('mod.user.education.edit', array($education->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.education.delete', array($education->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="6">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.education.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
													
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>







						<!-- language -->
						<div class="tab-pane" id="language">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Language</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Dialect</th>
														<th>Description</th>
														<th>Written</th>
														<th>Read</th>
														<th>Spoken</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserLanguage) > 0)
												<?php $no = 0; ?>											
												@foreach ($detail->UserLanguage as $language)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $language->dialect }}</td>
													<td>{{ $language->desc }}</td>
													<td>{{ $language->WrittenLevel->name }}</td>
													<td>{{ $language->ReadingLevel->name }}</td>
													<td>{{ $language->SpokenLevel->name }}</td>               		
													<td class="text-right"><a href="{{ URL::route('mod.user.language.edit', array($language->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.language.delete', array($language->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="7">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.language.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
													
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>







						<!-- skill -->
						<div class="tab-pane" id="skill">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Skills</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Name</th>
														<th>Level</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserSkill) > 0)
												<?php $no = 0; ?>											
												@foreach ($detail->UserSkill as $skill)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $skill->name }}</td>
													<td>{{ $skill->SkillLevel->name }}</td>	              
													<td class="text-right"><a href="{{ URL::route('mod.user.skill.edit', array($skill->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.skill.delete', array($skill->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="4">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.skill.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>






						<!-- employment -->
						<div class="tab-pane" id="employment">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Employment History</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Year From</th>
														<th>Year To</th>
														<th>Company</th>
														<th>Position Held</th>
														<th>Salary</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserEmployment) > 0)
												<?php $no = 0; ?>											
												@foreach ($detail->UserEmployment as $employment)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ date('Y-m', strtotime($employment->date_from)) }}</td>
													<td>{{ date('Y-m', strtotime($employment->date_to)) }}</td>              
													<td>{{ $employment->company }}</td>           
													<td>{{ $employment->position }}</td>              
													<td>{{ $employment->salary }}</td>               		
													<td class="text-right"><a href="{{ URL::route('mod.user.employment.edit', array($employment->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.employment.delete', array($employment->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="7">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.employment.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>		
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>






						<!-- reference -->
						<div class="tab-pane" id="reference">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">References</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Name</th>
														<th>Relation</th>
														<th>Occupation</th>
														<th>Year Known</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserReference) > 0)
												<?php $no = 0; ?>
												@foreach ($detail->UserReference as $reference)
												<?php $no++; ?>
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $reference->name }}</td>
													<td>{{ $reference->relation }}</td>              
													<td>{{ $reference->occupation }}</td>              
													<td>{{ $reference->period_known }}</td>
													<td class="text-right"><a href="{{ URL::route('mod.user.reference.edit', array($reference->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="{{ URL::route('mod.user.reference.delete', array($reference->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Delete" id="reference-delete"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="6">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.reference.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>		
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>






						<!-- emergency -->
						<div class="tab-pane" id="emergency">

							<div class="row">
								<div class="col-md-12">

									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Emergency Contact</h4>
										</div>	

										<div class="panel-body nopadding">
											<table class="table table-striped table-condensed table-responsive table-hover">
												<thead>
													<tr class="active">
														<th>No</th>
														<th>Name</th>
														<th>Relationship</th>
														<th>Address</th>
														<th>Tel No.</th>
														<th class="actions text-right">Actions</th>
													</tr>
												</thead>
												@if (count($detail->UserEmergency) > 0)
												<?php $no = 0; ?>												
												@foreach ($detail->UserEmergency as $emergency)
												<?php $no++; ?>												
												<tr>
													<td>{{ $no }}</td>
													<td>{{ $emergency->name }}</td>
													<td>{{ $emergency->relation }}</td>					           
													<td>{{ $emergency->address }}</td>			              
													<td>{{ $emergency->telno }}</td>	              
													<td class="text-right"><a href="{{ URL::route('mod.user.emergency.edit', array($emergency->id, $detail->id, $detail->key)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a class="btn btn-primary btn-sm" title="Delete" href="{{ URL::route('mod.user.emergency.delete', array($emergency->id, $detail->id, $detail->key)) }}"><i class="icon-trash"></i></a></td>
												</tr>
												@endforeach
												@else
												<tr><td colspan="6">No record</td></tr>
												@endif
											</table>	

											<div class="row">
												<div class="col-sm-12">
													<a href="{{ URL::route('mod.user.emergency.add', array($detail->id, $detail->key)) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
												</div>
											</div>																										             
										</div>

									</div>
								</div>
							</div>
						</div>










						<!-- photo -->
						<div class="tab-pane" id="picture">

							<div class="row">
								<div class="col-md-12">


									{{ Form::open(array('id'=>'form-upload', 'role'=>'form', 'files' => true)) }}
									<div class="panel panel-primary">
										<div class="panel-heading">
											<h4 class="panel-title">Current Photo</h4>
										</div>	
										<div class="panel-body nopadding">
											<div class="form-group">
												@if ($photo)
													<?php 
													$img = asset("assets/images/user/".$photo->photo);
													$img_thumb = asset("assets/images/user/thumb/".$photo->photo_thumb); 
													?>
													<div class="d_photo" alt="1"><a href="{{ $img }}" target="_blank"><img src="{{ $img_thumb }}"></a></div>
												@else
													<div class="d_photo" alt="0"><img src="{{ asset('assets/images/default.png') }}"></div>
												@endif
											</div>
											<div class="form-group">
												<div class="btn-group">
													<button type="button" class="btn btn-primary" name="upload" title="Upload" id="photo-edit" alt="{{ $detail->id }}"><i class="icon-picture"></i>&nbsp;New</button>
													<button type="button" class="btn btn-danger" name="remove" title="Delete" id="photo-remove" alt="{{ $detail->id }}"><i class="icon-trash"></i>&nbsp;Delete</button>
												</div>	
											</div>
											<label>Upload Photo. Recommended size is 100kb and at minimum size. File format whether (jpg/jpeg/png/gif/bmp)</label>
										</div>          
									</div>
									<div class="modal fade" id="upload-modal"></div>
									<div id="token" alt="{{ csrf_token() }}"></div>
									{{ Form::hidden('uid', $detail->id, array('id' => 'uid')) }}
									{{ Form::hidden('base_url', URL::to('/'), array('id' => 'base_url')) }}
									{{ Form::close() }}	


								</div>
							</div>
						</div>   
					@endif                                                                                                                     





				</div>  
			</div>                 



		</div>
	</div>
</div>






<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('click','#family-delete',function(){
			var id = $(this).attr('alt'); 
			var answer = confirm('Are you sure want to delete this family record?');
			if (answer == true) {
				alert('ajax');
			}
			else {
				return false;
			}  
		});	






		$(document).on('click','#contract-delete',function(){
			var id = $(this).attr('alt'); 
			var answer = confirm('Are you sure want to delete this family record?');
			if (answer == true) {
				$.ajax({
					type: 'POST',
					data: {id: id, _token: $('#token').attr('alt')},
					url: $('#base_url').val() + '/modules/user/delete-contract',
					cache: false,
					success: function() {	 
						window.location = $('#base_url').val() + '/modules/user/detail/' + $('#uid').val();
					},
					complete: function(response, status, jqXHR){
					},
					error: function(e){
						console.log(e);
					}
				});
			}
			else {
				return false;
			}  
		});	





		$(document).on('click','#photo-edit',function() {  
			var id = $(this).attr('alt');		
			str =  '';   		
			str += '<div class="modal-dialog">';
			str += '	<div class="modal-content">';
			str += '		<div class="modal-header">';
			str += '			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
			str += '			<h4 class="modal-title">Select Photo</h4>';
			str += '		</div>';
			str += '		<div class="modal-body">';
			str += '			<div class="error-message" id="error"></div>';		
			str += '			<p><input type="file" name="photo" id="photo" /><input type="hidden" name="id" value="' + id + '" /></p>';
			str += '		</div>';
			str += '		<div class="modal-footer">';
			str += '			<div class="btn-group">';
			str += '				<button type="button" class="btn btn-success" id="photo-upload"><i class="icon-cloud-upload"></i>&nbsp;Upload</button>';
			str += '				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
			str += '			</div>';
			str += '		</div>';
			str += '	</div>';
			str += '</div>';
			$('#upload-modal').html(str);                                                    
			$('#upload-modal').modal();   
		}); 




		$(document).on('click','#photo-upload',function() {  
			var formData = new FormData($("#form-upload")[0]);
			var photo = $('#photo').val();
			$.ajax({                
				url: $('#base_url').val() + '/modules/user/photo/upload',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function(response, status, jqXHR){	 
					if (response['msg']['status'] == 0) {
						$('#error').html(response['msg']['error']);					
					}
					else {
						var path = $('#base_url').val() + '/assets/images/user/';
						var photo = response['msg']['photo'];										
						var photo_thumb = response['msg']['photo_thumb'];
						$('.d_photo').attr('alt', 1);
						$('.d_photo').html('<a href="' + path + photo + '" target="_blank"><img src="' + path + 'thumb/' + photo_thumb + '" class="img-thumbnail img-responsive" /></a>');
						$('#photo-remove').removeAttr('disabled');
						$('#upload-modal').modal('hide');
					}					          				
				},
				error: function(e){
					console.log(e);
				}                                                    
			});         
		});





		$(document).on('click','#photo-remove',function() {  
			if ($('.d_photo').attr('alt') == 1) {
				var id = $(this).attr('alt'); 
				var answer = confirm('Are you sure want to delete this photo?');
				if (answer == true) {
					$.ajax({
						type: 'POST',
						data: {id: id, _token: $('#token').attr('alt')},
						url: $('#base_url').val() + '/modules/user/photo/remove',
						cache: false,
						success: function(response, status, jqXHR){	 	
							if (response['msg']['status'] == 1) {
								$('.d_photo').attr('alt', 0);
								$('.d_photo').html('<img src="' + $('#base_url').val() + '/assets/images/default.png' + '" class="img-thumbnail img-responsive" />');
							}	
							else {
								alert(response['msg']['message']);
								return false;
							}		
						},
						error: function(e){
							console.log(e);
						}
					});
				}
				else {
					return false;
				} 			
			}
			else {
				alert('No photo to delete.');
				return false;
			}
		});



	});
</script>


@stop