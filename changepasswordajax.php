<?php
include_once('config.php') ;

 $sessionId = $_SESSION['SessionChharo'];
 $customerId = $_POST['customerId']; 
 $currentPassword = $_POST['ctpin']; 
 $newPassword = $_POST['ntpin']; 

 //$currentPassword = 'Test@123';
 //$newPassword = 'Rabbit@123';



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharohttp/customer/getaccountinfoData",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition:
    form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
     name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
     name=\"websiteId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
    "postman-token: 9b3c2ce0-fb36-a0fd-bf65-88d664b6481e"
  ),
));
 $tmpfname = 'cookie.txt';
curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
 curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
$custInfo = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 //echo $custInfo;
  $responseData = json_decode($custInfo);
  $firstName = $responseData->firstName;
  $middleName = $responseData->middleName;
  $lastName = $responseData->lastName;
  $email = $responseData->email;
    // $firstName = $responseData1->firstName;
}
//exit; 
//$_SESSION['status'] = $_POST['status'];
//$username = '';
//$password = '';
$storeId = 1;
//$firstName ='';
//$middleName ='';
//$lastName = '';
$emailAddress=$email;
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => domain."/chharohttp/customer/editPost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	
    name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"firstName\"\r\n\r\n".$firstName."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"middleName\"\r\n\r\n".$middleName."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"lastName\"\r\n\r\n".$lastName."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"emailAddress\"\r\n\r\n".$emailAddress."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	name=\"doChangePassword\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
    name=\"currentPassword\"\r\n\r\n".$currentPassword."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
    name=\"newPassword\"\r\n\r\n".$newPassword."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
  ),
));

  $tmpfname = 'cookie.txt';
  curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
  curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

$response1 = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  //echo "cURL Error #:" . $err;
  //$responseData1 = json_decode($response1);
   $ResData = array('status'=>0,'message'=>$err); 
   echo json_encode($ResData); 
} else {
  ///echo $response1;
  $responseData1 = json_decode($response1);
	if(isset($responseData1->error)){
			if($responseData1->error == 5){

		    $curUrl = $_SERVER['REQUEST_URI'];
				$redirPath = checkSessionId($curUrl);
			header('Location: '.$redirPath);
	 		die;

	  }
	}
		  
  if($responseData1->error == 0){
  	///$_SESSION['new-tpin'] = $tpin;
    $ResData = array('status'=>1,'message'=>$responseData1->message,'tpinflag'=>$responseData1->tpinflag); 
    echo json_encode($ResData); 

  }else{

    $ResData = array('status'=>0,'message'=>$responseData1->message); 
    echo json_encode($ResData); 

  }
}