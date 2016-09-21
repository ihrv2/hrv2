@extends('layouts/backend')



@section('content')



{!! Form::open(array('class' => 'form-horizontal', 'role'=>'form')) !!}

<div class="panel panel-default">
   <div class="panel-heading">Change Password</div>
   <div class="panel-body">

      
         <div class="form-group">
            @if ($errors->has('old_password'))
               <p class="col-lg-12 text-danger">{{ $errors->first('old_password') }}</p>
            @endif      
            <div class="required col-lg-3">              
               <label class="control-label" for="select">Current Password</label>
            </div>
            <div class="col-lg-3">
               {{ Form::password('old_password', array('class'=>'form-control', 'id' => 'oldPassword')) }}
            </div>
         </div>

         <div class="form-group">
            @if ($errors->has('new_password'))
               <p class="col-lg-12 text-danger">{{ $errors->first('new_password') }}</p>
            @endif      
            <div class="required col-lg-3"> 
               <label class="control-label" for="select">New Password</label>
            </div>
            <div class="col-lg-3">
               {{ Form::password('new_password', array('class'=>'form-control', 'id' => 'newPassword')) }}                                                  
            </div>
         </div>

         <div class="form-group">
            @if ($errors->has('confirm_new_password'))
               <p class="col-lg-12 text-danger">{{ $errors->first('confirm_new_password') }}</p>
            @endif      
            <div class="required col-lg-3">              
               <label class="control-label" for="select">Confirm New Password</label>
            </div>
            <div class="col-lg-3">
               {{ Form::password('confirm_new_password', array('class'=>'form-control', 'id' => 'confirmNewPassword')) }}                                                     
            </div>
         </div>

   </div>


   <div class="panel-footer" align="left">
      {{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger'])  }}
   </div>
</div>
{!! Form::close() !!}




@stop


