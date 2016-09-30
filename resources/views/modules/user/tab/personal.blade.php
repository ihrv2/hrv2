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
							<td>{{ $personal->StatusName->name }}</td>
						</tr>
						<tr>
							<td>Staff ID</td>
							<td>{{ $personal->username }}</td>
						</tr>								            
						<tr>
							<td class="col-md-3">Full Name</td>
							<td class="col-md-9">{{ $personal->name }}</td>
						</tr>
						<tr>
							<td>Email</td>
							<td>{{ $personal->email }}</td>
						</tr>
						<tr>
							<td>IC No</td>
							<td>{{ $personal->icno }}</td>
						</tr>		
						<tr>
							<td>Telephone No 1</td>
							<td>{{ $personal->telno }}</td>
						</tr>
						<tr>
							<td>Telephone No 2</td>
							<td>{{ $personal->telno }}</td>
						</tr>											
						<tr>
							<td>Mobile No</td>
							<td>{{ $personal->hpno }}</td>
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
								@if ($personal->GenderName) 
								{{ $personal->GenderName->eng }}
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
								@if ($personal->MaritalStatus)
								{{ $personal->MaritalStatus->name }}
								@endif
							</td>
						</tr>
						<tr>
							<td>Height</td>
							<td>{{ $personal->height }}</td>
						</tr>	
						<tr>
							<td>Weight</td>
							<td>{{ $personal->weight }}</td>
						</tr>		
						<tr>
							<td>Race</td>
							<td>
								@if ($personal->RaceName)
									{{ $personal->RaceName->eng }}
								@endif
							</td>
						</tr>
						<tr>
							<td>Religion</td>
							<td>
								@if ($personal->ReligionName)
									{{ $personal->ReligionName->name }}
								@endif
							</td>
						</tr>	
						<tr>
							<td>Nationality</td>
							<td>
								@if ($personal->NationalityName)
								{{ $personal->NationalityName->eng }}
								@endif
							</td>
						</tr>		
						<tr>
							<td>Date of Birth</td>
							<td>{{ $personal->dob }}</td>
						</tr>
						<tr>
							<td>Place of Birth</td>
							<td>{{ $personal->pob }}</td>
						</tr>	
						<tr>
							<td>Email</td>
							<td>{{ $personal->email }}</td>
						</tr>
						<tr>
							<td>Staff Level</td>
							<td>
								@if ($personal->GroupName)
								{{ $personal->GroupName->name }}
								@endif
							</td>
						</tr>	
						<tr>
							<td>Income Tax No.</td>
							<td>{{ $personal->itaxno }}</td>
						</tr>
						<tr>
							<td>EPF No.</td>
							<td>{{ $personal->epfno }}</td>
						</tr>
						<tr>
							<td>Socso No.</td>
							<td>{{ $personal->socsono }}</td>
						</tr>
						<tr>
							<td>Bank Name</td>
							<td>{{ $personal->bankname }}</td>
						</tr>							            	
						<tr>
							<td>Bank Account No.</td>
							<td>{{ $personal->bankno }}</td>
						</tr>
					</table>
				</div>
			</div>

		</div>
	</div>                    	
</div>