@extends('layouts/backend')

@section('content')



<script type="text/javascript">
$(document).ready(function(){

	$('#detail a').click(function (e) {
		e.preventDefault();
	  
		var url = $(this).attr("data-url");
	  	var href = this.hash;
	  	var pane = $(this);
		
		// ajax load from data-url
		$(href).load(url,function(result){      
		    pane.tab('show');
		});
	});

	// load first tab content
	$('#personal').load($('.active a').attr("data-url"),function(result){
	  $('.active a').tab('show');
	});

})


</script>




<div class="row">
	<div class="col-sm-12">
		<div class="well">




			<div class="panel-body">

				<!-- Nav tabs -->
				<ul class="nav nav-tabs" id="detail">
					<li class="active"><a data-url="{{ route('mod.user.view.personal') }}" href="#personal">Personal</a></li>
					<li class=""><a data-url="{{ route('mod.user.view.job', array($detail->id)) }}" href="#job">Jobs</a></li>
					<li class=""><a data-url="" href="#contract">Contract</a></li>					          
				</ul>



				<div class="tab-content">
					<div class="tab-pane active" id="personal"></div>
					<div class="tab-pane" id="job"></div>
					<div class="tab-pane" id="contract"></div>
				</div>

			</div>                 



		</div>
	</div>
</div>







@stop