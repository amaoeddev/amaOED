@extends('app')

@section('content')
<script>
    $(document).ready(function () {
        $("#courselist").fadeIn();
        $("#paymentstatus").hide();


        $("#coursebtnlist").click(function () {
            $("#courselist").fadeIn();
            $("#paymentstatus").hide();
        });

        $("#paymentbtnstatus").click(function () {
            $("#courselist").hide();
            $("#paymentstatus").fadeIn();
        });


        $("#studentbtnlist").click(function () {
            document.location = "/evaluation"
        });


    });

</script>

<div class="container">
    <div class='row'>
        <div class="col-md-3 col-sm-12">

            <div class="list-group">
                <div class="list-group-item active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Dashboard</b></div>
                <div class = "list-group-item" id="studentbtnlist">
                    <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Student Directory</a>
                </div>
                <div class = "list-group-item" id="coursebtnlist">
                    <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Course List</a>
                </div>

                <div class = "list-group-item" id="paymentbtnstatus">
                    <a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Payment Status</a>
                </div>



            </div>


        </div>
        <div class="col-md-6 col-sm-12">
            <div id='topinfo'>
                <div class="list-group-item active" style="background-color: maroon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Student Information</b></div>
                <table class="table table-striped">
                    <tr><td>Student ID</td><td></td></tr>
                    <tr><td>Student Name</td><td>{{ $user->fname }} {{ $user->lname }}</td></tr>
                    @if(count($interest) > 0)
                    <tr><td>Program</td><td>{{$interest->programcode}}</td></tr>
                    <tr><td>Program Description</td><td><span>{{$interest->programname}}</span></td></tr>
                    <tr><td>Status</td><td>
                            @if($interest->status =='0')
                            For evaluation
                            @else
                            Evaluated
                            @endif
                        </td></tr>
                    @endif
                    <tr><td>Registered on</td><td>{{ $user->created_at }}</td></tr>

                </table>

            </div>
            <hr /> 
            <div id="courselist">
                @if(count($degrees)>0)
                {!!Form::open(array('url'=>url('view')))!!}
                <input type="hidden" name ="userid" value="{{$user->id}}">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr><th>Course Name</th><th>Level</th><th>term</th><th>Action</th></tr></thead>
                    <tbody>
                        @foreach($degrees as $degree)
                        <tr><td>{{$degree->subjectname}}</td><td>{{$degree->level}} </td><td>{{$degree->term}}</td><td>


                                <input name ="refid[]" type="hidden" value="{{$degree->id}}">

                                @if($degree->status =='2')
                                Enrolled
                                @elseif($degree->status=='1')
                                Pending for enrollment 
                                @elseif($degree->status=='5') 
                                Pending for payment 
                                @else

                                <select name="status[]">



                                    <option value="0"
                                            @if($degree->status == '0')
                                            selected="selected"
                                            @endif
                                            >Not Yet Taken</option>


                                    <option value="5"
                                            @if($degree->status == '5')
                                            selected="selected"
                                            @endif
                                            >Approve For Payment</option>


                                    <option value="3"
                                            @if($degree->status == '3')
                                            selected="selected"
                                            @endif
                                            >Credited</option>



                                </select>    
                                @endif
                            </td></tr>          
                        @endforeach
                    </tbody>
                </table>
                <input type="submit" name ="submit" value ="Update!!" class="form-control btn-primary">
                {!!Form::close()!!}
                @endif

            </div>
            <div id="paymentstatus">
                <h3>Payment Status</h3>
                <table class="table table-striped table-bordered">
                    <thead><tr><th>Date</th><th>Particulars</th><th>Amount</th><th>Code</th><th>Remarks</th></tr></thead>
                    <tbody>
                        @if(count($payments)>0)    
                        @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->created_at}}</td>
                            <td>{{$payment->coursename}}</td>
                            <td>{{$payment->amount}}</td>
                            <td>{{$payment->status}}</td>
                            <td>{{$payment->paymentmessage}}</td>
                        </tr>   
                        @endforeach
                        @else
                        <tr><td colspan="5">No Payment History Yet!!</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>    

        </div>

        <div class="col-md-3 col-sm-12">
            <div id="requirements">
                <div style="padding: 10px; background-color: #ddd;margin-bottom:20px;">
                    <div class="btn btn-danger form-control"><strong>REQUIREMENT SUBMITTED</strong></div>
                    <table class="table table-bordered"><thead><tr><th>Document</th><th>Status</th></tr>
                        </thead>
                        <tbody>
                            <tr><td>TOR</td><td>
                                    @if(count($studentrequirements)>0)
                                    @if($studentrequirements->tor=="")
                                    Not Submitted
                                    @else
                                    <a href = "{{url('images/catalog',$studentrequirements->tor)}}">View</a>
                                    @endif
                                    @else
                                    Not Submitted
                                    @endif
                                </td></tr>   
                            <tr><td>Diploma</td><td>
                                    @if(count($studentrequirements)>0)
                                    @if($studentrequirements->diploma =="")
                                    Not Submitted
                                    @else
                                    <a href = "{{url('images/catalog',$studentrequirements->diploma)}}">View</a>
                                    @endif
                                    @else
                                    Not Submitted
                                    @endif
                                </td></tr>  
                            <tr><td>Form 137</td><td>
                                    @if(count($studentrequirements)>0)
                                    @if($studentrequirements->form137=="")
                                    Not Submitted
                                    @else
                                    <a href = "{{url('images/catalog',$studentrequirements->form137)}}">View</a>
                                    @endif
                                    @else
                                    Not Submitted
                                    @endif
                                </td></tr> 
                            <tr><td>Birth Cert</td><td>
                                    @if(count($studentrequirements)>0)
                                    @if($studentrequirements->birthcertificate=="")
                                    Not Submitted
                                    @else
                                    <a href = "{{url('images/catalog',$studentrequirements->birthcertificate)}}">View</a>
                                    @endif
                                    @else
                                    Not Submitted
                                    @endif
                                </td></tr>  
                        </tbody>
                    </table>
                </div>
            </div>  
        </div>
    </div>
</div>
@stop

