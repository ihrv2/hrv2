<?php
   if (empty($header)) {
      $header = array('parent' => 'Home', 'child' => false, 'icon' => 'home');
   }
?>


<div class="row">
   <div class="col-md-12">
      <div class="well">



         <div class="pageheader">
            <div class="media">

               <div class="pageicon pull-left">
                  <i class="icon-{{ $header['icon'] }}"></i>
               </div>

               <div class="media-body">
                  <ul class="breadcrumb">
                     <li title="Dashboard"><a href="#"><i class="icon-home" style="color: #000000 !important;"></i></a></li>
                     <li>{{ $header['parent'] }}</li>



                     @if ($header['child'] != false)
                        @if (isset($header['child-a']))
                           <li><a href="{{ $header['child-a'] }}">{{ $header['child'] }}</a></li>
                        @else
                           <li>{{ $header['child'] }}</li>
                        @endif
                     @endif


                     @if (isset($header['sub']))
                        @if (isset($header['sub-a']))
                           <li><a href="{{ $header['sub-a'] }}">{{ $header['sub'] }}</a></li>
                        @else
                           <li>{{ $header['sub'] }}</li>
                        @endif                    
                     @endif



                  </ul>

                  @if (isset($header['title']))
                     <h4>{{ $header['title'] }}</h4>
                  @else
                     <h4>{{ $header['parent'] }}</h4>                  
                  @endif
               </div>
            </div>
         </div>



      </div>
   </div>
</div>


