<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use DB;
use Response;

class EvaluationController extends Controller {

      
    public function __construct()
	{
		$this->middleware('auth');
                
                }
	//
public function search(){
              
    $search = \Illuminate\Support\Facades\Input::get('search');
    $users = DB::Select("Select * from `users` where concat(studentid, fname, lname) like '%$search%' and accesslevel=0 order by created_at DESC  limit 0, 300");
    $accesslevel = \Auth::user()->accesslevel;
    
    if($accesslevel != '1'){
         return redirect(url('/')); 
    }
    
    return view('portal.evaluationlist',compact('users'));
   
    
    
}

public function view($id){
             
    $user = \App\User::where('id',$id)->first();
    $degrees = \App\Degree::where('user_id',$id)->orderBy('level')->orderBy('term')->get();
    $interest= \App\Interest::where('user_id',$id)->first();
    $courses=  \App\Course::where('user_id',$id)->get();
    $studentrequirements= \App\Requirement::where('user_id',$id)->first();
    $payments = \App\Course::where('user_id',$id)->where('coursetype','1')->get();
    $grades= $this->getgrade($user->email);
    //return $studentrequirements;
    return view('portal.evaluation',compact('grades','user','degrees','interest','courses','interest','studentrequirements','payments'));
}

public function update(Request $request){
    $userid=$request->userid;
    $interest = \App\Interest::where('user_id',$userid)->first();
/*
    $databaseid = \App\Course::where('user_id',$userid)->where('status','0')->where('coursetype','1')->first();
    if(count($databaseid)>0){
        $requestid = $databaseid->paymentrequestid;
    }else{
    $requestid = substr(uniqid(), 0, 13); 
    }
 */

    $databaseid = \App\Course::where('user_id',$userid)->where('status','0')->where('coursetype','1')->delete();
    $requestid = substr(uniqid(), 0, 13); 

    if($interest->status == '0'){
     $interest->status = '1'; 
     $interest->update();
     $user=\App\User::where('id',$userid)->first();
     $studentNo =$this->addStudentId($userid);
     $user->studentid =$studentNo;
     $user->update(); 

    }
    $refid = $request->refid;
    $status = $request->status;
    for($i=0;$i < count($refid); $i++){
    $update=  \App\Degree::where('id',$refid[$i])->first();
    $update->status = $status[$i];
    $update->update();   
    if($update->status == '5'){
     $newcourse = new \App\Course;
     $newcourse->user_id=$userid;
     $newcourse->courseid=$update->subjectcode;
     $newcourse->paymentrequestid=$requestid;
     $newcourse->coursename=$update->subjectname;
     $newcourse->amount=$update->amount;
     $newcourse->status='0';
     $newcourse->refid=$update->id;
     $newcourse->coursetype='1';
     $newcourse->paymentmessage='For Payment';
     $newcourse->save();
    }}
    
    
    return redirect(url('view/'.$userid));
    
    
}

public function addStudentId($id){
        $currentyear = date("Y");
        $studno="";
        for($i = strlen($id);$i < 7;$i++){
            $studno = $studno ."0";
        }
        $studno = $currentyear . $studno . $id;
        
                return $studno;
    }


public function notifystudent($id){
     
    $accesslevel = \Auth::user()->accesslevel;
    if($accesslevel != '1'){
         return redirect(url('/')); 
    }
    $student = \App\User::where('id',$id)->first();
    
    
    $studentmail = $student->email;
    $studentname =$student->lname . ", ". $student->fname;
    
     $email = array(
            'studentname'=>$studentname,
            'studentemail'=>$studentmail  
        );
              
        Mail::send('emails.notifystudent', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to($email['studentemail'], $email['studentname'])->cc('courseadmin@amauonline.com');
        $message->subject("AMA University Online Education - Your subjects are now ready!");
        });
  
        return "Successfully Notified";
 
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
          return view('portal.enrollment',compact('enrollments','datefrom','dateto'));
          } else
          {
            
            $filename = "degree_".$datefrom."_".$dateto.".csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('Name', 'USN', 'Enrollment Date', 'Course', 'No. of Subjects', 'Payment Mode','Payment'));

            foreach($enrollments as $key => $row) {
            fputcsv($handle, array($row['lname'].", ".$row['fname']. " ".$row['mname'], $row['studentid'], $row['enrolldate'], $row['programcode'], $row['count'], "Full",$row['amount']));
            }

    fclose($handle);

    $headers = array(
        'Content-Type' => 'text/csv',
    );

    return Response::download($filename, $filename, $headers);      
        
      }
      
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
          return view('portal.shortcourse',compact('enrollments','datefrom','dateto'));
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


public function changeCourse($userid){
            $name = \App\user::where('id',$userid)->first();
            $currentprogram = \App\Interest::where('user_id',$userid)->first();
            $programoffers =\DB::table('degree_offerings')->select('programcode','programname')->distinct()->get();
            //return $programoffers; 
	if(!empty($currentprogram)){   
            return view('portal.changerequest', compact('name','currentprogram','userid','programoffers'));
        }else{
	return "Student does not select any field of interest yet!!";
}
	}
        
        public function doChange(Request $request){
            $newcourses = \App\DegreeOffering::where('programcode',$request->changeto)->get();
            $oldprogramcode = $request->oldprogramcode;
            $oldprogramname = $request->oldprogramname;
            
            foreach($newcourses as $selected){
            $adddegree = new \App\Degree;
            $adddegree->user_id=  $request->userid;
            $adddegree->programcode = $selected->programcode;
            $adddegree->programname = $selected->programname;
            $adddegree->subjectcode = $selected->coursecode;
            $adddegree->subjectname = $selected->coursename;
            $adddegree->unit = $selected->unit;
            $adddegree->level = $selected->level;
            $adddegree->term = $selected->term;
            $adddegree->amount=$selected->amount;
            $adddegree->status=0;
            $adddegree->save();
            $newprogramcode = $selected->programcode;
            $newprogramname = $selected->programname;
            }
            
            $interest = \App\Interest::where('user_id',$request->userid)->first();
            $interest->programcode = $newprogramcode;
            $interest->programname = $newprogramname;
            $interest->update();
             
            $comparecourses = \App\Degree::where('user_id',$request->userid)
                    ->where('programcode',$oldprogramcode)->get();
            
            foreach($comparecourses as $comparecourse){
                if(!empty($comparecourse->status)){
                $updatestatus = \App\Degree::where('user_id',$request->userid)
                        ->where('subjectcode',$comparecourse->subjectcode)
                        ->where('programcode',$newprogramcode)->first();
                if(!empty($updatestatus)){
                $updatestatus->status = $comparecourse->status;
                $updatestatus->update();
                }
            }
            }
            
            $deletecourse = \App\Degree::where('user_id',$request->userid)
                    ->where('programcode',$oldprogramcode)->delete();
            
            return redirect('view/'. $request->userid);
            
        }

 public function getgrade($email){
            $sql = "SELECT u.firstname AS 'First Name', u.lastname AS 'Last Name', c.fullname AS 'Course', (
                    SELECT gh.finalgrade
                    FROM mdl_grade_grades gh
                    JOIN mdl_grade_items gih ON gih.id = gh.itemid
		    WHERE gih.itemtype = 'course'
                    AND u.id = gh.userid
                    AND gih.courseid = c.id
                    GROUP BY c.id
                    ) AS finalgrade
                    FROM mdl_user u
                    JOIN mdl_user_enrolments ue ON ue.userid = u.id
                    JOIN mdl_enrol e ON e.id = ue.enrolid
                    JOIN mdl_course c ON c.id = e.courseid
                    WHERE u.username = '$email'";
            $results = \Illuminate\Support\Facades\DB::connection('lms_connection')->Select($sql);
            return $results;
            //return view('forms.subjWGrade',compact('results', "studentInfo", 'studentCourse', 'matchfields', 'subjects'));
	}

}
