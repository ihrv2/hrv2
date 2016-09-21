@extends('layouts/backend')

@section('content')


{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Registration - {{ \App\Models\Group::find(Session::get('group_id'))->name }}</h4>
	</div>	
	<div class="panel-body nopadding">



		<legend>User Info</legend>
		<div class="form-group">
			@if ($errors->has('name'))
			<p class="col-lg-12 text-danger">{{ $errors->first('name') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Full Name</label></div>
			<div class="col-lg-3">
				{{ Form::text('name', null, array('class'=>'form-control')) }}
			</div>
		</div>



		<div class="form-group">  
			<label class="col-lg-3 control-label">IC No.</label>
			<div class="col-lg-3">
				{{ Form::text('icno', null, array('class'=>'form-control', 'maxlength' => 12)) }}
			</div>
		</div>







		<div class="form-group">
			@if ($errors->has('position_id'))
			<p class="col-lg-12 text-danger">{{ $errors->first('position_id') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Position</label></div>
			<div class="col-lg-3">
				{{ Form::select('position_id', $positions, null, array('class' => 'form-control', 'id' => 'position_id')) }}
			</div>
		</div>



		@if (Session::get('group_id') == 4)
		<div class="form-group">
			@if ($errors->has('region_id'))
			<p class="col-lg-12 text-danger">{{ $errors->first('region_id') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Region</label></div>
			<div class="col-lg-3">
				{{ Form::select('region_id', $regions, null, array('class' => 'form-control', 'id' => 'region_id')) }}
			</div>
		</div>
		@endif




		@if (Session::get('group_id') == 3)
		<div class="form-group">
			@if ($errors->has('phase_id'))
			<p class="col-lg-12 text-danger">{{ $errors->first('phase_id') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Phase</label></div>
			<div class="col-lg-3">
				{{ Form::select('phase_id', $phases, null, array('class' => 'form-control', 'id' => 'phase_id')) }}
			</div>
		</div>

		<div class="form-group">
			@if ($errors->has('sitecode'))
			<p class="col-lg-12 text-danger">{{ $errors->first('sitecode') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Site Name</label></div>
			<div class="col-lg-3">
				{{ Form::select('sitecode', $sites, null, array('class' => 'form-control', 'id' => 'sitecode')) }}
			</div>
		</div>
		@endif




		<div class="form-group">
			@if ($errors->has('staff_id'))
			<p class="col-lg-12 text-danger">{{ $errors->first('staff_id') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Staff ID</label></div>
			<div class="col-lg-3">
				{{ Form::text('staff_id', null, array('class'=>'form-control')) }}
			</div>
		</div>



		<legend>Login Info</legend>
		<div class="form-group">
			@if ($errors->has('email'))
			<p class="col-lg-12 text-danger">{{ $errors->first('email') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Email</label></div>
			<div class="col-lg-3">
				{{ Form::text('email', null, array('class'=>'form-control')) }}
			</div>
		</div>




		<div class="form-group">
			@if ($errors->has('password'))
			<p class="col-lg-12 text-danger">{{ $errors->first('password') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Password</label></div>
			<div class="col-lg-3">
				{{ Form::password('password', array('class'=>'form-control')) }}
			</div>
		</div>		

	</div> 

	<div class="panel-footer">
		{{ Form::hidden('group_id', Session::get('group_id')) }}
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}
	</div>


</div>
{{ Form::close() }}  






@stop





