@extends('app')

@section('content')

<div class="container">
  <div class="row"> 
      
      <div class="col-md-3">
        <div class="list-group" >
            <div class="list-group-item active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span></div>    
        <div class = "list-group-item" id="enrollmentbtnreport">
        <a href="{{url('audit')}}"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Back To Menu</a>
        </div>
        
        </div>  
      </div>    
      <div>   
 <div class="col-md-9">  


    <h5>Short Courses Enrollment Report</h5>
<table class ="table table-striped"><thead><tr><th>Name</th><th>USN</th><th>Enrollment Date</th><th>Course</th><th>No. of Subjects</th>
        <th>Payment Mode</th><th>Payment</th></tr></thead><tbody>
        <?php $total = 0;?>
@foreach($enrollments as $enrollment)
<tr><td><a href ="individualshortcourse/userid/{{$enrollment->id}}/requestid/{{$enrollment->paymentrequestid}}">{{$enrollment->lname}}, {{$enrollment->fname}} {{$enrollment->mname}}</a></td>
    <td>{{$enrollment->studentid}}</td><td>{{$enrollment->enrolldate}}</td>
    <td>{{$enrollment->coursename}}</td><td align="center">1</td><td>Full</td>
    <td align="right">{{$enrollment->amount}}</td></tr>
<?php $total = $total+$enrollment->amount;?>
@endforeach
<tr><td colspan="6" align="center">Total</td><td align="right"><b><?=  number_format($total,2,'.','')?></b></td></tr>

</tbody></table>
    @if(Auth::user()->accesslevel < 2)
    <div class="col-md-12 col-sm-12">
         {!! Form::open(array('url'=>url('shortcourse'))) !!}
            <input type="hidden" name="datefrom" value="{{$datefrom}}">
            <input type="hidden" name="dateto" value="{{$dateto}}">
            <input type="hidden" name="whattype" value="export">
            <input type="submit" value="Export to CSV" class="btn btn-warning form-control">
        {!! Form::close() !!}
    @endif  
</div>
    </div>
          </div>
@stop


