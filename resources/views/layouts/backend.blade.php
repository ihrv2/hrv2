<!DOCTYPE html>
<html lang="en">




<head>
    @include('includes/head')
</head>




<body>





    <div class="clearfix"> 
        <nav class="sidebar-nav">
           <div class="profile-side">
              <div class="details clear">
                 <span class="images">
                    <img src="{{ asset('/assets/images/profile.png') }}">
                 </span>
                 <span class="name">{{ Auth::user()->name }}</span>
              </div>
              <div class="details">
                 Position: {{ \App\Helpers\UserHelper::PositionName(Auth::user()->group_id) }}

                 <!-- site supervisor -->
                 @if (Auth::user()->group_id == 3)
                    <br>Sitecode: {{ Auth::user()->sitecode }}
                    <br>Reporting Officer: 
                 
                 <!-- regional manager -->
                 @elseif (Auth::user()->group_id == 4)
                    <br>Region: {{ Helper::RegionName(Session::get('user_job')['region_id']) }}
                 @endif


              </div>
           </div>

           <!-- menu home -->
           <ul class="metismenu" id="menu2">

              <li class="">
                 <a href="#" aria-expanded="false"><i class="icon-screen-desktop"></i> Home Page <span class="glyphicon arrow"></span></a>
                 <ul aria-expanded="false" class="collapse" style="height: 0px;">
                    <li><a href="{{ URL::route('home') }}">Home</a></li>                 
                 </ul>
              </li>


                @if (Auth::user()->is_admin == true) <!-- administrator -->
                    @include('sidebar/admin') 
                @else
                    @if (Auth::user()->group_id == 2) <!-- human resource -->
                        @include('sidebar/hr')  
                    @elseif (Auth::user()->group_id == 3) <!-- site supervisor -->
                        @include('sidebar/sv')          
                    @elseif (Auth::user()->group_id == 4) <!-- regional manager -->
                        @include('sidebar/rm')          
                    @else
                        @include('sidebar/unknown')
                    @endif
                @endif


            </ul>
        </nav>
    </div>




    @include('includes/navigation')




    <section class="dashboard-content">
        <div class="container-fluid">




            <div class="page-header full-block">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Welcome</h3>
                    </div>
                </div>
            </div>




            @include('includes/breadcrumb')




            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('label') }} alert-dismissable" id="flashMessage">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ Session::get('message') }}
                </div>
            @endif  

            


            @yield('content')




            <div class="row">
                @include('includes/footer')
            </div>




        </div>
    </section>




    @include('includes/script')




</body>
</html>


