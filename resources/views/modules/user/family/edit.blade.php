@extends('layout/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Family Info</div>
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
						{{ Form::label('selectAge', 'Age') }}   
						@if ($errors->has('age'))
							<p class="text-danger">{{ $errors->first('age') }}</p>
						@endif       
						{{ Form::text('age', $detail->age, array('class'=>'form-control', 'id' => 'selectAge', 'size' => 40)) }}                    
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectOccupation', 'Occupation') }}   
						@if ($errors->has('occupation'))
							<p class="text-danger">{{ $errors->first('occupation') }}</p>
						@endif                    
						{{ Form::text('occupation', $detail->occupation, array('class'=>'form-control', 'id' => 'selectOccupation', 'size' => 40)) }}       
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectOffice', 'School/Company') }}   
						@if ($errors->has('school_office'))
							<p class="text-danger">{{ $errors->first('school_office') }}</p>
						@endif              
						{{ Form::text('school_office', $detail->school_office, array('class'=>'form-control', 'id' => 'selectOffice', 'size' => 40)) }}             
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectRelation', 'Relation') }}   
						@if ($errors->has('relation'))
							<p class="text-danger">{{ $errors->first('relation') }}</p>
						@endif    
						{{ Form::text('relation', $detail->relation, array('class'=>'form-control', 'id' => 'selectRelation', 'size' => 40)) }}                       
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