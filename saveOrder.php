<?php
///// savorder 
include_once('config.php') ;

 //print_r($_SESSION); // exit;
 // call SaveOrder api
 $sessionId = $_SESSION['SessionChharo']; 
 $customerId = $_SESSION['customerId']; 
 $storeId = 1; 
 $code = $_SESSION['code'];
 $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => domain."chharohttp/checkout/saveOrder",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
      name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
      name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
      name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
      name=\"method\"\r\n\r\n".$code."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
        
      ),
    ));
    
      $tmpfname = 'cookie.txt';
      curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
      curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

      $saveOrderJson = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);

        if ($err) {
          $ResData = array('status'=>0,'message'=>$err,'steperr'=>'saveOrder'); 
          echo json_encode($ResData); 
        } else {

            $saveOrderJson;

          $saveOrderArr = json_decode($saveOrderJson);

          if($saveOrderArr->success ==1){
              $incrementId = $saveOrderArr->incrementId;
             // print_r($welcome);
              $orderId = $saveOrderArr->orderId;
        
          // echo $orderId = $saveOrderArr->orderId;

            //$ResData = array('status'=>1,'message'=>'Order placed successfull, Order Id #'.$orderId,'step'=>'saveOrder','incrementId'=>$incrementId); 
            //echo json_encode($ResData);
          }

        }
      // call empty APi

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharohttp/checkout/emptyCart",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"sessionId\"\r\n\r\n".$sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
  name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
  
   $ResData = array('status'=>0,'message'=>$err); 
   echo json_encode($ResData);

} else {
  //echo $response1; 
  //exit;
   $responseData1 = json_decode($response1);
  if(isset($responseData1->error)){
      if($responseData1->error == 5){

        $curUrl = $_SERVER['REQUEST_URI'];
        $redirPath = checkSessionId($curUrl);
      header('Location: '.$redirPath);
      die;

    }
  }

  // redirect to access page

  header('Location: success.php');
      
  
}