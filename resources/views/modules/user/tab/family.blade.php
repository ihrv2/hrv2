<!-- family -->
<div class="tab-pane" id="family">

	<div class="row">
		<div class="col-md-12">

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Family</h4>
				</div>	

				<div class="panel-body nopadding">
					<table class="table table-striped table-condensed table-responsive table-hover">
						<thead>
							<tr class="active">
								<th>No</th>
								<th>Name</th>
								<th>Age</th>
								<th>Occupation</th>
								<th>School/Office</th>
								<th>Relation</th>
								<th class="actions text-right">Actions</th>
							</tr>
						</thead>
						@if (count($detail) > 0)
							<?php $no = 0; ?>											
							@foreach ($detail as $family)
							<?php $no++; ?>												
							<tr>
								<td>{{ $no }}</td>
								<td>{{ $family->name }}</td>
								<td>{{ $family->age }}</td>
								<td>{{ $family->occupation }}</td>
								<td>{{ $family->school_office }}</td>
								<td>{{ $family->relation }}</td>
								<td class="text-right"><a href="" class="btn btn-primary btn-sm" title="Edit"><i class="icon-note"></i></a>&nbsp;<a href="" class="btn btn-primary btn-sm" title="Delete"><i class="icon-trash"></i></a></td>
							</tr>

							@endforeach
						@else
							<tr><td colspan="7">No record</td></tr>
						@endif

					</table>	

					<div class="row">
						<div class="col-sm-12">
							<a href="{{ route('mod.user.family.create', array($user['id'], $user['token'])) }}" class="btn btn-success" title="Add"><i class="icon-plus"></i>&nbsp;Add</a>		
						</div>
					</div>																										             
				</div>

			</div>
		</div>
	</div>
</div>