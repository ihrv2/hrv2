@extends('layouts/backend')

@section('content')


<div class="row">
   <div class="col-md-12">
      <div class="well">




         {{ Form::open(array('class' => 'form-horizontal', 'id' => 'form-search')) }}  
         <div class="row">
            <div class="col-md-6">                              
               <div class="row">
                  <div class="col-md-6">{{ Form::select('year', array_combine(range(2008, date('Y')), range(2008, date('Y'))), 2016, array('class' => 'form-control')) }}</div>  
                  <div class="col-md-6">{{ Form::select('leave_status', array(), null, array('class' => 'form-control')) }}</div>
               </div>
               <br>
               {{ Form::button('Search', array('class' => 'btn btn-warning', 'type' => 'submit','name' => 'btn-search')) }}
            </div>
         </div>
         {{ Form::close() }}




      </div>
   </div>            
</div>



<div class="row">
   <div class="col-sm-12">


      <div class="well">
         <table class="table table-striped table-condensed table-responsive">
            <thead>
               <tr><td colspan="8" align="center"><h5></h5></td></tr>
               <tr class="bg-primary">
                  <th>No</th>
                  <th class="text-center">Date Apply</th>
                  <th class="text-center">Start Date</th>
                  <th class="text-center">End Date</th>
                  <th class="text-center">Total</th>
                  <th class="text-center">Available</th>
                  <th class="text-center">Status</th>
                  <th class="text-center">Action Date</th>
                  <th class="actions text-right">Actions</th>
               </tr>
            </thead>
         </table>





      </div>

   </div>
</div>

@stop