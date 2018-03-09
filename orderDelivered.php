<?php
include_once('config.php') ;

 $incrementId = $_POST['incid']; 
 $customerId = $_POST['customerId']; 
//exit; 
//$_SESSION['status'] = $_POST['status'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharomphttp/marketplace/DeliveredOrder",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
   name=\"incrementId\"\r\n\r\n".$incrementId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
  //echo "cURL Error #:" . $err;
  $responseData1 = json_decode($response1);
   $ResData = array('status'=>0,'message'=>$err); 
   echo json_encode($ResData); 
} else {
  echo $response;
  $responseData = json_decode($response);
  if($responseData->success == 1){
    $ResData = array('status'=>1,'message'=>$responseData->message); 
    echo json_encode($ResData); 
  }else{
    $ResData = array('status'=>0,'message'=>$responseData->message); 
    echo json_encode($ResData); 
  }
}