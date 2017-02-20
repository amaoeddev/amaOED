<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Course;
use App\CourseOffering;
use Illuminate\Http\Request;
Use App\Pdetails;





class PortalController extends Controller {

    
    
    	public function __construct()
	{
		$this->middleware('auth');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $myid = \Auth::user()->id;    
        $mysession = \App\User::find($myid);
        $mysession->lastsessionid=  \Illuminate\Support\Facades\Session::getId();
        $mysession->update();
        $amount1='0';
        $amount = '0';  
	$myallcourses =\Auth::user()->courses()->where('coursetype', '0')->get();
        $myalldegree=\Auth::user()->courses()->where('coursetype', '1')->get();
        $courseofferings = CourseOffering::all();
        $myaccess=\Auth::user()->accesslevel;
        $mycourses = \Auth::user()->courses()->where('status','0')->where('coursetype','0')->get();
        $degreeOfferings = \Illuminate\Support\Facades\DB::table('degree_offerings')->select('programcode','programname')->distinct()->get();
        
	$username = \Auth::user()->email;
        $rows = $this->getgrade($username);
        
        if($mycourses->count()==0){
            $requestid =  substr(uniqid(), 0, 13);   
            $md="<div class='btn btnprimary'> No New Course Enrolled </div>";
        }else{
            $md=$this->merchantDetails($mycourses);
            $amount = $this->totalAmount($mycourses);
                foreach($mycourses as $course){}
            $requestid=$course->paymentrequestid;
            }
        
         $paiddegrees = \Auth::user()->degrees()->where('status','5')->get();
         $mydegree = \Auth::user()->courses()->where('status','0')->where('coursetype','1')->get();
         if($mydegree->count()==0){
             $requestid1 = substr(uniqid(), 0, 13);
             $md1="<div class='btn btnprimary'> No New Course Enrolled </div>";
         }else{
                $md1=$this->merchantDetails($mydegree);
                $amount1 = $this->totalAmount($mydegree);
                    foreach($mydegree as $degree){}
                    $requestid1 = $degree->paymentrequestid;
                    }
          
          $myselecteddegree = \Auth::user()->degrees()->get();
          $mydegreepayment = \Auth::user()->degrees()->where('status','1')->get();
          $myinterest=\Auth::user()->interests()->first();
          $myrequirements=\Auth::user()->requirements()->first();
        if($myaccess=="0"){
           return view('portal.index',compact('rows','mydegreepayment','paiddegrees','degreeOfferings','amount','amount1','courseofferings','md','md1','requestid','requestid1','mycourses','mydegree','myallcourses','myalldegree','myselecteddegree','myinterest','myrequirements'));
          }elseif($myaccess=="1"){
              
              return redirect(url('evaluation'));
          }
          elseif($myaccess=="2"){
              return redirect(url('audit'));
          }
}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
           $userid = \Auth::user()->id;
           $requestid = \Illuminate\Support\Facades\Input::get('requestid');
           $courses = \Illuminate\Support\Facades\Input::get('courses');
           $coursetype= \Illuminate\Support\Facades\Input::get('coursetype');
          
           foreach($courses as $course){
           if($coursetype=='0'){
              $newcoursename = CourseOffering::where('id','=',$course)->first()->coursename;
              $newamount = CourseOffering::where('id','=', $course)->first()->amount;
	      $newcourseid = CourseOffering::where('id','=',$course)->first()->courseid;
              $refid=$course;
            }  else {
              $degreeid = \Auth::user()->degrees()->where('subjectcode','=',$course)->first()->id;
              $newcoursename = \Auth::user()->degrees()->where('subjectcode','=',$course)->first()->subjectname;
              $newamount = \Auth::user()->degrees()->where('subjectcode','=', $course)->first()->amount;
	      $newcourseid = \Auth::user()->degrees()->where('subjectcode','=',$course)->first()->subjectcode; 
              $updatedegree = \App\Degree::find($degreeid); 
              $updatedegree->status = '5';
              $updatedegree->update();
              $refid=$degreeid;
               }
              $newcourse = new Course;
              $newcourse->user_id=$userid;
	      $newcourse->courseid=$newcourseid;
              $newcourse->paymentrequestid=$requestid;
              $newcourse->coursename=$newcoursename;
              $newcourse->amount=$newamount;
              $newcourse->status='0';
              $newcourse->refid=$refid;
              $newcourse->coursetype=$coursetype;
	      $newcourse->paymentmessage='For Payment';
              $newcourse->save();
           }
            return redirect(url('/'));
           
	}

        
        public function saverequest(){
          
            
        }
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
            $mycourse = Course::find($id);
            if($mycourse->coursetype=='1'){
                $refid = $mycourse->refid;
                $degree = \App\Degree::find($refid);
                $degree->status="1";
                $degree->update();
            }
            $mycourse->delete();
            
            return redirect(url('/'));
	}
        
       

        public function totalAmount($courses){
            $amount=0;
            foreach($courses as $course){
                          
                          if($course->status == 0){
                          $amount = $amount + $course->amount;
                          }
                          
                          }
                          $amount=$amount + 605;
            return $amount;
        }

        public function merchantDetails($courses){
		      $currentdegree=  \App\Degree::where('user_id',\Auth::user()->id)->first();
                      $amount=0;
                      $stritem="";
		      $_mlogo="http://portal.amauonline.com/images/AMAOnlineEduc.png";
                      foreach($courses as $course){
                          
                          if($course->status == 0){
                          $amount = $amount + $course->amount;
                          $stritem = $stritem . "<Items><itemname>".$course->coursename."</itemname><quantity>1</quantity><amount>".$course->amount."</amount></Items>"; 
                          }
                          
                          }
                          
                          $amount = $amount + 605;
                          $stritem = $stritem . "<Items><itemname>Other Fees</itemname><quantity>1</quantity><amount>605.00</amount></Items>";
                          
                      $merchantdetails = Pdetails::first();  
                      $_mid = $merchantdetails->merchantid;
		      $_requestid = $course->paymentrequestid;//substr(uniqid(), 0, 13);
		      $_ipaddress = $merchantdetails->merchantip;//$merchantdetails->merchantip;//$merchantdetails->ipaddress;
		      $_noturl = url('/') . "/paynamics.php";//$merchantdetails->responseposted; // url where response is posted
		      $_resurl = url('/');//$merchantdetails->responseurl; //url of merchant landing page
		      $_cancelurl = url('/');//$merchantdetails->cancelurl; //url of merchant landing page
		      $_fname = \Auth::user()->fname;
		      $_mname = \Auth::user()->mname;
		      $_lname = \Auth::user()->lname;
		      $_addr1 = \Auth::user()->addr1;
		      $_addr2 = \Auth::user()->addr2;
		      $_city = \Auth::user()->city;
		      $_state = \Auth::user()->state;
		      $_country = \Auth::user()->country;
		      $_zip = \Auth::user()->zip;
		      $_sec3d = $merchantdetails->merchantsec;
		      $_email = \Auth::user()->email;
		      $_phone = \Auth::user()->phone;
		      $_mobile = \Auth::user()->mobile;
		      $_clientip = $_SERVER['REMOTE_ADDR'];
		      $_amount = "$amount";
		      $_currency = "PHP";
                      
                       $forSign = $_mid . $_requestid . $_ipaddress . $_noturl . $_resurl . $_fname . $_lname . $_mname . $_addr1 . $_addr2 . $_city . $_state . $_country . $_zip . $_email . $_phone . $_clientip . number_format( ($amount), 2, '.' , $thousands_sep = '') . $_currency . $_sec3d;
		      
                       //$forSign = $_mid . $_requestid . $_ipaddress . $_noturl . $_resurl .  $_fname . $_lname . $_mname . $_addr1 . $_addr2 . $_city . $_state . $_country . $_zip . $_email . $_phone . $_clientip . $_amount . $_currency . $_sec3d;
		      $cert = $merchantdetails->merchantkey;	
		      $_sign = hash("sha512", $forSign.$cert);
		      $xmlstr = "";		
                      $strxml = "";
		      $strxml = $strxml . "<?xml version=\"1.0\" encoding=\"utf-8\" ?>";
		      $strxml = $strxml . "<Request>";
		      $strxml = $strxml . "<orders>";
		      $strxml = $strxml . "<items>";
                      if(isset($currentdegree->programname)){
			$strxml = $strxml . "<Items>";
                      $strxml = $strxml . "<itemname>Course: ".$currentdegree->programcode . " - " . $currentdegree->programname."</itemname><quantity>" . "1" . "</quantity><amount>0.00</amount>";
                      $strxml = $strxml . "</Items>";
                      } 

		     $strxml = $strxml. $stritem;
		     // $strxml = $strxml . "<Items>";
		     // $strxml = $strxml . "<itemname>item 1</itemname><quantity>1</quantity><amount>25.00</amount>";
		     // $strxml = $strxml . "</Item>
                      $strxml = $strxml . "</items>";
		      $strxml = $strxml . "</orders>";
		      $strxml = $strxml . "<mid>" . $_mid . "</mid>";
		      $strxml = $strxml . "<request_id>" . $_requestid . "</request_id>";
		      $strxml = $strxml . "<ip_address>" . $_ipaddress . "</ip_address>";
		      $strxml = $strxml . "<notification_url>" . $_noturl . "</notification_url>";
		      $strxml = $strxml . "<response_url>" . $_resurl . "</response_url>";
		      $strxml = $strxml . "<cancel_url>" . $_cancelurl . "</cancel_url>";
		      $strxml = $strxml . "<mtac_url>http://www.paynamics.com/index.html</mtac_url>";
		      $strxml = $strxml . "<descriptor_note>'My Descriptor .18008008008'</descriptor_note>";
		      $strxml = $strxml . "<fname>" . $_fname . "</fname>";
		      $strxml = $strxml . "<lname>" . $_lname . "</lname>";
		      $strxml = $strxml . "<mname>" . $_mname . "</mname>";
		      $strxml = $strxml . "<address1>" . $_addr1 . "</address1>";
		      $strxml = $strxml . "<address2>" . $_addr2 . "</address2>";
		      $strxml = $strxml . "<city>" . $_city . "</city>";
		      $strxml = $strxml . "<state>" . $_state . "</state>";
		      $strxml = $strxml . "<country>" . $_country . "</country>";
		      $strxml = $strxml . "<zip>" . $_zip . "</zip>";
		      $strxml = $strxml . "<secure3d>" . $_sec3d . "</secure3d>";
		      $strxml = $strxml . "<trxtype>sale</trxtype>";
		      $strxml = $strxml . "<email>" . $_email . "</email>";
		      $strxml = $strxml . "<phone>" . $_phone . "</phone>";
		      $strxml = $strxml . "<mobile>" . $_mobile . "</mobile>";
		      $strxml = $strxml . "<client_ip>" . $_clientip . "</client_ip>";
		      $strxml = $strxml . "<amount>" . $_amount . "</amount>";
		      $strxml = $strxml . "<currency>" . $_currency . "</currency>";
		      $strxml = $strxml . "<mlogo_url>". $_mlogo . "</mlogo_url>";
		      $strxml = $strxml . "<pmethod></pmethod>";
		      $strxml = $strxml . "<signature>" . $_sign . "</signature>";
		      $strxml = $strxml . "</Request>";
		      $b64string =  base64_encode($strxml);    
                      
                      $myStr = "<form name='form1' method='post' action='https://apps.paynamics.net/webpayment_V2/default.aspx'>
   				<input type='hidden' name='paymentrequest' id='paymentrequest' value='".$b64string."'>
							    <input type='submit' value='Go to payment' class='form-control btn btn-success'>
						</form>";

                      return  $myStr;
        }

 		public function getgrade($varusername){
           
            
            $sql = "SELECT u.firstname AS 'First Name', u.lastname AS 'Last Name', c.fullname AS 'Course', (
                    SELECT gh.finalgrade
                    FROM mdl_grade_grades gh
                    JOIN mdl_grade_items gih ON gih.id = gh.itemid
                    WHERE gih.itemtype = 'course'
                    AND u.id = gh.userid
                    AND gih.courseid = c.id
                    GROUP BY c.id
                    ) AS 'finalgrade'
                    FROM mdl_user u
                    JOIN mdl_user_enrolments ue ON ue.userid = u.id
                    JOIN mdl_enrol e ON e.id = ue.enrolid
                    JOIN mdl_course c ON c.id = e.courseid
                    WHERE u.username = '$varusername'";
            $result = \Illuminate\Support\Facades\DB::connection('lms_connection')->Select($sql);
            //$result="";
            return $result;
           
            }
        }
