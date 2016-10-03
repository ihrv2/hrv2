<!-- job -->
<div class="tab-pane" id="job">
	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Job Info</h4>
				</div>						      
				<div class="panel-body nopadding">


					<h5>Current Job</h5>
					<table class="table table-condensed table-striped table-responsive">	
						<tr>
							<td class="col-md-3">Staff ID</td>
							<td class="col-md-9">{{ $job->staff_id }}</td>
						</tr>					
						<tr>
							<td>Join Date</td>
							<td>{{ $job->join_date }}</td>
						</tr>

						<tr>
							<td>Position</td>
							<td>
								@if ($job->PositionName) {{ $job->PositionName->name }} @else {{ '-' }} @endif
							</td>
						</tr>	
						<tr>
							<td>Phase</td>
							<td>
								@if ($job->phase_id)
									{{ $job->PhaseName->name }}
								@else
									{{ '-' }}
								@endif
							</td>
						</tr>
						<tr>
							<td>Sitecode</td>
							<td>{{ $job->sitecode }}</td>
						</tr>			
						<tr>
							<td>Sitename</td>
							<td>{{ '-' }}</td>
						</tr>
						<tr>
							<td>Region</td>
							<td>{{ '-' }}
							</td>
						</tr>	
					</table>




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

						</table>
					</div>



				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

   $(document).on('click','#btn_id',function() {
      var answer = confirm('Do you want to delete this record?');
      if (answer == true) {
         $('#f_id').val($(this).attr('alt'));
      }
      else {
         return false;
      } 
   });

});
</script>



