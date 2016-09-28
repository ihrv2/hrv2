@extends('layouts/backend')

@section('content')




<div class="row">
   <div class="col-sm-12">


      <div class="well">
         <table class="table table-striped table-condensed table-responsive table-hover">
            <thead>
               <tr class="bg-default">
                  <th>No</th>
                  <th>Code /<br>Name</th>
                  <th>Phase /<br>Mukim</th>
                  <th>District /<br>State</th>
                  <th>Region</th>                  
                  <th class="actions text-right">Actions</th>
               </tr>
            </thead>
            @if (count($sites) > 0)
               <?php $no = $sites->firstItem() - 1;?>
               @foreach ($sites as $i)
                  <?php 
                     $no++;                       
                  ?>
                  <tr>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                     <td>0</td>
                  </tr>
               @endforeach
            @else
               <tr><td colspan="6">No record</td></tr>
            @endif
         </table>

         <div class="paging text-center">  
            {{ $sites->render() }}      
            <br>
            <p>{{ 'Total: '.$sites->total() }}</p>
         </div>




      </div>

   </div>
</div>

@stop