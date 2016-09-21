@extends('layouts/backend')

@section('content')


<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">


<div id="alert"></div>


<div class="row">
    <div class="col-md-12">
        <div class="well">




            {{ Form::open(array('class' => 'form-horizontal', 'id' => 'form-search')) }}  
            <div class="row">
                <div class="col-md-6"> 
                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::select('year', array_combine(range(2008, date('Y')), range(2008, date('Y'))), date('Y'), array('class' => 'form-control', 'id' => 'year')) }}
                        </div>
                    </div> 
                    <br> 
                    {{ Form::button('Syncronize', array('class' => 'btn btn-primary', 'type' => 'button', 'id' => 'sync')) }}
                </div>
            </div>
            <div id="token" alt="{{ csrf_token() }}"></div>   
            {{ Form::hidden('base_url', URL::to('/'), array('id' => 'base_url')) }}
            {{ Form::close() }}




        </div>
    </div>            
</div>






<script type="text/javascript">
    $(document).ready(function(){

        // synchronize
        $('#sync').click(function(){
            var answer = confirm('Are you sure want to synchronize the public holiday record?');
            if (answer == true) {     
                var str = '';
                str += '<div class="alert alert-warning alert-dismissable">';
                str += '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                str += '    Sync is in progress... Please wait...';
                str += '</div>';
                $('#alert').html(str); 
                $.ajax({
                    url: $('#base_url').val() + '/hr/mod/sync/public-holiday',
                    type: 'POST',
                    data: {_token: $('#token').attr('alt'), year: $('#year').val()},
                    complete: function(response, textStatus, jqXHR) {   
                    },
                    success: function(response, status, jqXHR){  
                        var str = '';
                        str += '<div class="alert alert-success alert-dismissable">';
                        str += '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                        str +=      response['message'];
                        str += '</div>';
                        $('#alert').html(str); 
                    },                       
                    error: function(e) {
                        console.log(e);
                    }
                });
            }
            else {
                return false;
            }
        });    

    });  
</script>



@stop


