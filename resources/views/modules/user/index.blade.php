@extends('layouts/backend')

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="well">




         {{ Form::open(array('class' => 'form-inline', 'id' => 'form-search')) }}  
         <div class="row">
            <div class="col-md-6">
               <div class="input select">
                  {{ Form::select('group_id', $groups, $sessions['group_id'], array('class' => 'form-control', 'id' => '')) }}
               </div> 
               <br>
               <div class="input text">
                  {{ Form::text('text-search', null, array('class'=>'form-control', 'placeholder' => 'Search Name/IC No/Username', 'size' => 40)) }}
               </div>
               <br>
               <input type="submit" value="Search" class="btn btn-warning" name="btn-search" />
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
               <tr class="bg-default">
                  <th>No<br>&nbsp;</th>
                  <th>Name /<br>NRIC No.</th>
                  <th>Staff ID /<br>Sitecode</th>
                  <th>Group /<br>Position</th>
                  <th>Join Date /<br>Status</th>
                  <th class="actions text-right">Actions</th>
               </tr>
            </thead>

            @if (count($users) > 0)
               <?php $no = 0; ?>
               @foreach ($users as $i)
                  <?php 
                     $no++;                       
                  ?>
                  <tr>
                     <td>{{ $no }}</td>
                     <td>{{ $i->name }} /<br>{{ $i->icno }}</td>
                     <td>{{ $i->username }} /<br>{{ $i->sitecode }}
                     </td>
                     <td>{{ $i->GroupName->name }} /<br>{{ $i->UserLatestJob->PositionName->name }}
                     </td>
                     <td>{{ $i->UserLatestJob->join_date }} /<br>{{ $i->StatusName->name }}
                     </td>
                     <td class="text-right"><a href="" alt="" class="btn btn-primary btn-sm" title="Details"><i class="icon-magnifier"></i></a>&nbsp;<a href="" class="btn btn-primary btn-sm" title="Change Password"><i class="icon-lock"></i></a></td>
                  </tr>
               @endforeach
            @else
               <tr><td colspan="6">No record</td></tr>
            @endif

         </table>






      </div>

   </div>
</div>





@stop


