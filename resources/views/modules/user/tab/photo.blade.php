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


<script type="text/javascript">
$(document).ready(function(){

	$(document).on('click','#photo-edit',function() {  
		var id = $(this).attr('alt');		
		str =  '';   		
		str += '<div class="modal-dialog">';
		str += '	<div class="modal-content">';
		str += '		<div class="modal-header">';
		str += '			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
		str += '			<h4 class="modal-title">Select Photo</h4>';
		str += '		</div>';
		str += '		<div class="modal-body">';
		str += '			<div class="error-message" id="error"></div>';		
		str += '			<p><input type="file" name="photo" id="photo" /><input type="hidden" name="id" value="' + id + '" /></p>';
		str += '		</div>';
		str += '		<div class="modal-footer">';
		str += '			<div class="btn-group">';
		str += '				<button type="button" class="btn btn-success" id="photo-upload"><i class="icon-cloud-upload"></i>&nbsp;Upload</button>';
		str += '				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>';
		str += '			</div>';
		str += '		</div>';
		str += '	</div>';
		str += '</div>';
		$('#upload-modal').html(str);                                                    
		$('#upload-modal').modal();   
	}); 


	$(document).on('click','#photo-upload',function() {  
		var formData = new FormData($("#form-upload")[0]);
		var photo = $('#photo').val();
		$.ajax({                
			url: $('#base_url').val() + '/mod/user/photo/upload',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function(response, status, jqXHR){	 
				if (response['msg']['status'] == 0) {
					$('#error').html(response['msg']['error']);					
				}
				else {
					var path = $('#base_url').val() + '/assets/images/user/';
					var photo = response['msg']['photo'];										
					var photo_thumb = response['msg']['photo_thumb'];
					$('.d_photo').attr('alt', 1);
					$('.d_photo').html('<a href="' + path + photo + '" target="_blank"><img src="' + path + 'thumb/' + photo_thumb + '" class="img-thumbnail img-responsive" /></a>');
					$('#photo-remove').removeAttr('disabled');
					$('#upload-modal').modal('hide');
				}					          				
			},
			error: function(e){
				console.log(e);
			}                                                    
		});         
	});



});
</script>