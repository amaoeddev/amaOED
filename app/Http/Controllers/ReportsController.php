<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
use Response;

class ReportsController extends Controller {

    public function assessment($id) {
        $studentInfo = \App\User::where('id', $id)->first();
        $studentCourse = \App\Interest::where('user_id', $id)->first();

        $matchfields = ['user_id' => $id, 'status' => 2];
        $subjects = \App\Degree::where($matchfields)->get();
        $subjects2 = \App\Degree::where($matchfields)->get();

        return view('forms.assessment', compact('studentInfo', 'studentCourse', 'subjects', 'subjects2'));
    }

    public function studentPerCourse($course) {

        $student = DB::Select("SELECT * FROM `users` join (SELECT user_id,programcode from interests where status=1) course on course.user_id=users.id where course.programcode like '$course' and users.status=1 order by `lname` asc, `fname` asc, `mname` asc");

        //return $studentInfo;
        return view('forms.studentPerCourse', compact('student'));
    }

    public function studentPerShortCourse($course) {

        $student = DB::Select("SELECT *
FROM `courses`
JOIN (

SELECT id, studentid, fname, mname, lname
FROM `users`
)u ON u.id = courses.user_id
WHERE courses.courseid =$course
AND courses.status LIKE 'GR001'
order by `lname` asc, `fname` asc, `mname` asc");

        //return $studentInfo;
        return view('forms.studentPerShortCourse', compact('student'));
    }

    public function perStudent() {

        $result = DB::Select("SELECT studentid, fname, lname, mname, sum( not_yet_taken ) as not_yet_taken , sum( not_yet_taken2 ) as not_yet_taken2 , sum( paid ) as paid, sum( credited ) as credited, sum( for_payment ) as for_payment, sum( passed ) as passed, sum( not_required ) as not_required
FROM (select users.studentid, users.fname, users.lname, users.mname,

case degrees.status
	when '1' then (COUNT(degrees.status))
	else ('0')
end as not_yet_taken,
case degrees.status
	when '0' then (COUNT(degrees.status))
	else ('0')
end as not_yet_taken2,
case degrees.status
	when '2' then (COUNT(degrees.status))
	else ('0')
end paid,
case degrees.status
	when '3' then (COUNT(degrees.status))
	else ('0')
end credited,
case degrees.status
	when '5' then (COUNT(degrees.status))
	else ('0')
end for_payment,
case degrees.status
	when '6' then (COUNT(degrees.status))
	else ('0')
end passed,
case degrees.status
	when '7' then (COUNT(degrees.status))
	else ('0')
end not_required
From degrees
inner join users on users.id = degrees.user_id
group by user_id, degrees.status) AS sample group by studentid
order by `lname` asc, `fname` asc, `mname` asc");

        //return $studentInfo;
        return view('forms.perStudent', compact('result'));
    }

    public function getgrade($id) {
        $studentInfo = \App\User::where('id', $id)->first();
        $email = $studentInfo->email;
        $studentCourse = \App\Interest::where('user_id', $id)->first();
        $matchfields = ['user_id' => $id, 'status' => 1];
        $subjects = \App\Degree::where($matchfields)->get();

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
        //return $results;
        return view('forms.gradeslip', compact('results', "studentInfo", 'studentCourse', 'matchfields', 'subjects'));
    }

    public function totalcollection() {
        $month = $_POST['month'];
        $year = $_POST ['year'];
        $collection = DB::Select("select distinct u.studentid, u.fname, u.lname, paynamics.timestamp, paynamics.rebill_id, paynamics.response_code, paynamics.response_message from `paynamics` 
join courses as c on c.paymentrequestid=paynamics.request_id
join users as u on u.id=c.user_id
where timestamp like '$year-$month' and response_code = 'GR001' order by paynamics.timestamp");
        $total = DB::Select("Select format(sum(rebill_id),2) as total from `paynamics` where timestamp like '$year-$month' and response_code = 'GR001'");
        return view('forms.totalcollection', compact('collection', 'total'));
    }

    public function collectionreport() {
        $collection = DB::Select("SELECT c.studentid, c.fname, c.lname, c.enrolled, d.payment, d.balance
FROM 

(SELECT a.studentid, a.fname, a.lname, a.mname, sum( a.enrolled ) as enrolled

FROM (SELECT users.studentid, users.fname, users.lname, users.mname,

case degrees.status
	when '2' then (COUNT(degrees.status))
	else ('0')
end enrolled

FROM degrees
INNER JOIN users on users.id = degrees.user_id

where users.studentid not like '' group by user_id, degrees.status) as a group by studentid
order by `lname` asc, `fname` asc, `mname` asc) as c

INNER JOIN
(SELECT sum(b.total_payment) as payment, sum(b.total_balance) as balance, b.studentid as stud

FROM (SELECT studentid,

case courses.status
	when 'GR001' then (sum(courses.amount))
	else '0'
end total_payment,
case courses.status
	when '0' then (sum(courses.amount))
	else '0'
end total_balance

FROM courses
INNER JOIN users on users.id = courses.user_id

WHERE users.studentid not like '' group by user_id, courses.status) as b group by studentid) as d on d.stud = c.studentid");
        return view('forms.collectionreport', compact('collection'));
    }

    public function persubject($level, $term) {
        $data = DB::Select("SELECT distinct concat (subjectcode,' ', subjectname) as subjectcodes, subjectcode FROM degrees WHERE level = '$level' and term = '$term' order by subjectcodes ASC");

        return Response::json($data);
    }
    
    public function level($level) {
        $data = DB::Select("SELECT distinct term FROM degrees WHERE level = '$level' order by term asc");

        return Response::json($data);
    }

    public function persubjectgrade(Request $request) {
        $level = $request ['level'];
        //  echo $level;
        $subj = $request ['subject'];
        $term = $request ['term'];
        //    echo $subj;
        $sql = DB::Select("SELECT users.studentid, users.fname, users.lname, degrees.level, degrees.term, degrees.subjectcode, degrees.subjectname FROM degrees join users on users.id=degrees.user_id WHERE level = '$level' and subjectcode = '$subj' and term = '$term' and degrees.status = 2 order by users.lname asc");
        return view('forms.resultsubject', compact('sql'));
    }
    
    public function course() {
        $result = "select distinct mdl_course.fullname from mdl_course order by mdl_course.fullname asc";
        $data = \Illuminate\Support\Facades\DB::connection('lms_connection')->Select($result);

        return Response::json($data);
    }
    
    public function subjectGrades(Request $request) {
        $course = $request ['course'];

        $sql = "SELECT u.firstname, u.lastname, c.fullname, (
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
                    WHERE c.fullname = '$course'";
        $results = \Illuminate\Support\Facades\DB::connection('lms_connection')->Select($sql);
        //return $results;
        return view('forms.subjWithGrade', compact('results'));
    }
    
    public function passedGrades(Request $request) {
        $course = $request ['course'];

        $sql = "SELECT u.firstname, u.lastname, c.fullname, (
                    SELECT gh.finalgrade
                    FROM mdl_grade_grades gh
                    JOIN mdl_grade_items gih ON gih.id = gh.itemid
		    WHERE gih.itemtype = 'course'
                    AND u.id = gh.userid
                    AND gih.courseid = c.id
                    AND gh.finalgrade >= 50
                    GROUP BY c.id
                    ) AS finalgrade
                    FROM mdl_user u
                    JOIN mdl_user_enrolments ue ON ue.userid = u.id
                    JOIN mdl_enrol e ON e.id = ue.enrolid
                    JOIN mdl_course c ON c.id = e.courseid
                    WHERE c.fullname = '$course'";
        $results = \Illuminate\Support\Facades\DB::connection('lms_connection')->Select($sql);
        //return $results;
        return view('forms.subjWithGrade', compact('results'));
    }
}