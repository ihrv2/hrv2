@extends('layout/backend')

@section('content')




<div class="panel panel-primary">
	<div class="panel-heading">Jobs Info</div>
	<div class="panel-body">

			<div class="row">
				<div class="col-md-6">	

		                 
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">ID</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->id }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Join Date</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->date_reg }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Position</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->PositionName->name }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Department</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->DepartmentName->name }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Region</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->RegionName->name }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">State</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->StateName->name }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">District</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->DistrictName->name }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Site</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->SiteName->code.' - '.$detail->SiteName->address }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Staff No.</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->staffno }}
	                    </div>
	                </div>	                			                			                			                		             
				</div>
			</div>	
	</div>			
</div>



@stop