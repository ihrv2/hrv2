      <li class="">
         <a href="#" aria-expanded="false"><i class="icon-people"></i> Staff Administration <span class="glyphicon arrow "></span></a>
         <ul aria-expanded="false" class="collapse" style="height: 0px;">  
            <li><a href="{{ route('mod.user.group') }}">Add Staff</a></li>                          
            <li><a href="{{ route('mod.user.index') }}">All Staff</a></li>
         </ul>
      </li>



      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-settings"></i> Leave Application <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="#" aria-expanded="false"> Maintenance »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ route('mod.region.index') }}">Region / Reporting Officer</a></li>   
                  <li><a href="{{ route('mod.public.holiday') }}">Public Holiday</a></li> 
                  <li><a href="{{ route('mod.site.index')}}">Site</a></li> 
               </ul>
            </li>
         </ul>
      </li> 



      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-settings"></i> Maintenance <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="#" aria-expanded="false"> Synchronize »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ route('mod.sync.user') }}">Staff</a></li>
                  <li><a href="{{ route('mod.sync.public.holiday') }}">Public Holiday</a></li>
               </ul>
            </li>
         </ul>
      </li> 
