<?php
include_once('config.php');
//echo session_id() . <br />;
 $username = username;
  $password = password;
  $fname =  $_POST['fname'];
   $tpin =  $_POST['tpin'];
    $lname =  $_POST['lname'];
	 $phone =  $_POST['phone']; 
	 $bname =  $_POST['bname'];
	 $pass =  $_POST['pass'];
	 $repass =  $_POST['repass'];
	 $email = $_POST['email'];
	 $address = '';
	 $tpin = '';
	 $localcid ='';
 $curl = curl_init();
 curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharohttp/extra/authenticate/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "password: ".$username,   
    "username: ".$password
  ),
));

		$tmpfname = 'cookie.txt';
        curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

//curl_setopt($curl, CURLOPT_HTTPHEADER, array($cookie));

 $response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
if ($err) {
 // echo "cURL Error #:" . $err;
  $ResData = array('status'=>0,'message'=>$err);
  echo json_encode($ResData);
} else {
	$responseData = json_decode($response);
	if($responseData->error == 0){
		 $responseData->sessionId;
		  $_SESSION['SessionChharo'] = $responseData->sessionId;
		 
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => domain."/chharohttp/customer/checkMobile",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"mobile_number\"\r\n\r\n".$phone."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
			  echo "cURL Error #:" . $err;
			} else {
			  //echo $response1;
			  $responseData1 = json_decode($response1);
			  
			  // if condition 
			  if($responseData1->mobileflag == 1){
				  
				$ResData = array('status'=>0,'message'=>$responseData1->message);  
				echo json_encode($ResData);   
			  }else{
					// call regist api				
				$_SESSION['reg1Data'] = $_POST;
				  $ResData = array('status'=>1,'message'=>$responseData1->message,'regData'=>$_POST); 
					echo json_encode($ResData);				  
			  }
			 
			} 
			
	}else{
		
	//	print_r(responseData);
		$ResData = array('status'=>0,'message'=>$responseData->message);
		echo json_encode($ResData);
		//echo $responseData->message;
	}
	
}

		

?>