@extends('layouts/backend')


@section('content')






<table class="table table-condensed table-bordered">
   <tr class="bg-primary">
      <td colspan="3">Staff Info</td>
   </tr>
   <tr>
      <td>NAME: <strong>{{ Auth::user()->name }}</strong></td>
      <td>SITE: <strong>-</strong></td>
      <td>WORK DURATION: <strong>-</strong></td>
   </tr>
   <tr>
      <td>POSITION: 
      </td>      
      <td>CONTRACT FROM: <strong>-</strong></td>
      <td>CONTRACT TO: <strong>-</strong></td>
   </tr>   
</table>




<table class="table table-condensed table-bordered">
   <tr class="bg-primary">
   <td>LEAVE TYPE</td>
   <td align="center">ENTITLED GIVEN</td>
   <td align="center">ADDITIONAL LEAVE (+)</td>
   <td align="center">REIMBURSE LEAVE (-)</td>
   <td align="center">LEAVE TAKEN</td>
   <td align="center">BALANCE</td>      
</tr>
</table>








<table class="table table-condensed table-bordered">

   <tr class="bg-primary">
      <td>Info</td>
   </tr> 


   <tr>
      <td>-
      </td>
   </tr>  
</table>







@stop