<?php

//echo "Hello";

$username = "portaluser";
$password = "@m@P@ssw0rd";
//$hostname = "amaportal.cywaxl3qqd6o.ap-southeast-1.rds.amazonaws.com"; 
$hostname ="ama-db-instance.cywaxl3qqd6o.ap-southeast-1.rds.amazonaws.com";

$merchantid="";
$request_id="";
$response_id="";
$timestamp="";
$rebill_id="";
$signature="";
$ptype="";
$response_code="";
$response_message="";
$response_advise="";
$processor_response_id="";
$processor_response_authcode="";
$transaction="";

//connection to the database

$dbhandle = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

@mysql_select_db("ama1DB") or die(mysql_error());

$body = '';
if(isset($_POST["paymentresponse"])){
$body=$_POST['paymentresponse'];
}
else{
$fh = @fopen('php://input', 'r');
if($fh){
  
        while (!feof($fh)){
        $s = fread($fh, 1024);
   
                 if (is_string($s)){
                $body .= $s;
                }
        }
  fclose($fh);
}
}
$base64data = $body;
$body = str_replace(" ","+",$body);
$body = base64_decode($body);

$bodyparse=simplexml_load_string($body);
foreach($bodyparse as $key){
//echo "<ul>";
        foreach($key as $name => $value){
//        echo "<li>$name = $value</li>";
        if($name=="request_id"){$requestid=$value;}
        if($name=="response_code"){$responsecode=$value;}
        if($name=="merchantid"){$merchantid=$value;}
		  if($name=="response_id"){$response_id=$value;}		  
        if($name=="timestamp"){$timestamp=$value;}
		  if($name=="rebill_id"){$rebill_id=$value;}
		  if($name=="signature"){$signature=$value;}
		  if($name=="ptype"){$ptype=$value;}
		  if($name=="response_message"){$response_message=$value;}
		  if($name=="response_advise"){$response_advise=$value;}
		  if($name=="processor_response_id"){$processor_response_id=$value;}
		  if($name=="processor_response_authcode"){$processor_response_authcode=$value;}
		  if($name=="transaction"){$transaction=$value;}        
        }
// echo "</ul>";
}

$strQRY = "INSERT INTO paynamics (merchantid,request_id,response_id,timestamp,rebill_id,signature," ;
$strQRY = $strQRY . "ptype,response_code,response_message,response_advise,processor_response_id,processor_response_authcode,transaction) VALUES ";
$strQRY = $strQRY . "('" .$merchantid."','" . $requestid . "','". $response_id ."','";
$strQRY = $strQRY . $timestamp . "','". $rebill_id . "','" . $signature . "','". $ptype . "','";
$strQRY = $strQRY . $responsecode . "','" . $response_message . "','" . $response_advise . "','";
$strQRY = $strQRY . $processor_response_id . "','" . $processor_response_authcode . "','";
$strQRY = $strQRY . $transaction ."')";


if(@mysql_query("UPDATE courses set status = '" . $responsecode . "', paymentmessage = '" . $response_message . "' WHERE paymentrequestid='" . $requestid ."'")){
	
	if(@mysql_query($strQRY)){	
	echo "<h2>Successfully Received!!</h2>";
	}
	else{	
	echo "<h2 style='color:red'>Failed!!</h2>";
	}
}
else
{
echo "<h2 style='color:red'>Failed!!</h2>";
}
 

$result = @mysql_query("SELECT * FROM courses WHERE paymentrequestid = '$requestid'");
$otherfee = "0";
while($row=@mysql_fetch_array($result)){
    if($responsecode=="GR001"){
	if($otherfee=="0"){
            
         $qry =  "Insert Into other_collections (user_id, requestid, description, ";
         $qry =  $qry . " amount, created_at, updated_at ) VALUES ('". $row['user_id'] ;
         $qry =  $qry . "','". $requestid . "','Other Fees','605','" . $timestamp ."','". $timestamp ."')";
         @mysql_query($qry);
         $otherfee="1";   
        }
        @mysql_query("UPDATE degrees set status = '2' WHERE id = '".$row['refid']."'");
        @mysql_query("UPDATE users set status = '1' WHERE id = '".$row[user_id]."'");
    }
    else{
        @mysql_query("UPDATE degrees set status = '1' WHERE id = '".$row['refid']."'");
    }
    
}

?>

