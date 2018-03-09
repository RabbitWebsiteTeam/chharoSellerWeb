<?php
include_once('config.php') ;
//print_r($_SESSION);
	if(isset($_REQUEST['sDate'])){  			
			$sDate = date("Y-m-d",strtotime($_REQUEST['sDate']));
		}else{
			$sDate = date("Y-m-d",strtotime("-1 month"));  				
		}
		if(isset($_REQUEST['eDate'])){  			
			$eDate = date("Y-m-d",strtotime($_REQUEST['eDate']));
		}else{  			
			 $eDate = date('Y-m-d');	
		}
//print_r($_SESSION);
	$type = 'all';
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => domain."/chharohttp/wallet/transactionhistoryAll",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
	   name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
	   name=\"transactionType\"\r\n\r\n".$type."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	   name=\"startDate\"\r\n\r\n".$sDate."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	   name=\"endDate\"\r\n\r\n".$eDate."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
		
		if(isset($responseAll->error))
		  {
			 if($responseAll->error == 5){

				 $curUrl = $_SERVER['REQUEST_URI'];
	             $redirPath = checkSessionId($curUrl); //exit;
	            header('Location: '.$redirPath);

			 }
		  }
		if(!empty($responseAll)){
	    	$walletData = $responseAll->walletData;
	    }
	   // 
	   // print_r($walletData);

	}


$data= '';

 $data .= '<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                
				  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Transaction Type</th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">From </th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Amount </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Note </th>

                </thead>
                <tbody>';
                
				 if(count($walletData) > 0) { foreach($walletData as $walletData1) {

				      $data .='<tr role="row" class="odd">';
                   
                    $data .='<td>'.  $walletData1->action .'</td>';
                    $data .='<td>'.$walletData1->sender_name.'</td>';
                  
                    $data .='<td>'.$walletData1->amount.'</td>';
                      $data .='<td>'.$walletData1->transaction_at.'</td>';
                      $data .='<td>'.$walletData1->transaction_note.'</td>';
                    
                  $data .='</tr>';
				} }else{
				  $data .='<td>"Transactions not available.</td>';
				} 
                $data .='</tbody>';
               
                $data .='</table>';					   
 $fileName = 'passbook.csv';
 echo $data;
/* 
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header('Content-Description: File Transfer');
header("Content-type: text/csv");
header("Content-Disposition: attachment; filename={$fileName}");
header("Expires: 0");
header("Pragma: public");

$fh = @fopen( 'php://output', 'w' );

$headerDisplayed = false;


   
    // Put the data into the stream
    fputcsv($fh, $data);

// Close the file
fclose($fh);
// Make sure nothing else is sent, our file is done
exit;*/

?>