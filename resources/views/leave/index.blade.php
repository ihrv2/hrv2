@extends('layouts/backend')

@section('content')


<div class="row">
   <div class="col-md-12">
      <div class="well">




         {{ Form::open(array('class' => 'form-horizontal', 'id' => 'form-search')) }}  
         <div class="row">
            <div class="col-md-6">                              
               <div class="row">
                  <div class="col-md-6">{{ Form::select('year', array_combine(range(2008, date('Y')), range(2008, date('Y'))), $sessions['year'], array('class' => 'form-control')) }}</div>  
                  <div class="col-md-6">{{ Form::select('leave_status', $leave_status, $sessions['leave_status'], array('class' => 'form-control')) }}</div>
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
            @foreach ($types as $t)
               <thead>
                  <tr><td colspan="8" align="center"><h5>{{ $t->name }}</h5></td></tr>
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

               @if (count($leaves) > 0)
                  <?php 
                     $no = 0; 
                     $total = 0;
                  ?>    
                  @foreach ($leaves as $i)                     
                     @if ($i->leave_type_id == $t->id)
                        <?php 
                           $no++; 
                           $total = count($i->LeaveDate);
                           $avail = count($i->LeaveDateAll);
                        ?>
                        <tr>
                           <td>{{ $no }}</td>
                           <td class="text-center">{{ \Carbon\Carbon::parse($i->date_apply)->format('d/m/Y') }}</td>
                           <td class="text-center">{{ \Carbon\Carbon::parse($i->date_from)->format('d/m/Y') }}</td>
                           <td class="text-center">{{ \Carbon\Carbon::parse($i->date_to)->format('d/m/Y') }}</td>
                           <td class="text-center">{{ $avail }}</td>
                           <td class="text-center">{{ $total }}</td>
                           <td class="text-center">{{ $i->LeaveLatestHistory->LeaveStatusName->name }}</td>
                           <td class="text-center">{{ \Carbon\Carbon::parse($i->LeaveLatestHistory->action_date)->format('d/m/Y') }}</td>
                           <td class="text-right">
                              <a href="{{ route('sv.leave.view', array($i->id, Auth::user()->id, Auth::user()->api_token)) }}" class="btn btn-primary btn-sm" title="View Leave"><i class="icon-magnifier"></i></a>                              
                           </td>
                        </tr>
                     @endif
                  @endforeach
                  @if ($no > 0)
                     <!-- <tr><td colspan="8" class="text-left">Pending: <strong>0</strong> | Approved: <strong>0</strong> | Rejected: <strong>0</strong> | Cancel: <strong>0</strong></td></tr> -->
                  @else
                     <tr><td colspan="9">No record</td></tr>
                  @endif
               @else
                  <tr><td colspan="9">No record</td></tr>
               @endif
               <tr><td colspan="9">&nbsp;</td></tr>



            @endforeach



         </table>





      </div>



   </div>
</div>

@stop