@extends('layout/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Employment Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 






            <div class="form-group">
               <div class="col-md-4">          
                  <div class="required">        
                     {{ Form::label('', 'Year From') }}   
                     @if ($errors->has('from_month'))
                        <p class="text-danger">{{ $errors->first('from_month') }}</p>
                     @endif   
                     @if ($errors->has('from_year'))
                        <p class="text-danger">{{ $errors->first('from_year') }}</p>
                     @endif                     
                     <div class="row">
                        <div class="col-md-6">{{ Form::selectMonth('from_month', date('m'), ['class' => 'form-control']) }}</div>
                        <div class="col-md-6">{{ Form::selectYear('from_year', 1950, date('Y'), date('Y'), ['class' => 'form-control']) }}</div>
                     </div>               
                  </div>
               </div>
            </div>





            <div class="form-group">
               <div class="col-md-4">          
                  <div class="required">        
                     {{ Form::label('', 'Year To') }}   
                     @if ($errors->has('to_month'))
                        <p class="text-danger">{{ $errors->first('to_month') }}</p>
                     @endif   
                     @if ($errors->has('to_year'))
                        <p class="text-danger">{{ $errors->first('to_year') }}</p>
                     @endif                        
                     <div class="row">
                        <div class="col-md-6">{{ Form::selectMonth('to_month', date('m'), ['class' => 'form-control']) }}</div>
                        <div class="col-md-6">{{ Form::selectYear('to_year', 1950, date('Y'), date('Y'), ['class' => 'form-control']) }}</div>
                     </div>               
                  </div>
               </div>
            </div>





            <div class="form-group">
               <div class="col-md-4">          
                  <div class="required">        
                  {{ Form::label('selectCompany', 'Company') }}   
                  @if ($errors->has('company'))
                     <p class="text-danger">{{ $errors->first('company') }}</p>
                  @endif      
                  {{ Form::text('company', Input::old('company'), array('class'=>'form-control', 'id' => 'selectCompany', 'size' => 40)) }}                     
                  </div>
               </div>
            </div>


            <div class="form-group">
               <div class="col-md-4">          
                  <div class="required">        
                  {{ Form::label('selectPosition', 'Position') }}   
                  @if ($errors->has('position'))
                     <p class="text-danger">{{ $errors->first('position') }}</p>
                  @endif      
                  {{ Form::text('position', Input::old('position'), array('class'=>'form-control', 'id' => 'selectPosition', 'size' => 40)) }}                     
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
                  {{ Form::text('salary', Input::old('salary'), array('class'=>'form-control', 'id' => 'selectSalary', 'size' => 40)) }}                     
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




@stop