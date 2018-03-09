<?php include_once('config.php') ;


		            			
                //print_r($_SESSION);
                	$type = 'ewcreditdebit';
					$curl = curl_init();
					curl_setopt_array($curl, array(
					  CURLOPT_URL => domain."chharohttp/wallet/transactionhistoryAll",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					   name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					   name=\"transactionType\"\r\n\r\n".$_POST['type']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"startDate\"\r\n\r\n".$_POST['sDate']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
					   name=\"endDate\"\r\n\r\n".$_POST['eDate']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
					   $responseAll = json_decode($response);
						   //print_r($responseAll);

					  
						  if(isset($responseAll->error))
						  {
							 if($responseAll->error == 5){

								 $curUrl = $_SERVER['REQUEST_URI'];
					             $redirPath = checkSessionId($curUrl); //exit;
					            header('Location: '.$redirPath);

							 }
						  }
						
					    	$walletData4 = $responseAll->walletData;
					   	  $ResData = array('status'=>1,'data'=>$walletData4); 
   					 		echo json_encode($ResData); 
					}
				
				

		          
     //  echo $html;
		              ?>