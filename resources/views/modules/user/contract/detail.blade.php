@extends('layout/backend')

@section('content')




<div class="panel panel-primary">
	<div class="panel-heading">Contract</div>
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
	                        <div class="input-group">Start Date</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->date_from }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">End Date</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->date_to }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Salary</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->salary }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Total Leave</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->leave_val }}
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-sm-5">
	                        <div class="input-group">Status Contract</div>
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ $detail->ContractName->name }}
	                    </div>
	                </div>
	                			                			                			                		             
				</div>
			</div>	
	</div>			
</div>



@stop