@extends('layouts/backend')

@section('content')




{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
<div class="panel panel-primary">
	<div class="panel-heading">
		<h4 class="panel-title">Select Group</h4>
	</div>	
	<div class="panel-body nopadding">		
		<div class="form-group">
			@if ($errors->has('group_id'))
			<p class="col-lg-12 text-danger">{{ $errors->first('group_id') }}</p>
			@endif      
			<div class="required"><label class="col-lg-3 control-label">Group Level</label></div>
			<div class="col-lg-3">
				{{ Form::select('group_id', $groups, null, array('class' => 'form-control', 'id' => 'group_id', 'data-url' => url('api/dropdown_position'))) }}
			</div>
		</div>		 
	</div> 
	<div class="panel-footer">
		{{ Form::button('Select&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}   		
	</div>

</div>
{{ Form::close() }}  





@stop