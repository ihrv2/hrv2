@extends('layout/backend')

@section('content')





<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">





<div class="panel panel-primary">
   <div class="panel-heading">Contract Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 





				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectStatusContract', 'Status Contract') }}   
						@if ($errors->has('status_contract_id'))
							<p class="text-danger">{{ $errors->first('status_contract_id') }}</p>
						@endif      
						{{ Form::select('status_contract_id', $status_contracts, null, array('class' => 'form-control', 'id' => 'selectStatusContract')) }}                 
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-3">  
		                @if ($errors->has('date_from'))
		                    <div class="text-danger">{{ $errors->first('date_from') }}</div>
		                @endif 					        
						<div class="required">{{ Form::label('selectStartDate', 'Start Date') }}</div>
						<div class="input-group date" id="pick_start_date">
							{{ Form::text('date_from', null, array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'selectStartDate')) }}
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>						
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-3">  
		                @if ($errors->has('date_to'))
		                    <div class="text-danger">{{ $errors->first('date_to') }}</div>
		                @endif 					        
						<div class="required">{{ Form::label('selectEndDate', 'End Date') }}</div>
						<div class="input-group date" id="pick_end_date">
							{{ Form::text('date_to', null, array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'selectEndDate')) }}
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>						
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectSalary', 'Salary') }}   
						@if ($errors->has('salary'))
							<p class="text-danger">{{ $errors->first('salary') }}</p>
						@endif              
						{{ Form::text('salary', $salary, array('class'=>'form-control', 'id' => 'selectSalary', 'size' => 40)) }}             
						</div>
					</div>
				</div>
				<br>



				<p><strong>Remarks: </strong>
				<br>1) Entitled Leave calculated automatically based on Start and End Date.
				</p>



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
    $('#pick_start_date').datetimepicker({
        pickTime: false
    });     
    $('#pick_end_date').datetimepicker({
        pickTime: false
    });            
});
</script>





@stop