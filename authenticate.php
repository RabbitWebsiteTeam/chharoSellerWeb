<?php
include_once('config.php');
//echo session_id() . <br />;

 $username1 = username;
  $password1 = password;
  $username = $_POST['username'];
  $password = $_POST['password'];

 
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
    "password: ".$password1,
    "username: ".$username1
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
  echo "cURL Error #:" . $err;
} else {

 $responseData = json_decode($response);
   if($responseData->error == 0){
   		 $responseData->sessionId;
		 $_SESSION['SessionChharo'] = $responseData->sessionId;
   		 //header('Location:index.php');
		 }
		 }
	//End authenticate api	 
		
		
		
///Login
   $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => domain."chharohttp/customer/logIn/",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"username\"\r\n\r\n".$username."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"password\"\r\n\r\n".$password."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"width\"\r\n\r\n100\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
   name=\"websiteId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",   
    "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW",
   
  ),
));

$tmpfname = 'cookie.txt';
curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);

//curl_setopt($curl, CURLOPT_HTTPHEADER, array("Cookie: PHPSESSID=rf7dhnoenh3er0n8a2fgiss8e1; path=/; domain=35.187.232.245; HttpOnly; Expires=Sun, 28 Jan 2018 13:08:38 GMT;"));
// CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$responseData->sessionId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"username\"\r\n\r\n9000000000\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"password\"\r\n\r\nColor@123\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"width\"\r\n\r\n100\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"websiteId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
   $response1 = curl_exec($curl);
 $err = curl_error($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else {

	$responseData1 = json_decode($response1);
	//print_r($responseData1);
   if($responseData1->status == true){
   		 $responseData1->customerName;
		
		$_SESSION['T-pin'] = $responseData1->T-pin;
		$_SESSION['customerId'] = $responseData1->customerId;
		$_SESSION['customerName'] = $responseData1->customerName;
    $_SESSION['sesPpassword'] = $_POST['password'];
    $_SESSION['username'] = $_POST['username'];
    // $_SESSION['customerId'] = $_POST['customerId']; 
   // print_r($_SESSION);
    if($_SESSION['username'] == '11110001'){
          header('Location:passbook.php');
    }else{
       header('Location:home.php');
    }
   	
	}
	else{
		 $err = $responseData1->message;
		header('Location:index.php?err='.$err);
		
	}
 }
///




?>
