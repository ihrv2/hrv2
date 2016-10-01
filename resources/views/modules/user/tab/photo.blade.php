<!-- photo -->
<div class="tab-pane" id="picture">

	<div class="row">
		<div class="col-md-12">


			{{ Form::open(array('id'=>'form-upload', 'role'=>'form', 'files' => true)) }}
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4 class="panel-title">Current Photo</h4>
				</div>	
				<div class="panel-body nopadding">
					<div class="form-group">
						<div class="d_photo" alt="0"><img src="{{ asset('assets/images/default.png') }}"></div>
					</div>
					<div class="form-group">
						<div class="btn-group">
							<button type="button" class="btn btn-primary" name="upload" title="Upload" id="photo-edit" alt=""><i class="icon-picture"></i>&nbsp;New</button>
							<button type="button" class="btn btn-danger" name="remove" title="Delete" id="photo-remove" alt=""><i class="icon-trash"></i>&nbsp;Delete</button>
						</div>	
					</div>
					<label>Upload Photo. Recommended size is 100kb and at minimum size. File format whether (jpg/jpeg/png/gif/bmp)</label>
				</div>          
			</div>
			<div class="modal fade" id="upload-modal"></div>
			{{ Form::close() }}	


		</div>
	</div>
</div>   