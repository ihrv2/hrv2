@extends('layout/backend')

@section('content')





<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">





<div class="panel panel-primary">
   <div class="panel-heading">Job Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 





				<div class="form-group">
					<div class="col-md-4">  
		                @if ($errors->has('join_date'))
		                    <div class="text-danger">{{ $errors->first('join_date') }}</div>
		                @endif 					        
						<div class="required">{{ Form::label('selectStartDate', 'Join Date') }}</div>
						<div class="input-group date" id="pick_register_date">
							{{ Form::text('join_date', null, array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'selectStartDate')) }}
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>						
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectPosition', 'Position') }}   
						@if ($errors->has('position_id'))
							<p class="text-danger">{{ $errors->first('position_id') }}</p>
						@endif       
						{{ Form::select('position_id', $positions, null, array('class' => 'form-control', 'id' => 'selectPosition')) }}
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectPhase', 'Phase') }}   
						@if ($errors->has('phase_id'))
							<p class="text-danger">{{ $errors->first('phase_id') }}</p>
						@endif       
						{{ Form::select('phase_id', $phases, null, array('class' => 'form-control', 'id' => 'selectPhase')) }}
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectSite', 'Site') }}   
						@if ($errors->has('sitecode'))
							<p class="text-danger">{{ $errors->first('sitecode') }}</p>
						@endif       
						{{ Form::select('sitecode', $sites, null, array('class' => 'form-control', 'id' => 'selectSite')) }}
						</div>
					</div>
				</div>





            </div>               
         </div>   

      	{{ Form::hidden('uid', $i['uid']) }}
		{{ Form::hidden('key', $i['key']) }}		
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
		{{ Form::close() }}  


   </div>      
</div>




<script type="text/javascript">
$(function () {
    $('#pick_register_date').datetimepicker({
        pickTime: false
    });         
});
</script>





@stop