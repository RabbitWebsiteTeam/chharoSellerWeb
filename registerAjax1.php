<?php
include_once('config.php');
//echo session_id() . <br />;
//print_r($_SESSION);
 $username = username;
  $password = password;
   $address =  $_POST['address'];
    $city =  $_POST['city'];
	 $pcode =  $_POST['pcode']; 
	 $squetion =  $_POST['squetion'];
	 $answer =  $_POST['answer'];
	
	 
	 $fname =  $_SESSION['reg1Data']['fname'];
	$tpin =  $_SESSION['reg1Data']['tpin'];
    $lname =  $_SESSION['reg1Data']['lname'];
	 $phone =  $_SESSION['reg1Data']['phone']; 
	 $bname =  $_SESSION['reg1Data']['bname'];
	  $pass =  $_SESSION['reg1Data']['pass'];
	 $repass =  $_SESSION['reg1Data']['repass'];
	// $email = $_POST['reg1Data']['email'];
	 $email = 'noemail.'.$phone.'@chharo.bt';
	
	  $localcid =$city;
	 //exit;
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
				//$_SESSION['reg1Data'] = $_POST;
				// register

						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => domain."chharohttp/customer/createPost",
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => "",
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 30,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => "POST",
						  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						  name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
						   name=\"firstName\"\r\n\r\n".$fname."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"lastName\"\r\n\r\n".$lname."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"emailAddr\"\r\n\r\n".$email."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"password\"\r\n\r\n".$pass."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"mobile_number\"\r\n\r\n".$phone."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"local\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"tpin\"\r\n\r\n".$tpin."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
						   name=\"isChecked\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
						   name=\"localcid\"\r\n\r\ntestlocalcid\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
						   name=\"addressData\"\r\n\r\n{\"default_billing\":1,\"default_shipping\":1,
						   \"country_id\":\"BT\",
						   \"region\":\"".$address."\",
						   \"street\":[\"".$address."\"],
						   \"telephone\":".$phone.",\"firstname\":\"".$fname."\",
						   \"lastname\":\"".$lname."\",\"city\":\"".$city."\",
						   \"postcode\":\"".$pcode."\"}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
						  CURLOPT_HTTPHEADER => array(
						    "cache-control: no-cache",
						    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
						  
						  ),
						));
						$tmpfname = 'cookie.txt';
					    curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
					    curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

						$response12 = curl_exec($curl);
						$err = curl_error($curl);

						curl_close($curl);

						if ($err) {
						  echo "cURL Error #:" . $err;
						} else {
						  //echo $response12;
							$_SESSION['reg1Data'] = '';
						  $responseData12 = json_decode($response12);
						  $ResData = array('status'=>1);
						  echo json_encode($ResData);
						}


				// register 
				
									  
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