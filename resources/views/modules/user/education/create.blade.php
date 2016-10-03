@extends('layouts/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Education Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 





				<div class="form-group">
					<div class="col-md-2">          
						<div class="required">        
						{{ Form::label('selectStart', 'Year From') }}   
						@if ($errors->has('year_from'))
							<p class="text-danger">{{ $errors->first('year_from') }}</p>
						@endif      
						{{ Form::select('year_from', array_combine(range(1950, date('Y')), range(1950, date('Y'))), old('year_from'), array('class' => 'form-control', 'id' => 'year')) }}                    
						</div>
					</div>
				</div>



				<div class="form-group">
					<div class="col-md-2">          
						<div class="required">        
						{{ Form::label('selectEnd', 'Year To') }}   
						@if ($errors->has('year_to'))
							<p class="text-danger">{{ $errors->first('year_to') }}</p>
						@endif       
						{{ Form::select('year_to', array_combine(range(1950, date('Y')), range(1950, date('Y'))), old('year_to'), array('class' => 'form-control', 'id' => 'year')) }}               
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectInstitution', 'Institution') }}   
						@if ($errors->has('name_education'))
							<p class="text-danger">{{ $errors->first('name_education') }}</p>
						@endif                    
						{{ Form::text('name_education', old('name_education'), array('class'=>'form-control', 'id' => 'selectInstitution', 'size' => 40)) }}       
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
						{{ Form::label('selectResult', 'Result') }}   
						@if ($errors->has('result'))
							<p class="text-danger">{{ $errors->first('result') }}</p>
						@endif              
						{{ Form::text('result', old('result'), array('class'=>'form-control', 'id' => 'selectResult', 'size' => 40)) }}             
						</div>
					</div>
				</div>

											

            </div>               
         </div>   

		
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
		{{ Form::close() }}  


   </div>      
</div>




@stop