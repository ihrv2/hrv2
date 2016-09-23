@extends('layout/backend')

@section('content')





{{ Form::open(array('class' => 'form-inline', 'id' => 'form-list', 'files' => true)) }} 
<div class="panel panel-primary">
	<div class="panel-heading">Leave Info</div>
	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">	


				<legend>Leave Details</legend>
				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Date Apply</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->date_apply }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Type of Leave</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->LeaveTypeName->name }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Description</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->desc }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Start Date</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->date_from }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">End Date</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->date_to }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Half Day</div>
					</div>
					<div class="col-sm-10">
						{{ Helper::LeaveHalfDay($leave->date_from, $leave->date_to, $leave->is_half_day) }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Reporting Officer</div>
					</div>
					<div class="col-sm-10">
						@if ($leave->LeaveReportToName)
							{{ $leave->LeaveReportToName->name }}
						@else
							{{ '-' }}
						@endif
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Current Attachment</div>
					</div>
					<div class="col-sm-10">
						@if ($attachment)
							{{ '<a href="'.$file.'" target="_blank">Download</a>' }}
						@else
							{{ '-' }}
						@endif
					</div>
				</div>				

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Total Days</div>
					</div>
					<div class="col-sm-10">
						{{ count($leave->LeaveDateAll) }}
					</div>
				</div>				

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Available Days</div>
					</div>
					<div class="col-sm-10">
						{{ count($leave->LeaveDate) }}					
					</div>
				</div>				
				<br>


				<legend>Apply Date</legend>
				@if ($leave->leave_date_all)
					@foreach ($leave->leave_date_all as $i)
						@if ($i->status == 0)
							<?php $label = 'Public Holiday'; ?>
						@else
							<?php $label = 'Available'; ?>
						@endif

						<div class="row">
							<div class="col-sm-2">
								<div class="input-group">{{ $i->leave_date }}</div>
							</div>
							<div class="col-sm-10">
								{{ $label }}
							</div>
						</div>
					@endforeach
				@else
					{{ '-' }}
				@endif
				<br>



				<legend>Status Info</legend>
				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Status</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->LeaveLatestHistory->LeaveStatusName->name }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Action Date</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->LeaveLatestHistory->action_date }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Action By</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->LeaveLatestHistory->LeaveActionByName->name }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Remarks</div>
					</div>
					<div class="col-sm-10">
						@if ($leave->LeaveLatestHistory->action_remark != '')
							{{ $leave->LeaveLatestHistory->action_remark }}
						@else
							{{ '-' }}
						@endif
					</div>
				</div>				
				<br>

				<div class="row">
					<div class="col-sm-12">
						@if ($leave->LeaveLatestHistory->LeaveStatusName->id == 1) 
							{{ "<i>Note: This leave is waiting for Approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 2)
							{{ "<i>Note: This leave is Approved.</i>"}}							
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 3)
							{{ "<i>Note: This leave is Rejected. Please contact Regional Officer for Further Information.</i>"}}
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 4)
							{{ "<i>Note: This leave already approve but Canceled by Site Supervisor. Awaits Approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 5)
							{{ "<i>Note: This leave already cancel. Awaits approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 6)
							{{ "<i>Note: This leave is Approved for Apply Cancel.</i>"}}
						@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 7)
							{{ "<i>Note: This leave is Rejected for Apply Cancel.</i>"}}
						@else
							{{ "<i>Note: Unknown status</i>" }}
						@endif
					</div>
				</div>
				<br>



				<legend>Previous Status</legend>
				<div class="well">
					<table class="table table-striped table-condensed table-responsive table-hover">
						<thead>
							<tr class="bg-default">
								<th>No</th>
								<th>Status</th>
								<th>Action Date</th>
								<th>Action By</th>														
								<th>Remarks</th>
							</tr>
						</thead>
						@if (count($history) > 0)
						<?php $no = 0; ?>
							@foreach ($history as $i)
							<?php $no++; ?>
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $i->LeaveStatusName->name }}</td>
								<td>{{ $i->action_date }}</td>
								<td>{{ $i->LeaveActionByName->name }}</td>
								<td>{{ $i->action_remark }}</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="5">No record</td>
							</tr>
						@endif
					</table>
				</div>    





			</div>
		</div>	          
	</div>



	<div class="panel-footer" align="left">
		@if ($leave->LeaveLatestHistory->LeaveStatusName->id == 1) 
			{{ Form::button('Cancel', array('class' => 'btn btn-danger', 'id' => 'popup-modal', 'title' => 'Cancel Leave', 'alt' => 5)) }}
		@elseif ($leave->LeaveLatestHistory->LeaveStatusName->id == 2)
			{{ Form::button('Cancel Approve', array('class' => 'btn btn-danger', 'id' => 'popup-modal', 'title' => 'Cancel Approve', 'alt' => 4)) }}
		@endif
	</div>
	<div class="modal fade" id="leave-modal"></div>




</div>





{{ Form::hidden('id', $leave->id) }}            
{{ Form::close() }}





<script type="text/javascript">
$(document).ready(function(){




	// save leave
    $(document).on('click','#leave-update',function(){
    	if ($('#remark').val() == "") {
    		alert('Please insert Remark.');
    	}
    	else {
	        var answer = confirm('Are you sure want to submit this leave?');
	        if (answer == true) {
	            $('#form-list').submit(); 
	        }
	        else {
	            return false;
	        } 
	    }
    });	    






    // display popup modal
	$(document).on('click','#popup-modal',function() {  
		var type = $(this).attr('alt');		
		str =  '';   		
		str += '<div class="modal-dialog">';
		str += '	<div class="modal-content">';
		str += '		<div class="modal-header">';
		str += '			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		str += '			<legend>Remarks</legend>';
		str += '		</div>';
		str += '		<div class="modal-body">';
		str += '			<div class="error-message" id="error"></div>';			
		str += '			<p><textarea name="remark" rows="4" cols="30" id="remark"></textarea></p><input type="hidden" name="type" value="' + type + '" />';
		str += '		</div>';
		str += '		<div class="modal-footer">';
		str += '			<div class="btn-group">';
		str += '				<button type="button" class="btn btn-primary" id="leave-update">Submit</button>';
		str += '				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
		str += '			</div>';
		str += '		</div>';
		str += '	</div>';
		str += '</div>';
		$('#leave-modal').html(str);                                                    
		$('#leave-modal').modal();   
	}); 





  
});  
</script>




@stop



