<!-- skill -->
<div class="tab-pane" id="skill">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Skills</h4>
				</div>	

				<div class="panel-body nopadding">
					<table class="table table-striped table-condensed table-responsive table-hover">
						<thead>
							<tr class="active">
								<th>No</th>
								<th>Name</th>
								<th>Level</th>
								<th class="actions text-right">Actions</th>
							</tr>
						</thead>
						@if (count($detail) > 0)
						<?php $no = 0; ?>											
						@foreach ($detail as $skill)
						<?php $no++; ?>												
						<tr>
							<td>{{ $no }}</td>
							<td>{{ $skill->name }}</td>
							<td>{{ $skill->SkillLevel->name }}</td>	              
							<td class="text-right"><a href="{{ route('mod.user.skill.edit', array($skill->id, $user['id'], $user['token'])) }}" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
						</tr>
						@endforeach
						@else
						<tr><td colspan="4">No record</td></tr>
						@endif
					</table>	

					<div class="row">
						<div class="col-sm-12">
							<a href="{{ route('mod.user.skill.create', array($user['id'], $user['token'])) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>
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


