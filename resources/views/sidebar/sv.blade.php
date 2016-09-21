      <li class="">
         <a href="#" aria-expanded="true"><i class="icon-grid"></i> Leave Application <span class="glyphicon arrow"></span></a>
         <ul aria-expanded="true" class="collapse ">
            <li><a href="{{ URL::route('sv.mod.leave.summary') }}">Leave Info Summary</a></li>
            <li class="">
               <a href="#" aria-expanded="false"> Leave »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ URL::route('sv.mod.leave.select') }}">New Leave</a></li>
                  <li><a href="{{ URL::route('sv.mod.leave.index') }}">View Request Leave</a></li>
               </ul>
            </li>
            <li class="">
               <a href="#" aria-expanded="false"> Replacement Leave »</a>
               <ul aria-expanded="false" class="collapse" style="height: 0px;">
                  <li><a href="{{ URL::route('sv.mod.leave.replacement.create') }}">New Replacement Leave</a></li>
                  <li><a href="{{ URL::route('sv.mod.leave.replacement.index') }}">View Replacement Leave</a></li>
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
         </ul>
      </li>  

