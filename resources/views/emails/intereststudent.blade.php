<img  src = "{{ asset('/images/amaemail.jpg') }}" alt="ama logo">
<h1>{{$requirementHeader}}</h1>
<p style="font-size: 14pt;color: #bababa">{{$requirementMess}}</p>
<h4>Greetings! </h4>
@if($hasRequirements=='0')

<p>
   Thank you for letting us know your desired course however it has come to our attention that
   there were no attachment/s on your portal. <!--Please re-attach the documents through <a href='portal.amauonline.com'>portal.amauonline.com</a>.-->
   Please email your requirements to <a href="mailto:records@amauonline.com?view=cm&Subject=For Evaluation&body=Fill up the required fields below.%0A%0AName:%0A%0AContact No:%0A%0ACourse:%0A%0ALocation:%0A%0AGoogle Drive/Appbox/Dropbox Links:" style="font-size:14pt;font-weight:bold" target="_top">records@amauonline.com</a>
</p>
@else
<p>Thank you for sending us your credentials, our Academic Team is currently evaluating and validating your subjects for enrolment. 
    Please standby and we'll get back to you the soonest possible.
 </p>

 <p>
     <span style="font-size: 9pt">
         Your Registered Name : {{$lastname}}, {{$firstname}} <br> 
         Your Email Add : {{$studentemail}}<br>
         Your program of Interest : {{$course}} <br>
     </span>    
 </p>
 <p>
As of the moment, you may start exploring and 
familiarizing the portal through http://portal.amauonline.com/auth/login
 </p>
 @endif    
 <p>
     If you need further assistance, please don't hesitate to email us anytime or call us via  
+63 (02)-8637030.
 </p>
 
 <p>
     We are more than glad to have you on board!
 </p>
 
 <p>Thank you and have a happy schooling. </p>
 <p style="font-weight: bold;color: #C40D0D">AMA University Online Education Team<p>
<hr />

<h3><a href="http://www.amauonline.com">www.amauonline.com</a>   
<br>
<a href="www.facebook.com/amauonline">www.facebook.com/amauonline</a>
</h3>
<p>Mailing address: AMA University, 59 AMA Bldg. 2 Panay Ave., Quezon City, Metro Manila, 1100, Philippines </p>



