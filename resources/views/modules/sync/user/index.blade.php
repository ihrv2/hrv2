@extends('layouts/backend')

@section('content')


<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
<link href="{{ asset('/assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet">


<div id="alert"></div>



{{ Form::open(array('class' => 'form-horizontal', 'id' => 'form-search')) }}  
<div class="row">
    <div class="col-lg-12">



            
        <div class="panel panel-default">
            <div class="panel-body">


                <div class="form-group">
                    @if ($errors->has('group_id'))
                        <p class="col-lg-12 text-danger">{{ $errors->first('group_id') }}</p>
                    @endif                      
                    <div class="required"> 
                        <label class="col-lg-2 control-label" for="textArea">User Group</label>
                    </div>
                    <div class="col-lg-3">
                        {{ Form::select('group_id', $groups, 3, array('class' => 'form-control', 'id' => 'group_id', 'style' => '')) }}
                    </div>
                </div>


                @if (!empty($prev_week))
                <div class="form-group">
                    @if ($errors->has('date_from'))
                        <p class="col-lg-12 text-danger">{{ $errors->first('date_from') }}</p>
                    @endif                      
                    <div class="required"> 
                        <label class="col-lg-2 control-label" for="textArea">Start Date</label>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group date" id="pick_start_date">
                            {{ Form::text('date_from', $prev_week, array('class' => 'form-control', 'data-date-format' => 'DD-MM-YYYY', 'id' => 'date_from')) }}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>
                @endif


                <div class="form-group">
                    @if ($errors->has('date_to'))
                        <p class="col-lg-12 text-danger">{{ $errors->first('date_to') }}</p>
                    @endif                      
                    <div class="required"> 
                        <label class="col-lg-2 control-label" for="textArea">End Date</label>
                    </div>
                    <div class="col-lg-3">
                        <div class="input-group date" id="pick_end_date">
                            {{ Form::text('date_to', date('d-m-Y'), array('class' => 'form-control', 'data-date-format' => 'DD-MM-YYYY', 'id' => 'date_to')) }}
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
                    </div>
                </div>

                <br><strong>Remarks: </strong>                   
                <br>1) Please select short duration for site supervisor.

            </div>

            <div class="panel-footer">  
                <div class="row">
                    <div class="col-md-12"> 
                        {{ Form::button('Syncronize', array('class' => 'btn btn-primary', 'type' => 'button', 'id' => 'sync')) }}
                    </div>
                </div>
            </div>            

        </div>
    </div>            
</div>


<div id="token" alt="{{ csrf_token() }}"></div>   
{{ Form::hidden('base_url', URL::to('/'), array('id' => 'base_url')) }}
{{ Form::close() }}





<script type="text/javascript">
    $(document).ready(function(){

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
                    url: $('#base_url').val() + '/mod/sync/user',
                    type: 'POST',
                    data: {_token: $('#token').attr('alt'), date_from: $('#date_from').val(), date_to: $('#date_to').val(), group_id: $('#group_id').val()},
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
    $('#pick_end_date').datetimepicker({
        pickTime: false
    });             
});
</script>


@stop