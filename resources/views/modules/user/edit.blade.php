@extends('layout/backend')

@section('content')


<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">



<div class="panel panel-primary">
   <div class="panel-heading">Edit Personal</div>
   <div class="panel-body">



         {{ Form::open(array('class' => 'form-horizontal', 'role'=>'form')) }}
         <div class="row">             
            <div class="col-md-4"> 




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectName', 'Name') }}   
							@if ($errors->has('name'))
								<p class="text-danger">{{ $errors->first('name') }}</p>
							@endif   
							{{ Form::text('name', $detail->name, array('class'=>'form-control', 'id' => 'selectName', 'size' => 40)) }}                     
						</div>
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectGroup', 'Staff Level') }}   
							@if ($errors->has('group_id'))
								<p class="text-danger">{{ $errors->first('group_id') }}</p>
							@endif   
							{{ Form::select('group_id', $groups, $detail->group_id, array('class' => 'form-control', 'id' => 'selectGroup')) }}                      
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectAddress', 'Correspondence Address') }}   
							@if ($errors->has('address'))
								<p class="text-danger">{{ $errors->first('address') }}</p>
							@endif   
							{{ Form::textarea('address', $detail->address, ['class' => 'form-control', 'size' => '30x3', 'id' => 'selectAddress']) }}
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectAddress2', 'Permanent Address') }}   
							@if ($errors->has('address2'))
								<p class="text-danger">{{ $errors->first('address2') }}</p>
							@endif   
							{{ Form::textarea('address2', $detail->address2, ['class' => 'form-control', 'size' => '30x3', 'id' => 'selectAddress2']) }}

						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectTelno', 'Telephone No.') }}   
							@if ($errors->has('telno'))
								<p class="text-danger">{{ $errors->first('telno') }}</p>
							@endif   
							{{ Form::text('telno', $detail->telno, array('class'=>'form-control', 'id' => 'selectTelno', 'size' => 40)) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectHpno', 'Mobile No.') }}   
							@if ($errors->has('hpno'))
								<p class="text-danger">{{ $errors->first('hpno') }}</p>
							@endif   
							{{ Form::text('hpno', $detail->hpno, array('class'=>'form-control', 'id' => 'selectHpno', 'size' => 40)) }}                     
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectGender', 'Gender') }}   
							@if ($errors->has('gender_id'))
								<p class="text-danger">{{ $errors->first('gender_id') }}</p>
							@endif   
							{{ Form::select('gender_id', $genders, $detail->gender_id, array('class' => 'form-control', 'id' => 'selectGender')) }}                    
						</div>
					</div>
				</div>






				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectMarital', 'Marital Status') }}   
							@if ($errors->has('marital_id'))
								<p class="text-danger">{{ $errors->first('marital_id') }}</p>
							@endif   
							{{ Form::select('marital_id', $marital_status, $detail->marital_id, array('class' => 'form-control', 'id' => 'selectMarital')) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectHeight', 'Height') }}   
							@if ($errors->has('height'))
								<p class="text-danger">{{ $errors->first('height') }}</p>
							@endif   
							{{ Form::text('height', $detail->height, array('class'=>'form-control', 'id' => 'selectHeight', 'size' => 40)) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectWeight', 'Weight') }}   
							@if ($errors->has('weight'))
								<p class="text-danger">{{ $errors->first('weight') }}</p>
							@endif   
							{{ Form::text('weight', $detail->weight, array('class'=>'form-control', 'id' => 'selectWeight', 'size' => 40)) }}                     
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">     
							{{ Form::label('selectDOB', 'Date of Birth') }}
							<div class="input-group date" id="pick_dob_date">
								{{ Form::text('dob', date('d/m/Y', strtotime($detail->dob)), array('class' => 'form-control', 'data-date-format' => 'DD/MM/YYYY', 'id' => 'selectDOB')) }}
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
							</div>
						</div>
					</div>
				</div>



				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectPob', 'Place of Birth') }}   
							@if ($errors->has('pob'))
								<p class="text-danger">{{ $errors->first('pob') }}</p>
							@endif   
							{{ Form::text('pob', $detail->pob, array('class'=>'form-control', 'id' => 'selectPob', 'size' => 40)) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectNationality', 'Nationality') }}   
							@if ($errors->has('nationality_id'))
								<p class="text-danger">{{ $errors->first('nationality_id') }}</p>
							@endif   
							{{ Form::select('nationality_id', $nationalities, $detail->nationality_id, array('class' => 'form-control', 'id' => 'selectNationality')) }}                     
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectRace', 'Race') }}   
							@if ($errors->has('race_id'))
								<p class="text-danger">{{ $errors->first('race_id') }}</p>
							@endif   
							{{ Form::select('race_id', $races, $detail->race_id, array('class' => 'form-control', 'id' => 'selectRace')) }}                    
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectReligion', 'Religion') }}   
							@if ($errors->has('religion_id'))
								<p class="text-danger">{{ $errors->first('religion_id') }}</p>
							@endif   
							{{ Form::select('religion_id', $religions, $detail->religion_id, array('class' => 'form-control', 'id' => 'selectReligion')) }}                      
						</div>
					</div>
				</div>





				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectItaxNo', 'ITax No.') }}   
							@if ($errors->has('itaxno'))
								<p class="text-danger">{{ $errors->first('itaxno') }}</p>
							@endif   
							{{ Form::text('itaxno', $detail->itaxno, array('class'=>'form-control', 'id' => 'selectItaxNo', 'size' => 40)) }}                     
						</div>
					</div>
				</div>




				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectEpfNo', 'EPF No.') }}   
							@if ($errors->has('epfno'))
								<p class="text-danger">{{ $errors->first('epfno') }}</p>
							@endif   
							{{ Form::text('epfno', $detail->epfno, array('class'=>'form-control', 'id' => 'selectEpfNo', 'size' => 40)) }}                     
						</div>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectSocsoNo', 'Socso No.') }}   
							@if ($errors->has('socsono'))
								<p class="text-danger">{{ $errors->first('socsono') }}</p>
							@endif   
							{{ Form::text('socsono', $detail->socsono, array('class'=>'form-control', 'id' => 'selectSocsoNo', 'size' => 40)) }}                     
						</div>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectBankName', 'Bank Name') }}   
							@if ($errors->has('bankname'))
								<p class="text-danger">{{ $errors->first('bankname') }}</p>
							@endif   
							{{ Form::text('bankname', $detail->bankname, array('class'=>'form-control', 'id' => 'selectBankName', 'size' => 40)) }}                     
						</div>
					</div>
				</div>


				<div class="form-group">
					<div class="col-md-12"> 
						<div class="required">                 
							{{ Form::label('selectBankNo', 'Bank No.') }}   
							@if ($errors->has('bankno'))
								<p class="text-danger">{{ $errors->first('bankno') }}</p>
							@endif   
							{{ Form::text('bankno', $detail->bankno, array('class'=>'form-control', 'id' => 'selectBankNo', 'size' => 40)) }}                     
						</div>
					</div>
				</div>



               {{ Form::button('Save&nbsp;<i class="icon-arrow-right"></i>',['type' => 'submit', 'class' => 'btn btn-danger'])  }}       



            </div>               
         </div>   
          {{ Form::hidden('id', $detail->id) }}
         {{ Form::close() }}  




   </div>
      
</div>


<script type="text/javascript">
$(function () {
    $('#pick_join_date').datetimepicker({
        pickTime: false
    });     
    $('#pick_dob_date').datetimepicker({
        pickTime: false
    });        
});
</script>


@stop



