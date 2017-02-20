@extends('app')

@section('content')
<div class="container">
   
   
    <h5> Degree Courses Enrollment Report</h5>   
<table class ="table table-striped"><thead><tr><th>Name</th><th>USN</th><th>Enrollment Date</th><th>Course</th><th>No. of Subjects</th>
        <th>Payment Mode</th><th>Payment Type</th><th>Other Fee</th><th>Course Fee</th></tr></thead><tbody>
  <?php $total=0; $totalof=0; ?>      
@foreach($enrollments as $enrollment)
<tr><td><a href ="individual/userid/{{$enrollment['id']}}/requestid/{{$enrollment['paymentrequestid']}}">{{$enrollment['lname']}}, {{$enrollment['fname']}} {{$enrollment['mname']}}</a></td>
    <td>{{$enrollment['studentid']}}</td><td>{{$enrollment['enrolldate']}}</td>
    <td>{{$enrollment['programcode']}}</td><td align="center">{{$enrollment['count']}}</td><td>Full</td><td>{{$enrollment['ptype']}}</td><td align="right">{{$enrollment['otherfee']}}</td>
    <td align="right">{{$enrollment['amount']}}</td></tr>
<?php $total = $total+$enrollment['amount']; $totalof=$totalof+$enrollment['otherfee'];?>
@endforeach
<tr><td colspan="7" align="center">Total</td><td align="right"><b><?=  number_format($totalof,2,'.','')?></b></td>
<td align="right"><b><?=  number_format($total,2,'.','')?></b></td></tr>
</tbody></table>
 @if(Auth::user()->accesslevel < 2)   
    <div class="col-md-12 col-sm-12">
         {!! Form::open(array('url'=>url('enrollment'))) !!}
            <input type="hidden" name="datefrom" value="{{$datefrom}}">
            <input type="hidden" name="dateto" value="{{$dateto}}">
            <input type="hidden" name="whattype" value="export">
            <input type="submit" value="Export to CSV" class="btn btn-warning form-control">
        {!! Form::close() !!}
      
</div>
 
 @endif
    </div>

@stop

