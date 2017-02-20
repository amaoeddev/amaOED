<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;


class CheckSessionController extends Controller {

    public function __construct()
	{
		$this->middleware('auth');
	}
    
public function index(){
   
    $currentsession = \Illuminate\Support\Facades\Session::getId();
    $myid = \Auth::user()->id;    
    $mysession = \App\User::find($myid);
    $databasesession = $mysession->lastsessionid;
    if($currentsession == $databasesession){
        return "true";
        
    }
    else{
        
        return "false";
    }
    

    
}	

}
