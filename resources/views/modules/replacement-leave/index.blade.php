@extends('layouts/backend')

@section('content')




<div class="row">
   <div class="col-md-12">
      <div class="well">




         {{ Form::open(array('class' => 'form-horizontal', 'id' => 'form-search')) }}  
         <div class="row">
            <div class="col-md-6">                              
               <div class="row">
                  <div class="col-md-6">{{ Form::select('year', array_combine(range(2008, date('Y')), range(2008, date('Y'))), null, array('class' => 'form-control')) }}</div>
                  <div class="col-md-6">{{ Form::select('leave_status', array(), null, array('class' => 'form-control')) }}</div>
               </div>  
               <br>
               {{ Form::button('Search', array('class' => 'btn btn-warning', 'type' => 'submit', 'name' => 'btn-search')) }}
            </div>
         </div>
         {{ Form::close() }}




      </div>
   </div>            
</div>



<div class="row">
   <div class="col-sm-12">




      <div class="well">
         <table class="table table-striped table-condensed table-responsive table-hover">
            <thead>
               <tr class="bg-primary">
                  <th>No</th>
                  <th>Date Apply</th>
                  <th>Total Day</th>
                  <th>Month & Year</th>
                  <th>Instructed By</th>
                  <th>Location</th>
                  <th>Status</th>
                  <th class="actions text-right">Actions</th>
               </tr>
            </thead>            
         </table>




      </div>




   </div>
</div>



@stop

