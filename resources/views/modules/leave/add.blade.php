@extends('layouts/backend')

@section('content')




<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">





<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<legend>Staff Info</legend>
				<div class="row">
					<dl class="dl">
						<dt class="col-lg-3">Date Apply</dt>
						<dd class="col-lg-9">{{ date('d/m/Y') }}</dd>
						<dt class="col-lg-3">Name</dt>
						<dd class="col-lg-9">
							{{ Auth::user()->name }}
						</dd>
						<dt class="col-lg-3">Position</dt>
						<dd class="col-lg-9"> -
						</dd>
						<dt class="col-lg-3">Site Name</dt>
						<dd class="col-lg-9"> -
						</dd>
						<dt class="col-lg-3">Reporting Officer</dt>
						<dd class="col-lg-9">
							-
						</dd>
					</dl>
				</div>
				<br>

				<legend>Leave Info</legend>
				<div class="row">
					<dl class="dl">
						<dt class="col-lg-3">Leave Name</dt>
						<dd class="col-lg-9">-</dd>
						<dt class="col-lg-3">Entitled</dt>
						<dd class="col-lg-9">-</dd>
						<dt class="col-lg-3">Taken</dt>
						<dd class="col-lg-9">0</dd>
						<dt class="col-lg-3">Balance</dt>
						<dd class="col-lg-9">-</dd>						
					</dl>
				</div>

			</div>
		</div>
	</div>
</div>








{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}
<div class="row">
	<div class="col-lg-12">

			
		<div class="panel panel-default">
			<div class="panel-body">



				<fieldset>
					<legend>Leave New</legend>
					<div class="form-group">
						@if ($errors->has('desc'))
							<p class="col-lg-12 text-danger">{{ $errors->first('desc') }}</p>
						@endif  					
						<div class="required"> 
							<label class="col-lg-3 control-label" for="textArea">Description</label>
						</div>
						<div class="col-lg-4">
							{{ Form::textarea('desc', Input::old('desc'), ['class' => 'form-control', 'size' => '30x3']) }}
						</div>
					</div>




					<div class="form-group">
						@if ($errors->has('date_from'))
							<p class="col-lg-12 text-danger">{{ $errors->first('date_from') }}</p>
						@endif  					
						<div class="required"> 
							<label class="col-lg-3 control-label" for="select">Start Date</label>
						</div>
						<div class="col-lg-3">
							<div class="input-group date" id="pick_start_date">
								{{ Form::text('date_from', null, array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'date1', 'readonly')) }}
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>	
						</div>
					</div>






					<div class="form-group">
						@if ($errors->has('date_to'))
							<p class="col-lg-12 text-danger">{{ $errors->first('date_to') }}</p>
						@endif  					
						<div class="required"> 
							<label class="col-lg-3 control-label" for="select">End Date</label>
						</div>
						<div class="col-lg-3">
							<div class="input-group date" id="pick_end_date">
								{{ Form::text('date_to', null, array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'date2', 'readonly')) }}
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>	
						</div>
					</div>






					<div class="form-group">
						<label class="col-lg-3 control-label" for="select">Half Day</label>
						<div class="col-lg-3">
							<div class="checkbox">
								<label>
									{{ Form::checkbox('is_half_day', 1) }}&nbsp;Please tick if required
								</label>
							</div>							
						</div>
					</div>



					<div class="form-group" id="i2">
						@if ($errors->has('leave_file'))
							<p class="col-lg-12 text-danger">{{ $errors->first('leave_file') }}</p>
						@endif  					
						<label class="col-lg-3 control-label" for="textArea">Attachment</label>
						<div class="col-lg-4">
							<label>
								{{ Form::file('leave_file') }}
								<label>file of type: jpeg/jpg/bmp/png/pdf/doc/docx.</label>
							</label>
						</div>
					</div>




					<p><strong>Remarks: </strong>
					<br>1) Please ensure the correct info before submittng this leave. Once successfully it will send the notification to Reporting Officer.
					<br>2) End Date for Haji/Umrah/Maternity/Paternity/Marriage is calculate automatically.
					</p>
				</fieldset>
			</div>




			<div class="panel-footer">    		
				{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-primary']) }} 
			</div>
		</div>



		

 
	</div>
</div>

{{ Form::close() }} 





<script type="text/javascript">
$(function () {
    $('#pick_start_date').datetimepicker({
        pickTime: false
    });        
    $('#pick_end_date').datetimepicker({
        pickTime: false
    });      
});
</script>







<script type="text/javascript">
var rowNum = 0;
function addRow(frm) {
	rowNum ++;
	var row =   
		'<div id="rowNum' + rowNum + '" class="row" style="margin-bottom: 2px">' + 
			'<div class="col-md-8">' +
				'<input type="file" name="picture[]" id="picture[]' + rowNum + '">' +
			'</div>' +
			'<div class="col-md-4 text-right">' +
				'<button type="button" class="btn btn-sm btn-danger" onclick="removeRow(' + rowNum + ');"<i class="icon-trash"></i></button>' +
			'</div>' +
		'</div>'
	;
	jQuery('#i2').append(row);
}
function removeRow(rnum) {
	jQuery('#rowNum'+rnum).remove();
}
</script>








@stop