@extends('layouts/backend')

@section('content')




<div class="row">
   <div class="col-md-12">
      <div class="well">

         {{ Form::open(array('class' => 'form-inline', 'id' => 'form-search')) }}             
         <div class="row">
            <div class="col-md-4">                                                                                               
               <div class="input select">
                  {{ Form::selectYear('year', '2010', date('Y') + 3, $sessions['year'], ['class' => 'form-control']) }}
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
                  <th>No</th>
                  <th>Date</th>
                  <th>Description</th>
                  <th>Applicable To</th>
               </tr>
            </thead>




            @if (count($leave_public) > 0)
               <?php $no = 0; ?>
               @foreach ($leave_public as $i)
                  <?php 
                  $no++; 
                  ?>
                  <tr>
                     <td>{{ $no }}</td>
                     <td>{{ $i->date}}</td>
                     <td>{{ $i->desc }}</td>                     
                     <td align="left">
                        @if (count($i->LeavePublicState) > 0)
                           @foreach ($i->LeavePublicState as $s)
                              @if ($s->state_id == 0)
                                 {{ 'All' }}
                              @else
                                 {{ $s->StateName->name }}<br>
                              @endif
                           @endforeach
                        @endif
                     </td>
                  </tr>
               @endforeach
            @else
               <tr><td colspan="4">No record</td></tr>
            @endif




         </table>
      </div>

   </div>
</div>







@stop