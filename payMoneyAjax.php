<?php include_once('config.php') ;

		
		 	if($_POST['method'] == 'pay'){           			
                //print_r($_SESSION);
                //print_r($_POST); //exit;

                	
					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => domain."chharohttp/wallet/pay",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					   name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"mobileno\"\r\n\r\n".$_POST['mobileNo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
					 //echo '<pre>';
					//echo $response;
					   $response = json_decode($response);
						   //print_r($responseAll);

					  
						  if(isset($response->error))
						  {
							 if($response->error == 5){

								 $curUrl = $_SERVER['REQUEST_URI'];
					             $redirPath = checkSessionId($curUrl); //exit;
					            header('Location: '.$redirPath);

							 }
						  }
						
					    if($response->success == 1){	
					   	  $ResData = array('status'=>1,'message'=>'success', 'name'=>$response->name,'id'=>$response->id,'mobile'=>$_POST['mobileNo']); 
   					 		echo json_encode($ResData); 
   					 	}else{

   					 		  $ResData = array('status'=>0,'message'=>$response->message); 
   					 		echo json_encode($ResData); 
   					 	}
					}
				
		}		
if($_POST['method'] == 'transfer'){           			
                //print_r($_SESSION);
                //print_r($_POST); //exit;

                	
					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => domain."/chharohttp/wallet/transfermoney",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					   name=\"senderId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"receiverId\"\r\n\r\n".$POST['receiverId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"amount\"\r\n\r\n".$_POST['amount']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
					 //echo '<pre>';
					//echo $response;
					   $response = json_decode($response);
						   //print_r($responseAll);

					  
						  if(isset($response->error))
						  {
							 if($response->error == 5){

								 $curUrl = $_SERVER['REQUEST_URI'];
					             $redirPath = checkSessionId($curUrl); //exit;
					            header('Location: '.$redirPath);

							 }
						  }
						
					    if($response->success == 1){	
					   	  $ResData = array('status'=>1,'message'=>'Transfer completed successfully'); 
   					 		echo json_encode($ResData); 
   					 	}else{

   					 		  $ResData = array('status'=>0,'message'=>$response->message); 
   					 		echo json_encode($ResData); 
   					 	}
					}
				
		}	
		          
     //  echo $html;
		              ?>