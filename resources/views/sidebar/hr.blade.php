      <li class="">
         <a href="#" aria-expanded="false"><i class="icon-people"></i> Staff Administration <span class="glyphicon arrow "></span></a>
         <ul aria-expanded="false" class="collapse" style="height: 0px;">  
            <li><a href="{{ URL::route('hr.mod.user.select.group') }}">Add Staff</a></li>                          
            <li><a href="{{ URL::route('hr.mod.user.index') }}">All Staff</a></li>
         </ul>
      </li>


      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-grid"></i> Leave Application  <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li><a href="{{ URL::route('hr.mod.region') }}">Region / Reporting Officer</a></li>   
            <li><a href="{{ URL::route('hr.mod.public.holiday') }}">Public Holiday</a></li>            
         </ul>
      </li>  


      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-settings"></i> Maintenance <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="#" aria-expanded="false"> Synchronize »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ URL::route('hr.mod.sync.user') }}">Staff</a></li>
                  <li><a href="{{ URL::route('hr.mod.sync.public.holiday') }}">Public Holiday</a></li>
               </ul>
            </li>
         </ul>
      </li> 
