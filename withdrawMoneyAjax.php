<?php
//print_r($_POST);
include_once('config.php') ;

 $sessionId = $_SESSION['SessionChharo'];
 $customerId = $_POST['customerId']; 
 $bank = $_POST['bank']; 
 $amount = $_POST['amount']; 
 $mobileno = $_POST['mobileno']; 
 $accountNumber = '';//$_POST['accountNumber']; 
 //$currentPassword = 'Test@123';
 //$newPassword = 'Rabbit@123';


if(empty($_POST['SessionChharo']) || empty($_POST['customerId']) || empty($_POST['amount']) || empty($_POST['bank']) || empty($_POST['mobileno']) || empty($_POST['accountNumber'])){

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => domain."/chharohttp/wallet/withdrawmoneybanks",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		   name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition:
		    form-data; name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		    name=\"bankName\"\r\n\r\n".$bank."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		    name=\"mobileno\"\r\n\r\n".$mobileno."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		    name=\"accountNumber\"\r\n\r\n".$accountNumber."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		    name=\"amount\"\r\n\r\n".$amount."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
		  CURLOPT_HTTPHEADER => array(
		    "cache-control: no-cache",
		    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
		  ),
		));
		 $tmpfname = 'cookie.txt';
		curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
		 curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		// echo $response;
		$responseData1 = json_decode($response);
		
		 if(isset($responseData1->error))
              {
               if($responseData1->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }

		 if($responseData1->success == 1){
		  	$_SESSION['new-tpin'] = $tpin;
		    $ResData = array('status'=>1,'message'=>$responseData1->message); 
		    echo json_encode($ResData); 

		  }else{

		    $ResData = array('status'=>0,'message'=>$responseData1->message); 
		    echo json_encode($ResData); 

		  }
		}
		//exit; 
	
}else{
	  $ResData = array('status'=>0,'message'=>'Please provide a valide data'); 
    echo json_encode($ResData); 
}