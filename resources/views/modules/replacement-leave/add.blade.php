@extends('layouts/backend')

@section('content')



<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">





<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<legend>Staff Details</legend>
				<div class="row">
					<dl class="dl">
						<dt class="col-lg-3">Date Apply</dt>
						<dd class="col-lg-9">{{ date('d/m/Y') }}</dd>
						<dt class="col-lg-3">Name</dt>
						<dd class="col-lg-9"> -
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
			</div>
		</div>
	</div>
</div>







<div class="row">
	<div class="col-lg-12">



    	{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}
		<div class="panel panel-default">
			<div class="panel-body">



				<fieldset>
					<legend>Leave Details</legend>
					<div class="form-group">
						@if ($errors->has('no_day'))
							<p class="col-lg-12 text-danger">{{ $errors->first('no_day') }}</p>
						@endif   	
						<div class="required"> 					
							<label class="col-lg-3 control-label">No. of Days</label>
						</div>
						<div class="col-lg-2">
							{{ Form::select('no_day', array(), null, array('class' => 'form-control')) }}
						</div>
					</div>





					<div class="form-group">	
						@if ($errors->has('month'))
							<p class="col-lg-12 text-danger">{{ $errors->first('month') }}</p>
						@endif   
						@if ($errors->has('year'))
							<p class="col-lg-12 text-danger">{{ $errors->first('year') }}</p>
						@endif   															
						<div class="required"> 
							<label class="col-lg-3 control-label" for="textArea">Month & Year</label>
						</div>
						<div class="col-lg-4">
			               <div class="row">
			                  <div class="col-md-6">{{ Form::select('month', array_merge(['' => '[Month]']) + array(), null, ['class' => 'form-control']) }}</div>  
			                  <div class="col-md-6">{{ Form::selectRange('year', 2011, date('Y'), date('Y'), ['class' => 'form-control']) }}</div>
			               </div>							
						</div>
					</div>





					<div class="form-group">					
						<label class="col-lg-3 control-label" for="selectIns">Instructed By</label>
						<div class="col-lg-4">
							{{ Form::text('instructed_by', Input::old('instructed_by'), array('class'=>'form-control', 'id' => 'selectIns', 'size' => 40)) }}
						</div>
					</div>





					<div class="form-group">
						<label class="col-lg-3 control-label" for="selectLoc">Location</label>
						<div class="col-lg-4">
							{{ Form::text('location', Input::old('location'), array('class'=>'form-control', 'id' => 'selectLoc', 'size' => 40)) }}
						</div>
					</div>




					<div class="form-group"> 
						<label class="col-lg-3 control-label" for="textArea">Reason</label>
						<div class="col-lg-4">
							{{ Form::textarea('reason', Input::old('reason'), ['class' => 'form-control', 'size' => '30x3']) }}
						</div>
					</div>




					<div class="form-group">
						<label class="col-lg-3 control-label" for="textArea">Notes</label>
						<div class="col-lg-4">
							{{ Form::textarea('notes', Input::old('notes'), ['class' => 'form-control', 'size' => '30x3']) }}
						</div>
					</div>




					<div class="form-group" id="i2">
						<label class="col-lg-3 control-label" for="textArea">Attachment</label>
						<div class="col-lg-4">
							<label>
								{{ Form::file('rep_file') }}
							</label>
						</div>
					</div>
				</fieldset>
			</div>




			<div class="panel-footer">        
				{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-primary']) }} 
			</div>
		</div>



		{{ Form::close() }} 

 
	</div>
</div>







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








@stop