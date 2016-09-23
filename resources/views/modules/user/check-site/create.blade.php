@extends('layout/backend')

@section('content')




<div class="panel panel-primary">
	<div class="panel-heading">Add Check Site</div>
	<div class="panel-body">





		{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}
		<div class="row">             
			<div class="col-md-12">                 



				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
							{{ Form::label('selectState', 'State') }}   
							@if ($errors->has('state_id'))
								<p class="text-danger">{{ $errors->first('state_id') }}</p>
							@endif    
							{{ Form::select('state_id', $states, null, array('class' => 'form-control', 'id' => 'selectState')) }}                
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
							{{ Form::label('selectRegion', 'Region') }}   
							@if ($errors->has('region_id'))
								<p class="text-danger">{{ $errors->first('region_id') }}</p>
							@endif            
							{{ Form::select('region_id', $regions, null, array('class' => 'form-control', 'id' => 'selectRegion')) }}        
						</div>
					</div>
				</div>



				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
							{{ Form::label('selectDistrict', 'District') }}   
							@if ($errors->has('district_id'))
								<p class="text-danger">{{ $errors->first('district_id') }}</p>
							@endif         
							{{ Form::select('district_id', $districts, null, array('class' => 'form-control', 'id' => 'selectDistrict')) }}           
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-4">          
						<div class="required">        
							{{ Form::label('selectSite', 'Site') }}   
							@if ($errors->has('site_id'))
								<p class="text-danger">{{ $errors->first('site_id') }}</p>
							@endif          
							{{ Form::select('site_id', $sites, null, array('class' => 'form-control', 'id' => 'selectSite')) }}          
						</div>
					</div>
				</div>





			</div>               
		</div>   


		{{ Form::hidden('id', $id) }}
		{{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger']) }}         
		{{ Form::close() }}  


	</div>      
</div>




@stop