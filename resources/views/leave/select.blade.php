@extends('layouts/backend')

@section('content')




{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Add New Leave</h4>
	</div>	


	@if ($x['empty'] == 0 && $x['expired'] == 0)
		<div class="panel-body nopadding">			
			<div class="form-group">
				@if ($errors->has('leave_type_id'))
					<p class="col-lg-12 text-danger">{{ $errors->first('leave_type_id') }}</p>
				@endif      
				<div class="required"><label class="col-lg-3 control-label">Leave Type</label></div>
				<div class="col-lg-3">
					{{ Form::select('leave_type_id', $leave_types, null, array('class' => 'form-control')) }}
				</div>
			</div>		 
		</div> 
		<div class="panel-footer">
			{{ Form::button('Select&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}
		</div>
	@endif


	
	<!-- no contract record -->
	@if ($x['empty'] == 1) 
		<div class="panel-body nopadding">			
            <div class="row">
                <div class="col-md-12">No contract exist. Please contact HR.</div>
            </div>
		</div>
	@endif



	<!-- have contract info but date end is expired -->
	@if ($x['expired'] == 1) 
		<div class="panel-body nopadding">			
            <div class="row">
                <div class="col-md-12">Contract is expired. Please contact HR to renew.</div>
            </div>
		</div>
	@endif


	

</div>
{{ Form::close() }}  





@stop