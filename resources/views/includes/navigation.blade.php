   <div class="header-top">
      <div class="pull-left">
         <h1 class="title">Integrated HR System V2</h1>
      </div>
      <div class="btn-group pull-right">
         <div class="btn-group">
            <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">Settings&nbsp;<span class="caret"></span></button>
            <ul class="dropdown-menu pull-right" role="menu">
               <li><a href="{{ URL::route('auth.profile') }}">View Profile</a></li>
               <li><a href="{{ URL::route('auth.password') }}">Change Password</a></li>
            </ul>
         </div>
         <a class="btn btn-danger" title="Logout" href="{{ url('/logout') }}"><i class="icon-power"></i></a>          
      </div>         
   </div>