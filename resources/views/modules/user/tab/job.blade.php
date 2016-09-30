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
					</table>


				</div>
			</div>
		</div>
	</div>
</div>
