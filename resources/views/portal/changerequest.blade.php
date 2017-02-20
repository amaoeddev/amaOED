@extends('app')
@section('content')
<div class="col-md-3 col-sm-12">
</div>
<div class="col-md-6 col-sm-12">
    <table class="table table-striped">
    <tr><td>Student ID</td><td>{{$name->studentid}}</td></tr>    
    <tr><td>Student Name</td><td>{{$name->lname}}, {{$name->fname}}</td></tr>
    <tr><td>Email Address</td><td>{{$name->email}}</td></tr>    
    </table>
    <div class='list-group'>
        <div class="list-group-item-danger" style="font-size: 14pt"><STRONG>Current Course</strong></div>
        <h3>{{$currentprogram->programcode}} - {{$currentprogram->programname}}</h3>
        <div class="list-group-item-info" style="font-size: 14pt"><strong>Change To :</stront> </div>
        <br />
        {!!Form::open(array('url'=>url('changecourse')))!!}
        <input type="hidden" name="userid" value="{{$userid}}">
        <input type="hidden" name="oldprogramcode" value="{{$currentprogram->programcode}}">
        <input type="hidden" name="oldprogramname" value="{{$currentprogram->programname}}">
     
        <div class="form-group">
        <select name="changeto" class = "form-control">
            @foreach($programoffers as $programoffer)
            @if($programoffer->programcode == $currentprogram->programcode)
            @else
            <option value="{{$programoffer->programcode}}">{{$programoffer->programname}}</option>
            @endif
            
            @endforeach
        </select>
        </div> 
        <div class="form-group">
        <div class="form-control">
        <input type="submit" class="btn btn-danger" value ="Change Course">
        </div>
	</div>
        {!!Form::close()!!}
    </div>    
</div>    
<div class="col-md-3 col-sm-12">
</div>
@stop

