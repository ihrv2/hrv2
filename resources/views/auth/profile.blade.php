@extends('layouts.backend')




@section('content')




<div class="panel panel-default">
	<div class="panel-heading">Profile</div>
	<div class="panel-body">

			<div class="row">
				<div class="col-md-6">	

					<div class="row">
						<div class="col-sm-12">
							<div class="d_photo" alt="0"><img src="{{ asset('assets/images/default.png') }}"></div>							
						</div>
					</div>
					<br>


	                <div class="row">
	                    <div class="col-sm-5">
	                        Full Name
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->name }}
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        IC No.
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->icno }}	                    
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Staff ID
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->username }}	                    
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Email
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->email }}

	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Tel No.
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->telno1 }}

	                    </div>
	                </div>
	                	
	                <div class="row">
	                    <div class="col-sm-5">
	                        Mobile No.
	                    </div>
	                    <div class="col-sm-7">
	                    	{{ \Auth::user()->hpno }}

	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Marital Status
	                    </div>
	                    <div class="col-sm-7">
	                    	@if ($marital)
	                    		{{ $marital->name }}
	                    	@else
	                    		{{ '-' }}
	                    	@endif
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Nationality
	                    </div>
	                    <div class="col-sm-7">
	                    	@if ($nationality)
	                    		{{ $nationality->eng }}
	                    	@else
	                    		{{ '-' }}
	                    	@endif
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Race
	                    </div>
	                    <div class="col-sm-7">	 
	                    	@if ($race)
	                    		{{ $race->eng }}
	                    	@else
	                    		{{ '-' }}
	                    	@endif
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-sm-5">
	                        Religion
	                    </div>
	                    <div class="col-sm-7">
	                    	@if ($religion)
	                    		{{ $religion->name }}
	                    	@else
	                    		{{ '-' }}
	                    	@endif
	                    </div>
	                </div>

				</div>
			</div>	
	</div>

   <div class="panel-footer" align="left">
      <a href="" class="btn btn-primary" title="Add">Edit Profile</a>
   </div>


</div>



@stop