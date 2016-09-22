      <li class="">
         <a href="#" aria-expanded="false"><i class="icon-people"></i> Staff Administration <span class="glyphicon arrow "></span></a>
         <ul aria-expanded="false" class="collapse" style="height: 0px;">  
            <li><a href="{{ route('admin.mod.user.select.group') }}">Add Staff</a></li>                          
            <li><a href="{{ route('admin.mod.user.index') }}">All Staff</a></li>
         </ul>
      </li>


      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-grid"></i> Leave Application  <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="#" aria-expanded="false"> Staff Leave »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="#">All Leave Application</a></li>
                  <li><a href="#">New Leave Reimbursement/Deduction</a></li>
               </ul>
            </li>
            <li class="">
               <a href="#" aria-expanded="false"> Leave Maintenance »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="">Region / Reporting Officer</a></li>   
                  <li><a href="">Public Holiday</a></li> 
               </ul>
            </li>            
         </ul>
      </li>  


      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-list"></i> Attendance <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="">Daily Report</a>
            </li>
            <li class="">
               <a href="#" aria-expanded="false"> Archive »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="#">Search By Site</a></li>
                  <li><a href="#">Search By IC No.</a></li>
                  <li><a href="#">Daily Report Details</a></li>
                  <li><a href="#">Daily Report Problem</a></li>
                  <li><a href="#">Define Site Problem</a></li>
                  <li><a href="#">Checking From Database</a></li>
               </ul>
            </li>
            <li><a href="#">PO Attendance</a></li>
            <li><a href="#">Checking Site Code</a></li>
         </ul>
      </li>      

     <li class="">
         <a href="#" aria-expanded="true"><i class="icon-settings"></i> Maintenance <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li class="">
               <a href="#" aria-expanded="false"> Synchronize »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ route('admin.mod.sync.user') }}">Staff</a></li>
                  <li><a href="{{ route('admin.mod.sync.public.holiday') }}">Public Holiday</a></li>
               </ul>
            </li>
         </ul>
      </li> 