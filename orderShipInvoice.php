<?php
include_once('config.php') ;

 $incrementId =  $_POST['incid']; 
 $customerId = $_POST['customerId']; 
//exit; 
//$_SESSION['status'] = $_POST['status'];

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharomphttp/marketplace/ship",
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
    "content-type: multipart/form-data;
     boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
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
 // $responseData1 = json_decode($response);
   $ResData = array('status'=>0,'message'=>$err); 
   echo json_encode($ResData); 
} else {
 //echo $response;
  $responseData = json_decode($response);
 //echo $responseData->error;
   // print_r($responseData);
   if(isset($responseData->error))
    {
     if($responseData->error == 5){
      $curUrl = $_SERVER['REQUEST_URI'];
            $redirPath = checkSessionId($curUrl);
            header('Location: '.$redirPath);

     }
    }
  if($responseData->success == 1){
    // invoice service start


      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => domain."chharomphttp/marketplace/invoice",
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
          "content-type: multipart/form-data;
           boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",          
        ),
      ));
      $tmpfname = 'cookie.txt';
      curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
      curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
      $response1 = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

      if ($err) {
       // echo "cURL Error #:" . $err;
         $ResData = array('status'=>0,'message'=>$err); 
        echo json_encode($ResData); 
      } else {
        //echo $response1;
        $responseData1 = json_decode($response1);
        //echo $responseData1->error;
        if($responseData1->success == 1){

            $ResData = array('status'=>1,'message'=>$responseData1->message); 
            echo json_encode($ResData); 
        }else{

            $ResData = array('status'=>0,'message'=>$responseData1->message); 
            echo json_encode($ResData); 
        }
    }
    // end invoice service start
  }else{
    $ResData = array('status'=>0,'message'=>$responseData->message); 
    echo json_encode($ResData); 
  }
}