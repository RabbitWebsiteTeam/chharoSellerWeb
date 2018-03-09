<?php
ob_start();
session_start();
error_reporting(E_ALL & ~E_NOTICE);
//define('apipath', 'http://35.186.157.60/');
define('username','9000000000');
define('password','Color@123');
//DEV
define('domain', 'http://35.186.157.60/');

//UAT
//define("domain", 'https://chharouat.bob.bt/');

define("productImgPath", 'pub/media/catalog/product/');

define("RESIDENT_ROOT_ID", '2');
define("TOURIST_ROOT_ID", '278');

define("RESIDENT_SHOP", '279');
define("RESIDENT_BOOK_SERVICE", '280');
define("RESIDENT_PAYBILLS", '281');

define("TOURIST_SHOP", '282');
define("TOURIST_BOOK_SERVICE", '283');
define("TOURIST_TOUR_GUIDE", '284');
//define("productImgPath", 'pub/media/catalog/product/');


// generate sesstion id
function checkSessionId($string){ //function parameters, two variables.

	$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
    || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';

	$basePath = $protocol.$_SERVER['HTTP_HOST'];

	$username1 = username;
  	$password1 = password;

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
		   		 
				 }
			 }

    return $basePath.$string;  //returns the second argument passed into the function
  }
?>
