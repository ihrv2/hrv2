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
						<dd class="col-lg-9">{{ Auth::user()->name }}
						</dd>
						<dt class="col-lg-3">Position</dt>
						<dd class="col-lg-9">{{ $job->PositionName->name }}
						</dd>
						<dt class="col-lg-3">Site Name</dt>
						<dd class="col-lg-9">{{ Auth::user()->sitecode }}
						</dd>
						<dt class="col-lg-3">Reporting Officer</dt>
						<dd class="col-lg-9">{{ $rm['RegionName']['RegionManager']['name'] }}</dd>
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
					<legend>Leave Details</legend>
					<div class="form-group">
						@if ($errors->has('no_day'))
							<p class="col-lg-12 text-danger">{{ $errors->first('no_day') }}</p>
						@endif   	
						<div class="required"> 					
							<label class="col-lg-3 control-label">No. of Days</label>
						</div>
						<div class="col-lg-2">
							{{ Form::select('no_day', $days, old('no_day'), array('class' => 'form-control')) }}
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
			                  <div class="col-md-6">{{ Form::selectMonth('month', old('month'), ['class' => 'form-control']) }}</div>  
			                  <div class="col-md-6">{{ Form::selectRange('year', 2011, date('Y'), old('year'), ['class' => 'form-control']) }}</div>
			               </div>							
						</div>
					</div>





					<div class="form-group">					
						<label class="col-lg-3 control-label" for="selectIns">Instructed By</label>
						<div class="col-lg-4">
							{{ Form::text('instructed_by', old('instructed_by'), array('class'=>'form-control', 'id' => 'selectIns', 'size' => 40)) }}
						</div>
					</div>





					<div class="form-group">
						<label class="col-lg-3 control-label" for="selectLoc">Location</label>
						<div class="col-lg-4">
							{{ Form::text('location', old('location'), array('class'=>'form-control', 'id' => 'selectLoc', 'size' => 40)) }}
						</div>
					</div>




					<div class="form-group"> 
						<label class="col-lg-3 control-label" for="textArea">Reason</label>
						<div class="col-lg-4">
							{{ Form::textarea('reason', old('reason'), ['class' => 'form-control', 'size' => '30x3']) }}
						</div>
					</div>




					<div class="form-group">
						<label class="col-lg-3 control-label" for="textArea">Notes</label>
						<div class="col-lg-4">
							{{ Form::textarea('notes', old('notes'), ['class' => 'form-control', 'size' => '30x3']) }}
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


	</div>
</div>




{{ Form::hidden('report_to', $rm['RegionName']['RegionManager']['id']) }} 
{{ Form::close() }} 



@stop




