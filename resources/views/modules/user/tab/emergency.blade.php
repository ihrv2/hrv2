<!-- emergency -->
<div class="tab-pane" id="emergency">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Emergency Contact</h4>
				</div>	

				<div class="panel-body nopadding">
					<table class="table table-striped table-condensed table-responsive table-hover">
						<thead>
							<tr class="active">
								<th>No</th>
								<th>Name</th>
								<th>Relationship</th>
								<th>Address</th>
								<th>Tel No.</th>
								<th class="actions text-right">Actions</th>
							</tr>
						</thead>
						@if (count($detail) > 0)
							<?php $no = 0; ?>												
							@foreach ($detail as $i)
							<?php $no++; ?>												
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $i->name }}</td>
								<td>{{ $i->relation }}</td>					           
								<td>{{ $i->address }}</td>			              
								<td>{{ $i->telno }}</td>	              
								<td class="text-right"><a href="{{ route('mod.user.emergency.edit', array($i->id, $user['id'], $user['token'])) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a class="btn btn-primary btn-sm" title="Delete" href=""><i class="icon-trash"></i></a></td>
							</tr>
							@endforeach
						@else
							<tr><td colspan="6">No record</td></tr>
						@endif
					</table>	

					<div class="row">
						<div class="col-sm-12">
							<a href="{{ route('mod.user.emergency.create', array($user['id'], $user['token'])) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
						</div>
					</div>																										             
				</div>

			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

   $(document).on('click','#btn_id',function() {
      var answer = confirm('Do you want to delete this record?');
      if (answer == true) {
         $('#f_id').val($(this).attr('alt'));
      }
      else {
         return false;
      } 
   });

});
</script>