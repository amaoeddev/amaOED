@extends('app')

@section('content')
<div class="container">
    <div class="col-md-6 col-sm-12">
<table class="table table-striped">
<tr><td>USN</td><td>{{$studentinfos->studentid}}</td></tr>
<tr><td>Student Name</td><td>{{$studentinfos->lname}}, {{$studentinfos->fname}} {{$studentinfos->mname}}</td></tr>
<tr><td>Course</td><td>{{$interests->programcode}}</td></tr>
<tr><td>Term</td><td></td></tr>
<tr><td>Payment Mode</td><td>Full</td></tr>
@foreach($paynamics as $key=>$paynamic)
<tr><td>Payment Type</td><td>{{$paynamic->ptype}}</td></tr>
<tr><td>Payment Date</td><td>{{$paynamic->timestamp}}</td></tr>
@endforeach
@if(!is_null($othercollection))
<tr><td>Other Fees</td><td>{{$othercollection->amount}}</td></tr>
@endif
<tr> <td colspan="2"> Subjects</td></tr>
<tr><td>Subject Name</td><td>Amount</td></tr>
<?php $total=0;?>
@foreach($subjects as $subject)
<tr><td>{{$subject->coursename}}</td><td align="right">{{$subject->amount}}</td></tr>
<?php $total = $total+$subject->amount;?>
@endforeach
<tr><td>Total</td><td align="right"><?= number_format($total,2);?>
</table>
        </div>


 <div class="col-md-6 col-sm-12">

	<h5>Student Grades</h5>
        @if(count($grades)>0)
	
        <table class="table table-striped"><tr><td>Subjects</td><td>Grades</td>
        @if(count($grades)>0)
                @foreach($grades as $grade)
                <tr><td>{{$grade->Course}}</td><td>{{round($grade->finalgrade,2)}}</td>
                @endforeach
                @else
        <tr><td colspan="2">No subject enrolled for this student yet!!</td></tr>
        @endif           
        </table>     
        @endif
    </div>



</div>


@stop


