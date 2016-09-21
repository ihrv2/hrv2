@extends('layout/backend')

@section('content')



<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">




<div class="panel panel-primary">
   <div class="panel-heading">Edit Job Info</div>
   <div class="panel-body">





         {{ Form::open(array('class' => 'form-horizontal', 'role'=>'form')) }}
         <div class="row">             
            <div class="col-md-4"> 





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">     
							{{ Form::label('selectJoinDate', 'Join Date') }}
							<div class="input-group date" id="pick_join_date">
								{{ Form::text('join_date', date('d/m/Y', strtotime($detail->join_date)), array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'selectJoinDate')) }}
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectPhase', 'Phase') }}   
							@if ($errors->has('phase_id'))
								<p class="text-danger">{{ $errors->first('phase_id') }}</p>
							@endif   
							{{ Form::select('phase_id', $phases, $detail->phase_id, array('class' => 'form-control', 'id' => 'selectPhase')) }}                      
						</div>
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectPosition', 'Position') }}   
							@if ($errors->has('position_id'))
								<p class="text-danger">{{ $errors->first('position_id') }}</p>
							@endif   
							{{ Form::select('position_id', $positions, $detail->position_id, array('class' => 'form-control', 'id' => 'selectPosition')) }}                      
						</div>
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectSite', 'Site') }}   
							@if ($errors->has('sitecode'))
								<p class="text-danger">{{ $errors->first('sitecode') }}</p>
							@endif   
							{{ Form::select('sitecode', $sites, $detail->sitecode, array('class' => 'form-control', 'id' => 'selectSite')) }}                      
						</div>
					</div>
				</div>
		
               {{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger'])  }}       






            </div>               
        </div>   
		{{ Form::hidden('id', $i['id']) }}
      	{{ Form::hidden('uid', $i['uid']) }}            
		{{ Form::hidden('key', $i['key']) }}      	
        {{ Form::close() }}  






   </div>
      
</div>


<script type="text/javascript">
$(function () {
    $('#pick_join_date').datetimepicker({
        pickTime: false
    });         
});
</script>


@stop



