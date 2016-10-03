<!-- education -->
<div class="tab-pane" id="education">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Education</h4>
				</div>	

				<div class="panel-body nopadding">
					<table class="table table-striped table-condensed table-responsive table-hover">
						<thead>
							<tr class="active">
								<th>No</th>
								<th>Year From</th>
								<th>Year To</th>
								<th>Institution</th>
								<th>Result</th>
								<th class="actions text-right">Actions</th>
							</tr>
						</thead>
						@if (count($detail) > 0)
							<?php $no = 0; ?>											
							@foreach ($detail as $education)
							<?php $no++; ?>												
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $education->year_from }}</td>
								<td>{{ $education->year_to }}</td>
								<td>{{ $education->name_education }}</td>
								<td>{{ $education->result }}</td>
								<td class="text-right"><a href="{{ route('mod.user.education.edit', array($education->id, $user['id'], $user['token'])) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
							</tr>
							@endforeach
						@else
							<tr><td colspan="6">No record</td></tr>
						@endif
					</table>	

					<div class="row">
						<div class="col-sm-12">
							<a href="{{ route('mod.user.education.create', array($user['id'], $user['token'])) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
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
         $('#e_id').val($(this).attr('alt'));
      }
      else {
         return false;
      } 
   });

});
</script>