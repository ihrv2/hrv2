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
									<div class="text-right"><a href="{{ route('mod.user.contract.edit', array($curr_contract->id, $user['id'], $user['token'])) }}" class="btn btn-danger" title="Edit"><i class="icon-note"></i>&nbsp;Edit</a>
							</tr>						            
						</table>
					@endif


					@if (count($prev_contract) > 0)					
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
											<a href="{{ route('mod.user.contract.edit', array($contract->id, $user['id'], $user['token'])) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a>
										</td>
									</tr>
									@endforeach
							</table>
						</div>   
					@endif


					<div class=""><a href="{{ route('mod.user.contract.create', array($user['id'], $user['token'])) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a></div>



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
         $('#c_id').val($(this).attr('alt'));
      }
      else {
         return false;
      } 
   });

});
</script>

