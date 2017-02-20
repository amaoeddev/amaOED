<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use DB;
use App\Course;
use App\Interest;
use App\otherCollection;

class AuditController extends Controller {

	//
    	public function __construct()
	{
		$this->middleware('auth');
	}
    
    public function index(){
        return view('portal.audit');
    }

    public function view($userid,$requestid){
        $studentinfos= User::where('id',$userid)->first();
        $paynamics = DB::Select("Select ptype, timestamp FROM paynamics WHERE request_id = '$requestid' and response_code='GR001'");
        $subjects = Course::where('paymentrequestid',$requestid)->get();
        $interests = Interest::where('user_id',$userid)->first();
        $othercollection=  otherCollection::where('requestid',$requestid)->first();
	$rows = $this->getgrade($userid);       
	$grades = $this->getgrade($studentinfos->email);	

        return view('portal.individual',compact('grades','rows','studentinfos','paynamics','subjects','interests','othercollection'));
    }
    
     public function enrollment(Request $request){
          $datefrom = $request->datefrom;
          $dateto = $request->dateto;
          $whattype = $request->whattype;
          $strQry = "SELECT users.id,users.lname, users.fname, users.mname, users.studentid, DATE_FORMAT(courses.updated_at,'%m-%d-%Y') as enrolldate,
                    interests.programcode, count(courses.coursename) as count , sum(courses.amount) as amount, courses.paymentrequestid FROM users, courses, interests 
                    WHERE users.id = courses.user_id AND users.id = interests.user_id AND (DATE_FORMAT(courses.updated_at,'%Y-%m-%d') between '". $datefrom."' AND '".$dateto."')
                    AND courses.status = 'GR001' GROUP BY users.lname, users.fname, users.lname, DATE_FORMAT(courses.updated_at,'%m-%d-%Y'), 
                    interests.programcode, courses.paymentrequestid ORDER BY courses.updated_at, users.lname, users.fname, users.mname";
          
          $array = DB::Select($strQry);


              foreach($array as $enroll){
              
                  
                  $enrollments[]=array("id" => $enroll->id,
                                 "lname"=>$enroll->lname,
                                 "fname"=>$enroll->fname,
                                 "mname"=>$enroll->mname,
                                 "studentid"=>$enroll->studentid,
                                 "enrolldate"=>$enroll->enrolldate,
                                 "programcode"=>$enroll->programcode,
                                 "count"=>$enroll->count,
                                 "amount"=>$enroll->amount,
                                 "paymentrequestid"=>$enroll->paymentrequestid,
                                 "otherfee"=>$this->fetchOtherFee($enroll->paymentrequestid),
                                 "ptype"=>$this->paymentType($enroll->paymentrequestid)
                      );
                  
              }
              




          if($whattype=="table"){
          return view('portal.auditenrollment',compact('enrollments','datefrom','dateto'));
          } else
          {
            
            $filename = "degree_".$datefrom."_".$dateto.".csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('Name', 'USN', 'Enrollment Date', 'Course', 'No. of Subjects', 'Payment Mode','Payment'));

            foreach($enrollments as $row) {
            fputcsv($handle, array($row->lname.", ".$row->fname. " ".$row->mname, $row->studentid, $row->enrolldate, $row->programcode, $row->count, "Full",$row->amount));
            }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, $filename, $headers);      
        
      }
      
            }
    
    
      public function shortcourseindividual($userid,$requestid){
        $studentinfos= User::where('id',$userid)->first();
        $paynamics = DB::Select("Select ptype, timestamp FROM paynamics WHERE request_id = '$requestid' and response_code='GR001'");
        $subjects = Course::where('paymentrequestid',$requestid)->get();
        //$interests = Interest::where('user_id',$userid)->first();
        $othercollection=  otherCollection::where('requestid',$requestid)->first();
       
        return view('portal.individualshortcourse',compact('studentinfos','paynamics','subjects','othercollection'));
    }
    
    
        public function shortcourse(Request $request){
          $datefrom = $request->datefrom;
          $dateto = $request->dateto;
          $whattype = $request->whattype;
          $strQry = "SELECT users.id, users.lname, users.fname, users.mname, users.studentid, DATE_FORMAT(courses.updated_at,'%m-%d-%Y') as enrolldate,
                    courses.coursename , courses.amount, courses.paymentrequestid FROM users, courses 
                    WHERE users.id = courses.user_id AND (DATE_FORMAT(courses.updated_at,'%Y-%m-%d') between '". $datefrom."' AND '".$dateto."')
                    AND courses.coursetype = '0' AND courses.status = 'GR001'  ORDER BY courses.updated_at, users.lname, users.fname, users.mname";
          
          $enrollments = DB::Select($strQry);
          if($whattype=="table"){
          return view('portal.auditshortcourse',compact('enrollments','datefrom','dateto'));
          } else
          {
            
            $filename = "shortcourse_".$datefrom."_".$dateto.".csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('Name', 'USN', 'Enrollment Date', 'Course', 'No. of Subjects', 'Payment Mode','Payment'));

            foreach($enrollments as $row) {
            fputcsv($handle, array($row->lname.", ".$row->fname. " ".$row->mname, $row->studentid, $row->enrolldate, $row->coursename, "1", "Full",$row->amount));
            }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, $filename, $headers);      
        
        }
          
          
        }
    


public function fetchOtherFee($requestid){
            $otherfee = \App\otherCollection::where("requestid",$requestid)->first();
            if(count($otherfee)==0){
                return 0;
                
            }
            else{
                return $otherfee->amount;
            }
        }
        
        public function paymentType($requestid){
                $ptype = \App\Paynamic::where('request_id',$requestid)->first();
         if(count($ptype)==0){
                return "";
                
            }
            else{
                return $ptype->ptype;
            }
                
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
		return $result;
		}
	



}

