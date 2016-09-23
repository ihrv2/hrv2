@extends('layouts/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Contact Info</div>
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
                     {{ Form::label('selectTelno', 'Telephone No.') }}   
                     @if ($errors->has('telno'))
                        <p class="text-danger">{{ $errors->first('telno') }}</p>
                     @endif      
                     {{ Form::text('telno', $detail->telno, array('class'=>'form-control', 'id' => 'selectTelno', 'size' => 40)) }}                     
                     </div>
                  </div>
               </div>


               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectAddress', 'Address') }}   
                     @if ($errors->has('address'))
                        <p class="text-danger">{{ $errors->first('address') }}</p>
                     @endif      
                     {{ Form::text('address', $detail->address, array('class'=>'form-control', 'id' => 'selectAddress', 'size' => 40)) }}                     
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

		
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
		{{ Form::close() }}  


   </div>      
</div>




@stop