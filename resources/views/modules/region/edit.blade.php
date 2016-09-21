@extends('layouts/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Region Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 





               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectName', 'Name (BM)') }}   
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
                     {{ Form::label('selectNameEng', 'Name (English)') }}   
                     @if ($errors->has('name_eng'))
                        <p class="text-danger">{{ $errors->first('name_eng') }}</p>
                     @endif      
                     {{ Form::text('name_eng', $detail->name_eng, array('class'=>'form-control', 'id' => 'selectNameEng', 'size' => 40)) }}                     
                     </div>
                  </div>
               </div>






               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectManager', 'Manager') }}   
                     @if ($errors->has('report_to'))
                        <p class="text-danger">{{ $errors->first('report_to') }}</p>
                     @endif       
                     {{ Form::select('report_to', $users, $detail->report_to, array('class' => 'form-control', 'id' => 'selectManager')) }}
                     </div>
                  </div>
               </div>






            </div>               
         </div>   




      {{ Form::hidden('id', $detail->id) }}          
      {{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
      {{ Form::close() }}  


   </div>      
</div>




@stop