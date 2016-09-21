@extends('layout/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Skill Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 


				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectName', 'Name') }}   
						@if ($errors->has('name'))
							<p class="text-danger">{{ $errors->first('name') }}</p>
						@endif      
						{{ Form::text('name', $detail->name, array('class'=>'form-control', 'id' => 'selectName', 'size' => 40)) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectLevel', 'Level') }}   
						@if ($errors->has('level'))
							<p class="text-danger">{{ $errors->first('level') }}</p>
						@endif      
						{{ Form::select('level', $levels, $detail->level_id, array('class' => 'form-control', 'id' => 'selectLevel')) }}                 
						</div>
					</div>
				</div>




            </div>               
         </div>   


		{{ Form::hidden('id', $i['id']) }}
		{{ Form::hidden('uid', $i['uid']) }}            
		{{ Form::hidden('key', $i['key']) }}		
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
		{{ Form::close() }}  


   </div>      
</div>




@stop