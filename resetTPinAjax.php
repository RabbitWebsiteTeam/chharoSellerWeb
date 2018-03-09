<?php
include_once('config.php') ;

 $sessionId = $_SESSION['SessionChharo'];
 $customerId = $_POST['customerId']; 
 $ntpin = $_POST['ntpin']; 
 //$newPassword = $_POST['ntpin']; 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://35.186.157.60/chharohttp/customer/resetTpin",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n6a1jo4acqgh2sf9o12g5bmr957\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"SecurityAnswer\"\r\n\r\nselena\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"SecurityQuestion\"\r\n\r\nWhat was your childhood nickname?\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"newtpin\"\r\n\r\n1111\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"   
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
  //echo $response1;
  $responseData1 = json_decode($response1);
  if(isset($responseData1->error)){
      if($responseData1->error == 5){

        $curUrl = $_SERVER['REQUEST_URI'];
        $redirPath = checkSessionId($curUrl);
      header('Location: '.$redirPath);
      die;

    }
  }
      
  if($responseData1->success == 1){
    //$_SESSION['new-tpin'] = $tpin;
    $ResData = array('status'=>1,'message'=>$responseData1->message,'tpinflag'=>$responseData1->tpinflag); 
    echo json_encode($ResData); 

  }else{

    $ResData = array('status'=>0,'message'=>$responseData1->message); 
    echo json_encode($ResData); 

  }
}