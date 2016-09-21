@extends('layout/backend')

@section('content')



<div class="panel panel-primary">
   <div class="panel-heading">Change Password</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role'=>'form')) }}
         <div class="row">             
            <div class="col-md-3">                 
               <div class="form-group">
                  <div class="col-md-12">          
                     <div class="required">        
                     {{ Form::label('newPassword', 'New Password') }}   
                     @if ($errors->has('new_password'))
                        <p class="text-danger">{{ $errors->first('new_password') }}</p>
                     @endif                           
                     {{ Form::password('new_password', array('class'=>'form-control', 'id' => 'newPassword')) }}                                                  
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-md-12">       
                     <div class="required">           
                     {{ Form::label('confirmNewPassword', 'Confirm New Password') }}
                     @if ($errors->has('confirm_new_password'))
                        <p class="text-danger">{{ $errors->first('confirm_new_password') }}</p>
                     @endif                           
                     {{ Form::password('confirm_new_password', array('class'=>'form-control', 'id' => 'confirmNewPassword')) }}                                                     
                     </div>
                  </div>
               </div>      
               {{ Form::hidden('id', $detail->id) }}
               {{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}
            </div>               
         </div>   
         {{ Form::close() }}  




   </div>
      
</div>




@stop