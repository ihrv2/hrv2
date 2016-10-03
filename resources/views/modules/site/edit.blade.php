@extends('layouts/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Site Info</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
         <div class="row">             
            <div class="col-md-12">                 

               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectCode', 'Code') }}   
                     @if ($errors->has('code'))
                        <p class="text-danger">{{ $errors->first('code') }}</p>
                     @endif      
                     {{ Form::text('code', $detail->code, array('class'=>'form-control', 'id' => 'selectCode', 'size' => 40)) }}                     
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
                     {{ Form::label('selectEmail', 'Email') }}   
                     @if ($errors->has('email'))
                        <p class="text-danger">{{ $errors->first('email') }}</p>
                     @endif      
                     {{ Form::text('email', $detail->email, array('class'=>'form-control', 'id' => 'selectEmail', 'size' => 40)) }}                     
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectRegion', 'Region') }}   
                     @if ($errors->has('region_id'))
                        <p class="text-danger">{{ $errors->first('region_id') }}</p>
                     @endif      
                     {{ Form::select('region_id', $regions, $detail->region_id, array('class' => 'form-control', 'id' => 'selectRegion')) }}                     
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectState', 'State') }}   
                     @if ($errors->has('state_id'))
                        <p class="text-danger">{{ $errors->first('state_id') }}</p>
                     @endif      
                     {{ Form::select('state_id', $states, $detail->state_id, array('class' => 'form-control', 'id' => 'selectState')) }}                    
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
                     {{ Form::select('phase_id', $phases, $detail->phase_id, array('class' => 'form-control', 'id' => 'selectPhase')) }}                     
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectMukim', 'Mukim') }}   
                     @if ($errors->has('mukim_id'))
                        <p class="text-danger">{{ $errors->first('mukim_id') }}</p>
                     @endif      
                     {{ Form::select('mukim_id', $mukims, $detail->mukim_id, array('class' => 'form-control', 'id' => 'selectMukim')) }}                
                     </div>
                  </div>
               </div>

               <div class="form-group">
                  <div class="col-md-4">          
                     <div class="required">        
                     {{ Form::label('selectDistrict', 'District') }}   
                     @if ($errors->has('district_id'))
                        <p class="text-danger">{{ $errors->first('district_id') }}</p>
                     @endif      
                     {{ Form::select('district_id', $districts, $detail->district_id, array('class' => 'form-control', 'id' => 'selectDistrict')) }}                   
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