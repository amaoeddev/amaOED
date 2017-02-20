@extends('app')

@section('content')

<script type="text/javascript" src="script/select_jquery.js"></script>
<script>
$(document).ready(function(){
 @if($amount > 0 )
     $("#shortcoursepayment").fadeIn();
 @else
     $("#shortcoursepayment").hide();
 @endif
 
 @if($amount1 > 0)
     $('#degreepayment').fadeIn();
 @else
     $('#degreepayment').hide();
 @endif
 
  $("#courseoffered").hide();
  $("#courseincart").hide();
  
  @if(count($myinterest)=='0')
  $("#requesttoenroll").fadeIn();
  $("#degreeoffered").hide();
  $("#courseincartdegree").hide()
  
 @else
  $("#requesttoenroll").hide(); 
  $("#courseincartdegree").hide();
    @if($myinterest->status == '0');
      $("#forevaluation").fadeIn();
       $("#degreeoffered").hide();
    @else
    $("#forevaluation").hide();    
    $("#degreeoffered").fadeIn();
    $("#courseincartdegree").fadeIn();
    @endif
    
  @endif
  
  //$("#courseincartdegree").fadeIn();
  $("#coursestatus").hide();
  $("#requirements").hide();
  $("#coursemessage").hide();
  $("#shortcourses").hide();
  $("#viewgrade").hide();
 
  $("#coursebtnoffered").click(function(){
   $("#viewgrade").hide();
   $("#coursemessage").hide();
   $("#forevaluation").hide();
   $("#degreeoffered").hide();
   $("#courseincart").hide();
   $("#requesttoenroll").hide();
   $("#courseincartdegree").hide();
   $("#coursestatus").hide();
   $("#requirements").hide();
   $("#courseoffered").fadeIn();
  });
  
  $("#coursebtnoffered1").click(function(){
   $("#viewgrade").hide();
   $("#coursemessage").hide();
   $("#forevaluation").hide();
   $("#degreeoffered").hide();
   $("#courseincart").hide();
   $("#requesttoenroll").hide();
   $("#courseincartdegree").hide();
   $("#coursestatus").hide();
   $("#requirements").hide();
   $("#courseoffered").fadeIn();
   $("shortcourses").fadeIn();
  });


  $("#coursebtnstatus").click(function(){
  $("#viewgrade").hide();  
  $("#coursemessage").hide();
  $("#forevaluation").hide();
  $("#degreeoffered").hide();
  $("#courseincart").hide();
  $("#requesttoenroll").hide();
  $("#courseincartdegree").hide();
  $("#courseoffered").hide();
$("#requirements").hide();
  $("#coursestatus").fadeIn();
  });
  
  $("#coursebtnincart").click(function(){ 
  $("#viewgrade").hide();  
  $("#coursemessage").hide();
  $("#forevaluation").hide();
  $("#courseincartdegree").hide();
  $("#coursestatus").hide();
  $("#requesttoenroll").hide();
  $("#degreeoffered").hide();
  $("#courseoffered").hide();
  $("#requirements").hide();
  $("#courseincart").fadeIn();
  });
  
  $("#coursebtnincartdegree").click(function(){
  $("#viewgrade").hide();
  $("#coursemessage").hide();
  $("#forevaluation").hide();
  $("#coursestatus").hide();
  $("#degreeoffered").hide();
  $("#courseoffered").hide();
  $("#requesttoenroll").hide();
  $("#requirements").hide();
  $("#courseincart").hide();
  $("#courseincartdegree").fadeIn();
  });

$("#coursebtnrequirement").click(function(){
  $("#viewgrade").hide();
  $("#coursemessage").hide();
  $("#coursestatus").hide();
  $("#forevaluation").hide();
  $("#courseoffered").hide();
  $("#courseincart").hide();
  $("#requesttoenroll").hide();
  $("#degreeoffered").hide();
  $("#courseincartdegree").hide();
  $("#requirements").fadeIn();
  });

$("#degreebtnoffered").click(function(){
  $("#viewgrade").hide();
  $("#coursemessage").hide();
  $("#coursestatus").hide();
  $("#forevaluation").hide();
  $("#courseoffered").hide();
  $("#requesttoenroll").hide();
  $("#courseincart").hide();
  $("#courseincartdegree").fadeIn();
  $("#requirements").hide();
  $("#degreeoffered").fadeIn();
  });
  
  $("#requestbtntoenroll").click(function(){
  $("#viewgrade").hide();
  $("#coursemessage").hide();
  $("#coursestatus").hide();
  $("#courseoffered").hide();
  $("#forevaluation").hide();
  $("#courseincart").hide();
  $("#courseincartdegree").hide();
  $("#requirements").hide();
  $("#degreeoffered").hide();
  $("#requesttoenroll").fadeIn();
  });
  
  $("#forbtnevaluation").click(function(){
  $("#coursemessage").hide();
  $("#coursestatus").hide();
  $("#courseoffered").hide();
  $("#forevaluation").fadeIn();
  $("#courseincart").hide();
  $("#courseincartdegree").hide();
  $("#requirements").hide();
  $("#degreeoffered").hide();
  $("#requesttoenroll").hide();
  });

	 $("#viewbtngrades").click(function(){
  $("#viewgrade").fadeIn();    
  $("#coursemessage").hide();
  $("#coursestatus").hide();
  $("#courseoffered").hide();
  $("#forevaluation").hide();
  $("#courseincart").hide();
  $("#courseincartdegree").hide();
  $("#requirements").hide();
  $("#degreeoffered").hide();
  $("#requesttoenroll").hide();
  });

    });
 
</script>


<div class="container">
    <div class="row">
<div class="col-md-3 col-sm-12">
     
<div class="panel panel-default">
 <div class="panel-body">   
	<div class ="list-group">

        <div class="list-group-item active"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><b> Profile</b></div>    
	<div class = "list-group-item" id="profile">
        <a href="#"><span class="glyphicon glyphicon-book" aria-hidden="true"></span> Personal Information</a>
	</div>
        @if (Auth::user()->studentid!=null)
        <div class = "list-group-item">
        <a href='/subjWGrade/{{Auth::user()->id}}'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> View Grade Slip</a>
        </div>
        <div class = "list-group-item">
        <a href='/coenrollment/{{Auth::user()->id}}'><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> View Certificate of Enrollment</a>
        </div>
        @else
        @endif
        </div>
	
	<div class="list-group">
	<div class="list-group-item active"><span class="glyphicon glyphicon-certificate" aria-hidden="true"></span> <b>Academic Program</b></div>    
        
        
        @if(count($myinterest) > 0)
        @if($myinterest->status == '0')
        <div class = "list-group-item" id="forbtnevaluation">   
        <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Your Chosen Degree For Evaluation</a>
        </div>
        @else
        <div class = "list-group-item" id="coursebtnrequirement">   
        <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Curriculum Structure</a>
        </div>
        <div class = "list-group-item" id="degreebtnoffered">
            <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Approved courses to be taken</a>

        </div>

	 <div class = "list-group-item" id="viewbtngrades">
            <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> View Grades</a>

        </div>

        @endif
        @else
            <div class = "list-group-item" id="requestbtntoenroll">
                <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Enrollment Procedure To Bachelor&CloseCurlyQuote;s Degree</a>
            </div>
        @endif
          
            
        
      
        

         
	</div>

   
    <div id = "shortcourses">
    <div class="list-group">
        <div class="list-group-item active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Short Courses</b></div>
   <div class = "list-group-item" id="coursebtnstatus">
        <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Your Enrolled Short Courses</a>
        </div>
        
<div class = "list-group-item" id="coursebtnoffered">
        <a href="#"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Short Course Offerings</a>
        </div>


        
        </div>
</div>
</div>
</div>
     </div>    

    
    
<div class="col-md-6 col-sm-12">
    <div id='topinfo'>
      <div class="list-group-item active" style="background-color: maroon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Student Information</b></div>
    <table class="table table-striped">
        <tr><td>Student ID</td><td><span style="color: red;font-weight: bold">{{Auth::user()->studentid}}</span></td></tr>
        <tr><td>Student Name</td><td>{{ Auth::user()->fname }} {{ Auth::user()->lname }}</td></tr>
        @if(count($myselecteddegree) > 0)
        <tr><td>Program</td><td>{{$myselecteddegree[0]['programcode']}}</td></tr>
        <tr><td>Program Description</td><td><span>{{$myselecteddegree[0]['programname']}}</span></td></tr>
        @endif
        <tr><td>Registered on</td><td>{{ Auth::user()->created_at }}</td></tr>
                <tr><td>Status</td><td>
            @if(Auth::user()->status == 0)
            Registered
            @elseif(Auth::user()->status == 1)
            Enlisted
            @elseif(Auth::user()->status == 2)
            Enrolled
            @endif
                        
            </td></tr>
    </table>
        
    </div>
<hr />    
    
<div id="forevaluation">
    @if(count($myinterest)>0)
    <p>Thank you {{ Auth::user()->fname}}, for considering <b>AMA Online University</b>. 
        You already sent us your interest in {{$myinterest->programcode}} - {{$myinterest->programname}}. We will notify
    you as soon as we evaluate your status for a proper enrollment procedure of your chosen field.</p>
    @endif
</div>   
    
<div id="requesttoenroll">
    <p> Thank you for registering at <strong>AMA Online University</strong>. In order for us to evaluate your credentials, 
        please follow the steps below: </p>
        <h4><b>Step 1</b>  Choose the academic program you wish to enroll</h4>
        
        @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
	@endif
        
        
    {!! Form::open(array('url'=>url('interest'),'files'=>'true')) !!}
    <div class="form-group">
        <select name="degree" class="form-control">
    @foreach($degreeOfferings as $degreeOffering)
    <option value="{{$degreeOffering->programcode}}">{{$degreeOffering->programname}}</option>
    @endforeach
</select>
       </div>
    <hr />
    <h4><b>Step 2 </b> <br>For Transferee, TESDA graduate, Course shifter, Second Courser</h4>
    <p>Upload scanned copy of Transcript of record (TOR)</p>
    <div class="form-group">
        <input id="tor"  type="file" name="tor" class="file" >
    </div>
    <h4>For High School Graduate</h4>
    <p>Upload scanned copy of High School Diploma, Form 137 and Birth Certificate</p>
    <div class="form-group">
    <label for="diploma">High School Diploma</label>
    <input type="file" name="diploma" id ="diploma">
    </div>
    <div class="form-group">
    <label for="form137">Form 137</label><input type="file" name="form137" id="form137">
    </div>
    <div class="form-group">
        <label for="birthcertificate">Birth Certificate</label><input type="file" name="birthcertificate" id ="birthcertificate">
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" value="Submit For Evaluation" class="form-control btn btn-primary">
        </div>
<script>
/* Initialize your widget via javascript as follows */

$("#tor").fileinput({
	previewFileType: "image",
	browseClass: "btn btn-success",
	browseLabel: "Pick Image",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
	removeClass: "btn btn-danger",
	removeLabel: "Delete",
	removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
	uploadClass: "btn btn-info",
	uploadLabel: "Upload",
	uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
        showUpload: false,
       
});
$("#diploma").fileinput({
	previewFileType: "image",
	browseClass: "btn btn-success",
	browseLabel: "Pick Image",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
	removeClass: "btn btn-danger",
	removeLabel: "Delete",
	removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
	uploadClass: "btn btn-info",
	uploadLabel: "Upload",
	uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
        showUpload: false,
});
$("#form137").fileinput({
	previewFileType: "image",
	browseClass: "btn btn-success",
	browseLabel: "Pick Image",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
	removeClass: "btn btn-danger",
	removeLabel: "Delete",
	removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
	uploadClass: "btn btn-info",
	uploadLabel: "Upload",
	uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
        showUpload: false,
});
$("#birthcertificate").fileinput({
	previewFileType: "image",
	browseClass: "btn btn-success",
	browseLabel: "Pick Image",
	browseIcon: '<i class="glyphicon glyphicon-picture"></i>',
	removeClass: "btn btn-danger",
	removeLabel: "Delete",
	removeIcon: '<i class="glyphicon glyphicon-trash"></i>',
	uploadClass: "btn btn-info",
	uploadLabel: "Upload",
	uploadIcon: '<i class="glyphicon glyphicon-upload"></i>',
        showUpload: false,
});
</script>
    {!! Form::close()!!}

</div>    

   
<div id="coursemessage">
</div>
 
@if(count($mydegreepayment) > 0)
<div id="degreeoffered">

<?php $totalunits=0; ?>
<div class="list-group-item active" style="background-color: maroon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Add Course</b></div>
<table class="table table-bordered">
{!! Form::open() !!}
<thead>
    <tr><th><b>Course</b></th><th><b>Course Description</b></th><th><b>Units</b></th></tr>
</thead>
<tbody>
<?php $sel='0'; ?>
@foreach($mydegreepayment as $selecteddegree)
@if($selecteddegree->status == "1")
<tr><td>
<?php $totalunits = $totalunits + $selecteddegree->unit; ?>        
<input name="courses[]" checked="checked"  type="checkbox" value = "{{$selecteddegree->subjectcode }}"> {{$selecteddegree->subjectcode}}</td><td>{{$selecteddegree->subjectname}}</td>
<td>{{$selecteddegree->unit}}</td></tr>
    <?php $sel='1'; ?>
@endif
@endforeach
<tr>
<td colspan="3">
<input type="hidden" value="{{ $requestid }}" name ="requestid">
<input type="hidden" value="1" name="coursetype">
@if($sel=='1')
<input type="submit" value="Click me to add course" class="btn btn-primary form-control">
@else
<p>You have no subject/s to enroll as of the moment. You may request additional subjects from us.</p>
@endif

</td></tr>
{!! Form::close() !!}

</tbody>
</table>
    </div>
    @endif
 <div id="courseoffered">
<h1>Choose course to enroll</h1>
{!! Form::open() !!}
@foreach($courseofferings as $courseoffered)
<input name="courses[]" type="checkbox" value = "{{$courseoffered->id }}"> {{$courseoffered->coursename}} <br />
@endforeach
<input type="hidden" value="0" name="coursetype">
<input type="hidden" value="{{ $requestid }}" name ="requestid">
<input type="submit" value="Enroll Now" class="btn btn-primary form-control">
{!! Form::close() !!}
    </div>
    
<div id="requirements">
@if(count($myselecteddegree) > 0)
    <h3> Program : {{$myselecteddegree[0]['programcode']}}</h3>
    <h5>{{$myselecteddegree[0]['programname']}}</h5>
    <table class="table table-striped"><thead><tr><th>Course Name</th><th>Remarks</th></tr></thead>
    <tbody>
 @foreach($myselecteddegree as $selecteddegree)
         <tr><td>{{$selecteddegree->subjectname}}</td> <td>
     @if($selecteddegree->status == '0')
     Not Taken Yet
     @elseif($selecteddegree->status=='1')
     Approved
     @elseif($selecteddegree->status=='2')
     <span style="color:red">Enrolled</span>
     @elseif($selecteddegree->status=='3')
     <span style="font-weight: bold;color:blue">Credited</span>
     @elseif($selecteddegree->status=='4')
     <span style="font-weight: bold;color:blue">Payment Failed</span>
     @elseif($selecteddegree->status=='5')
     For Payment
     @elseif($selecteddegree->status == '6')
     Passed
     @elseif($selecteddegree->status == '7')
     Not Required
     @endif
                 
     </td></tr>
 @endforeach

 </table>
 @endif
</div>



    <div id="courseincart">
    <h1> My Short Courses on Cart</h1>
    <table class="table table-striped"><thead><tr><td>Course Name</td><td>Action</td></tr></thead><tbody>
        @foreach($mycourses as $mycourse)
        <tr><td>{{$mycourse->coursename}}</td><td><a href="{{url('/book/delete',$mycourse->id)}}">Remove</a></td></tr>
        @endforeach
    </tbody></table>    
    <div class="form-group">
        {!! $md !!}
        </div>
    </div>
    
    <div id="courseincartdegree">
    <div class="list-group-item active" style="background-color: maroon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <b>Assessment</b></div>
    <table class="table table-striped"><thead><tr><td>Course Name</td><td>Unit</td><td>Amount</td><td>Action</td></tr></thead><tbody>
        @foreach($mydegree as $mycourse)
        <tr><td>{{$mycourse->coursename}}</td><td>{{$mycourse->unit}}</td><td align="right">{{$mycourse->amount}}</td><td><a href="{{url('/book/delete',$mycourse->id)}}">Remove</a></td></tr>
        @endforeach
        <tr><td colspan="2">Other Fees</td><td align="right">605.00</td><td></td></tr>
         <tr><td colspan="2">Total</td><td align="right"><b>{{$amount1}}.00</b></td><td></td></tr>
    </tbody></table>    
    <div class="form-group">
        {!! $md1 !!}
        </div>
    </div>
    
    <div id='coursestatus'>
    <h1>My Courses</h1>
    <table class="table table-striped"><thead><tr><td>Course Name</td><td>Status</td></tr></thead><tbody>
        @foreach($myallcourses as $myallcourse)
        <tr><td>{{$myallcourse->coursename}}</td><td>{{$myallcourse->paymentmessage}}</td></tr>
        @endforeach
    </tbody></table>    
    </div>
	<div id="viewgrade">
        <table class="table table-striped">
            <tr><td>Subjects</td><td>Grade</td></tr>
		@if(count($rows) > 0 )
			@foreach($rows as $row)
			</tr><td>{{$row->Course}}</td><td>{{$row->finalgrade}}</td></tr>
			@endforeach
		@else
		</tr><td colspan="2">You don't enroll any subjects yet</td></tr>
		@endif
        </table>    
    </div> 

</div>    
<div class="col-md-3 col-sm-12">

   
   <div id="degreepayment">      
 <div style="padding: 10px; background-color: #99CCFF;maargin-bottom:20px ">
        <div class="btn btn-danger form-control"><strong>COURSE FEES</strong></div>
        <h2 id="totalPaymet" style="color: maroon" class="pull-right">PHP {{ $amount1 }}.00</h2>
        <div class="clearfix"></div>
        <div class="form-group">
        
        </div>
         <a href="#" style="font-size: 10pt;" class="btn form-control" id="coursebtnincartdegree">View Payment Details</a>
    </div>
     </div>
    
   
    
    <div id="shortcoursepayment">
    <div style="padding: 10px; background-color: papayawhip;margin-bottom:20px;">
        <div class="btn btn-danger form-control"><strong>SHORT COURSES</strong></div>
        <h2 id="totalPaymet" style="color: maroon" class="pull-right">PHP {{ $amount }}.00</h2>
        <div class="clearfix"></div>
         <a href="#" style="font-size: 10pt;" class="btn form-control" id="coursebtnincart">View Payment Details</a>
       
    </div>
         </div>
         <div id="notification">
         <div style="padding: 10px; background-color: #ddd;margin-bottom:20px;">
        <div class="btn btn-danger form-control"><strong>NOTIFICATION</strong></div>
        @if(count($myinterest)>0)
        @if($myinterest == '0')
        <p style="font-size: 12pt">For academic degree, we will notify you via email within 48 hours for the results of  evaluation of your credentials.</p>
        @endif
        @else
        <p>Please send us your desired degree by completing the process on the center of the screen.</p>
        @endif
        
        <p style="font-size: 12pt"> You may also enroll to our short courses now. Please visit our offerings</p> 
        <div class="btn btn-primary form-control" id='coursebtnoffered1'> <b>here</b></div>
         </div>
        </div>
    @if(count($myrequirements)>0)
   <div id="requirements">
       <div style="padding: 10px; background-color: #ddd;margin-bottom:20px;">
           <div class="btn btn-danger form-control"><strong>REQUIREMENT SUBMITTED</strong></div>
           <table class="table table-bordered"><thead><tr><th>Document</th><th>Submitted</th></tr>
           </thead>
           <tbody>
               <tr><td>TOR</td><td>
                   @if($myrequirements->tor=="")
                   Not Submitted
                   @else
                   <a href = "{{url('images/catalog',$myrequirements->tor)}}">View</a>
                   @endif
                </td></tr>  
               <tr><td>Diploma</td><td>
                   @if($myrequirements->diploma=="")
                   Not Submitted
                   @else
                   <a href = "{{url('images/catalog',$myrequirements->diploma)}}">View</a>
                   @endif
                </td></tr> 
               <tr><td>Form 137</td><td>
                   @if($myrequirements->form137=="")
                   Not Submitted
                   @else
                   <a href = "{{url('images/catalog',$myrequirements->form137)}}">View</a>
                   @endif
                </td></tr> 
               <tr><td>Birth Cert</td><td>
                   @if($myrequirements->birthcertificate=="")
                   Not Submitted
                   @else
                   <a href = "{{url('images/catalog',$myrequirements->birthcertificate)}}">View</a>
                   @endif
                </td></tr> 
           </tbody>
           </table>
       </div>
   </div>    
    @endif
<div id="mentoring">
       <div style="padding: 10px; background-color: #ddd;margin-bottom:20px;">
        <div class="btn btn-danger form-control"><strong>SUBSCRIPTION</strong></div>
    <p> If you wish to subscribe for mentoring, please click the button bellow.</p>
    <div class="btn btn-primary form-control" id='coursebtnoffered1'> <b>SUBSCRIBE FOR MENTORING</b></div>
       </div>
         </div>   
</div>
 </div> 
    </div>
@stop
