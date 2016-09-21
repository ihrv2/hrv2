@extends('layouts/backend')

@section('content')




<div class="row">
   <div class="col-sm-12">


      <div class="well">
         <table class="table table-striped table-condensed table-responsive table-hover">
            <thead>
               <tr class="bg-default">
                  <th>No</th>
                  <th>Name</th>
                  <th>Reporting Officer</th>
                  <th class="actions text-right">Actions</th>
               </tr>
            </thead>

            @if (count($regions) > 0)
               <?php $no = 0; ?>
               @foreach ($regions as $i)
                  <?php 
                  $no++; 
                  ?>
                  <tr>
                     <td>{{ $no }}</td>
                     <td>{{ $i->name }}</td>
                     <td>
                        @if ($i->report_to != 0)
                           @if ($i->RegionManager)
                              {{ $i->RegionManager->name }}
                           @else
                              {{ '-' }}
                           @endif
                        @else
                           {{ '-' }}
                        @endif
                     </td>
                     <td class="text-right"><a href="{{ URL::route('hr.mod.region.edit', array($i->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a></td>
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