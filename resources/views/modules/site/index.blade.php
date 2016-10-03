@extends('layouts/backend')

@section('content')



<div class="row">
   <div class="col-md-12">
      <div class="well">
         {{ Form::open(array('class' => 'form-inline', 'id' => 'form-search')) }}             
         <div class="row">
            <div class="col-md-4">                                                                                               
               <div class="input text">
                  {{ Form::text('search', $sessions['search'], array('class'=>'form-control', 'placeholder' => 'Search Code/Address', 'size' => 40)) }}
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



      {{ Form::open(array('class' => 'form-horizontal')) }}
      <div class="well">
         <table class="table table-striped table-condensed table-responsive table-hover">
            <thead>
               <tr class="bg-default">
                  <th>No</th>
                  <th>Code</th>
                  <th>Address</th>
                  <th>Region</th>                  
                  <th>State</th>                  
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
                     <td>{{ $no }}</td>
                     <td>{{ $i->code }}</td>
                     <td>{{ $i->address }}</td>
                     <td>{{ ($i->RegionName) ? $i->RegionName->name : '-' }}</td>
                     <td>{{ ($i->StateName) ? $i->StateName->name : '-' }}</td>
                     <td class="text-right"><a href="{{ route('mod.site.edit', array($i->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;{{ Form::button('<i class="icon-trash"></i>',['type' => 'submit', 'class' => 'btn btn-primary btn-sm', 'title' => 'Delete', 'id' => 'btn_id', 'alt' => $i->id]) }}</td>
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
      {{ Form::hidden('site_id', null, array('id' => 'site_id')) }}
      {{ Form::close() }}




   </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

   $(document).on('click','#btn_id',function() {
      var answer = confirm('Do you want to delete this record?');
      if (answer == true) {
         $('#site_id').val($(this).attr('alt'));
      }
      else {
         return false;
      } 
   });

});
</script>


@stop