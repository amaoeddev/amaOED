<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;
use Mail;
class InterestController extends Controller {

    
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
            $users = \App\User::where('accesslevel','0')->orderBy('lname')->get();
            return view('portal.evaluation',compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
          
        }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $this->validate($request,[
            'tor' => 'mimes:jpeg,png,pdf,gif|max:5000',
            'diploma' => 'mimes:jpeg,png,pdf,gif|max:5000',
            'form137' => 'mimes:jpeg,png,pdf,gif|max:5000',
            'birthcertificate' => 'mimes:jpeg,png,pdf,gif|max:5000'
        ]);
        $degreename = \App\DegreeOffering::where('programcode',$request->degree)->first(); 
        $interest = new \App\Interest;
        $interest->user_id = \Auth::user()->id;
        $interest->programcode=$request->degree;
        $interest->programname=$degreename->programname;
        $interest->save();
           
        $requirement = new \App\Requirement;
        $requirement->user_id =\Auth::user()->id;
        $hasRequirements=0;    
            
        if($request->hasFile('tor')){    
        $imageName = uniqid() . '.' . $request->file('tor')->getClientOriginalExtension();
        $request->file('tor')->move(base_path() . '/public/images/catalog/', $imageName);
        $requirement->tor=$imageName;
        $hasRequirements=1;
        }
        
        if($request->hasFile('diploma')){    
        $imageName = uniqid() . '.' . $request->file('diploma')->getClientOriginalExtension();
        $request->file('diploma')->move(base_path() . '/public/images/catalog/', $imageName);
        $requirement->diploma=$imageName;
	 $hasRequirements=1;
        }
        
        if($request->hasFile('form137')){    
        $imageName = uniqid() . '.' . $request->file('form137')->getClientOriginalExtension();
        $request->file('form137')->move(base_path() . '/public/images/catalog/', $imageName);
        $requirement->form137=$imageName;
 $hasRequirements=1;
        }
        
        if($request->hasFile('birthcertificate')){    
        $imageName = uniqid() . '.' . $request->file('birthcertificate')->getClientOriginalExtension();
        $request->file('birthcertificate')->move(base_path() . '/public/images/catalog/', $imageName);
        $requirement->birthcertificate=$imageName;
 $hasRequirements=1;
        }
        
        $requirement->save();
        
        $courseselected =  \App\DegreeOffering::where('programcode',$request->degree)->get();
        foreach($courseselected as $selected){
            $adddegree = new \App\Degree;
            $adddegree->user_id=  \Auth::user()->id;
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
            
           
        }
//	 $hasRequirements="";
	 $esubject="";

        if($hasRequirements=="1"){
            $requirementMess = "Your credentials were received";
            $requirementHeader = "Welcome to AMAU OEd";
            $esubject="For Evaluation";
	    $email = array(
            'firstname'=>\Auth::user()->fname,
            'lastname'=>\Auth::user()->lname,
            'studentemail'=>\Auth::user()->email,
            'course'=>$request->degree,
            'amaemail'=>'courseadmin@amauonline.com',
            'requirementHeader'=>$requirementHeader,
            'requirementMess'=>$requirementMess,
            'hasRequirements'=>$hasRequirements,    
            'esubject'=>$esubject); 
	
	Mail::send('emails.interestama', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to($email['amaemail'], "Course Admin")->cc('records@amauonline.com');
        $message->subject($email['esubject']);
        });

        }
        else{
            $requirementMess="Your attachment is missing";
            $requirementHeader="Ooops!...";
            $esubject="Submitted Interest, credentials for follow-up";
        
	$email = array(
            'firstname'=>\Auth::user()->fname,
            'lastname'=>\Auth::user()->lname,
            'studentemail'=>\Auth::user()->email,
            'course'=>$request->degree,
            'amaemail'=>'courseadmin@amauonline.com',
            'requirementHeader'=>$requirementHeader,
            'requirementMess'=>$requirementMess,
            'hasRequirements'=>$hasRequirements,    
            'esubject'=>$esubject); 

	Mail::send('emails.interestama', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to($email['amaemail'], "Course Admin")->cc('otvergara@amauonline.com');
        $message->subject($email['esubject']);
        });
           		

        }
      /*  
        $email = array(
            'firstname'=>\Auth::user()->fname,
            'lastname'=>\Auth::user()->lname,
            'studentemail'=>\Auth::user()->email,
            'course'=>$request->degree,
            'amaemail'=>'courseadmin@amauonline.com',
            'requirementHeader'=>$requirementHeader,
            'requirementMess'=>$requirementMess,
            'hasRequirements'=>$hasRequirements,    
            'esubject'=>$esubject    
        );
              
        Mail::send('emails.interestama', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to($email['amaemail'], "Course Admin")->cc('records@amauonline.com');
        $message->subject($email['esubject']);
        });
           
        */
        Mail::send('emails.intereststudent', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to(\Auth::user()->email, \Auth::user()->lname . ", " . \Auth::user()->fname);
        $message->subject('For Evaluation');
        });

/*	 $email = array(
            'firstname'=>\Auth::user()->fname,
            'lastname'=>\Auth::user()->lname,
            'studentemail'=>\Auth::user()->email,
            'course'=>$request->degree,
            'amaemail'=>'customer@amauonline.com'
        );
              
//        Mail::send('emails.interestama', $email, function($message) use($email){
//        $message->to($email['amaemail'], "Customer Care")->subject('For evaluation');
//        });
            
  	Mail::send('emails.interestama', $email, function($message) use($email){
        $message->from('no-reply@amauonline.com');
        $message->to($email['amaemail'], "Customer Care")->cc('courseadmin@amauonline.com');
        $message->subject('For evaluation');
        });   
           
  */            
        return redirect(url('/'));
	
            
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
		//
	}

}
