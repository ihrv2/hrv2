@extends('layouts.backend')




@section('content')




<div class="row">
    <div class="col-sm-4">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <h3 class="panel-title">ANNOUNCEMENT</h3>
            </div>
            <div class="panel-body">
                <p><strong>Calendar for Public Holiday</strong><br>
                    1) Perak / Selangor / N.Sembilan / Melaka / Pahang / Sarawak / Sabah (<a href="{{ asset('/assets/files/calendar-2016-part1.pdf') }}" target="_blank">Download Here</a>)<br>
                    2) Kedah / Johor / Kelantan / Terengganu (<a href="{{ asset('/assets/files/calendar-2016-part2.pdf') }}" target="_blank">Download Here</a>)</p>
                </div>
            </div>
        </div>





        <div class="col-sm-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">REPLACEMENT LEAVE  </h3>
                </div>
                <div class="panel-body">
                    -
                </div>
            </div>  
        </div>





        <div class="col-sm-4">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">LEAVE APPLICATION</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            -
                        </div>
                    </div>

                </div>
            </div>
        </div>






        @endsection
