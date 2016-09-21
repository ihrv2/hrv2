@extends('layout/backend')

@section('content')





<div class="row">
	<div class="col-lg-12">



    	{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form', 'files' => true)) }}
		<div class="panel panel-default">
			<div class="panel-body">
				<fieldset>
					<legend>Attachment</legend>
					<div class="form-group" id="i2">
						<div class="col-lg-4">
							<label>
								{{ Form::file('leave_file') }}
							</label>
						</div>
					</div>
				</fieldset>
			</div>
			<div class="panel-footer">          		
				{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-primary']) }} 
			</div>
		</div>



		{{ Form::close() }} 

 
	</div>
</div>





@stop


