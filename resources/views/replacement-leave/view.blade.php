@extends('layout/backend')

@section('content')









{{ Form::open(array('class' => 'form-inline', 'id' => 'form-list')) }} 
<div class="panel panel-primary">
	<div class="panel-heading">Replacement Leave Info</div>
	<div class="panel-body">

		<div class="row">
			<div class="col-md-12">	

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Status</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->leave_rep_latest_history->leave_status_name->name }}
					</div>
				</div>

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
						<div class="input-group">Total Day</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->no_day }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Month & Year</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->month.'/'.$leave->year }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Instructed By</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->instructed_by }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Location</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->location }}
					</div>
				</div>

				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Reason</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->reason }}
					</div>
				</div>


				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Notes</div>
					</div>
					<div class="col-sm-10">
						{{ $leave->notes }}
					</div>
				</div>


				<div class="row">
					<div class="col-sm-2">
						<div class="input-group">Attachment</div>
					</div>
					<div class="col-sm-10">
						@if ($attachment)
							{{ '<a href="'.$file.'" target="_blank">Download</a>' }}
						@else
							{{ '-' }}
						@endif
					</div>
				</div>
				<br>



				<div class="row">
					<div class="col-sm-12">
						@if ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 1) 
							{{ "<i>Note: This leave is waiting for Approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 2)
							{{ "<i>Note: This leave is Approved.</i>"}}							
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 3)
							{{ "<i>Note: This leave is Rejected. Please contact Regional Officer for Further Information.</i>"}}
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 4)
							{{ "<i>Note: This leave already approve but Canceled by Site Supervisor. Awaits Approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 5)
							{{ "<i>Note: This leave already cancel. Awaits approval from Regional Officer.</i>"}}
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 6)
							{{ "<i>Note: This leave is Approved for Apply Cancel.</i>"}}
						@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 7)
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





	<div class="panel-footer">
		@if ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 1) 
			{{ Form::button('Cancel', array('class' => 'btn btn-danger', 'id' => 'popup-modal', 'title' => 'Cancel Leave', 'alt' => 5)) }}
		@elseif ($leave->LeaveRepLatestHistory->LeaveStatusName->id == 2)
			{{ Form::button('Cancel Approve', array('class' => 'btn btn-danger', 'id' => 'popup-modal', 'title' => 'Cancel Approve', 'alt' => 4)) }}
		@endif		
	</div>
	<div class="modal fade" id="leave-modal"></div>

	



</div>


{{ Form::hidden('id', $leave->id) }}            
{{ Form::close() }}



<script type="text/javascript">
$(document).ready(function(){




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



