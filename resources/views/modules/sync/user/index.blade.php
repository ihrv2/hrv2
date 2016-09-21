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
                        {{ Form::select('group_id', array(3 => 'Site Supervisor', 4 => 'Region Manager', 2 => 'Human Resource'), 1, array('class' => 'form-control', 'id' => 'group_id', 'style' => '')) }}
                        </div>
                    </div> 
                    <br>


                    <div id="div_date">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group date" id="pick_start_date">
                                    {{ Form::text('date_from', $prev_week, array('class' => 'form-control', 'data-date-format' => 'DD-MM-YYYY', 'id' => 'date_from')) }}
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                            </div>
                        </div> 
                        <br>
                    </div>

 
                    {{ Form::button('Syncronize', array('class' => 'btn btn-primary', 'type' => 'button', 'id' => 'sync')) }}
                    <br>*The process is taken from the selected date to the current date.
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

        // hide date if not site suprvisor
        $('#group_id').change(function() {
            if ($('#group_id').val() != 3) {
                $("#div_date").removeAttr("style").hide();
            }
            else {
                $("#div_date").removeAttr("style").show();                
            }
        });

        // synchronize
        $('#sync').click(function(){
            var answer = confirm('Are you sure want to synchronize the staff record?');
            if (answer == true) {     
                var str = '';
                str += '<div class="alert alert-warning alert-dismissable">';
                str += '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                str += '    Sync is in progress... Please wait...';
                str += '</div>';
                $('#alert').html(str);
                $.ajax({
                    url: $('#base_url').val() + '/hr/mod/sync/user',
                    type: 'POST',
                    data: {_token: $('#token').attr('alt'), date_from: $('#date_from').val(), group_id: $('#group_id').val()},
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


<script type="text/javascript">
$(function () {
    $('#pick_start_date').datetimepicker({
        pickTime: false
    });               
});
</script>


@stop