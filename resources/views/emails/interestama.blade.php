@if($hasRequirements=='0')
<p>Please be informed that <b>{{$lastname}}, {{$firstname}} </b> with email addresss {{$studentemail}} 
has submitted his/her interest in {{$course}}. </p>
<p><b>Status :</b> No requirements submitted</p>
<p><b>Reminder : </b> Credentials for follow-up.</p>
@else
Please be informed that <b>{{$lastname}}, {{$firstname}} </b> with email addresss {{$studentemail}} 
has submitted his/her interest in {{$course}} and requirements for evaluation
@endif
