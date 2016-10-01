@extends('layouts/backend')

@section('content')



<script type="text/javascript">
$(document).ready(function(){

	$('#detail a').click(function (e) {
		e.preventDefault();
	  
		var url = $(this).attr("data-url");
	  	var href = this.hash;
	  	var pane = $(this);
		
		// ajax load from data-url
		$(href).load(url,function(result){      
		    pane.tab('show');
		});
	});


})


</script>




<div class="row">
	<div class="col-sm-12">
		<div class="well">




			<div class="panel-body">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="detail">
					<li class="active"><a data-url="{{ route('mod.user.view.personal', array($detail->id, $detail->api_token)) }}" href="#personal">Personal</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.job', array($detail->id, $detail->api_token)) }}" href="#job">Jobs</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.contract', array($detail->id, $detail->api_token)) }}" href="#contract">Contract</a></li>	
					<li class=""><a data-url="{{ route('mod.user.view.family', array($detail->id, $detail->api_token)) }}" href="#family">Family</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.education', array($detail->id, $detail->api_token)) }}" href="#education">Education</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.language', array($detail->id, $detail->api_token)) }}" href="#language">Language</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.skill', array($detail->id, $detail->api_token)) }}" href="#skill">Skills</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.employment', array($detail->id, $detail->api_token)) }}" href="#employment">Employment History</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.reference', array($detail->id, $detail->api_token)) }}" href="#reference">References</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.emergency', array($detail->id, $detail->api_token)) }}" href="#emergency">Emergency Contact</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.photo', array($detail->id, $detail->api_token)) }}" href="#photo">Photo</a></li>  									          
				</ul>



				<div class="tab-content">



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
												<td>Staff ID</td>
												<td>{{ $detail->username }}</td>
											</tr>								            
											<tr>
												<td class="col-md-3">Full Name</td>
												<td class="col-md-9">{{ $detail->name }}</td>
											</tr>
											<tr>
												<td>Email</td>
												<td>{{ $detail->email }}</td>
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

					<div class="tab-pane" id="job"></div>
					<div class="tab-pane" id="contract"></div>
					<div class="tab-pane" id="family"></div>
					<div class="tab-pane" id="education"></div>
					<div class="tab-pane" id="language"></div>
					<div class="tab-pane" id="skill"></div>
					<div class="tab-pane" id="employment"></div>
					<div class="tab-pane" id="reference"></div>
					<div class="tab-pane" id="emergency"></div>
					<div class="tab-pane" id="photo"></div>
					
				</div>

			</div>                 



		</div>
	</div>
</div>







@stop