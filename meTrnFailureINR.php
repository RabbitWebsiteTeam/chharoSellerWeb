<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	/**
	 * This Is the Kit File To Be included For Transaction Request/Response
	 */
	include '../PHP_WLIPG/Standard/AWLMEAPI.php';
	
	//create an Object of the above included class
	$obj = new AWLMEAPI();
	
	/* This is the response Object */
	$resMsgDTO = new ResMsgDTO();

	/* This is the request Object */
	$reqMsgDTO = new ReqMsgDTO();
	
	//This is the Merchant Key that is used for decryption also
	$enc_key = "a75ff45c55195be55d1f8f02d00bd2ba";
	
	/* Get the Response from the WorldLine */
	$responseMerchant = $_REQUEST['merchantResponse'];
	
	$response = $obj->parseTrnResMsg( $responseMerchant , $enc_key );
     
	
?>
<style>
	body{
	font-family:Verdana, sans-serif	;
	font-size::12px;
	}
	.wrapper{
	width:980px;
	margin:0 auto;	
	}
	table{

	}
	tr{
		padding:5px
	}
	td{
	padding:5px;	
	}
	input{
	padding:5px;	
}
</style>
<form action="testTxnStatus.php" method="POST" >
<center> <H3>Transaction Status </H3></center>
<?php echo json_encode($response); ?>
	<table>
		<tr><!-- PG transaction reference number-->
			<td><label for="txnRefNo">Transaction Ref No. :</label></td>
			<td><?php echo $response->getPgMeTrnRefNo();?></td>
			<!-- Merchant order number-->
			<td><label for="orderId">Order No. :</label></td>
			<td><?php echo $response->getOrderId();?> </td>
			<!-- Transaction amount-->
			<td><label for="amount">Amount :</label></td>
			<td><?php echo $response->getTrnAmt();?></td>
		</tr>
		<tr><!-- Transaction status code-->
			<td><label for="statusCode">Status Code :</label></td>
			<td><?php echo $response->getStatusCode();?></td>
			
			<!-- Transaction status description-->
			<td><label for="statusDesc">Status Desc :</label></td>
			<td><?php echo $response->getStatusDesc();?></td>
			
			<!-- Transaction date time-->
			<td><label for="txnReqDate">Transaction Request Date :</label></td>
			<td><?php echo $response->getTrnReqDate();?></td>
		</tr>
		<tr>
			<!-- Transaction response code-->
			<td><label for="responseCode">Response Code :</label></td>
			<td><?php echo $response->getResponseCode();?></td>
			
			<!-- Bank reference number-->
			<td><label for="statusDesc">RRN :</label></td>
			<td><?php echo $response->getRrn();?></td>
			<!-- Authzcode-->
			<td><label for="authZStatus">AuthZCode :</label></td>	
			<td><?php echo $response->getAuthZCode();?></td>
		</tr>
		<tr>	<!-- Additional fields for merchant use-->
			<td><label for="addField1">Add Field 1 :</label></td>
			<td><?php echo $response->getAddField1();?></td>

			<td><label for="addField2">Add Field 2 :</label></td>
			<td><?php echo $response->getAddField2();?></td>
			
			<td><label for="addField3">Add Field 3 :</label></td>
			<td><?php echo $response->getAddField3();?></td>
		</tr>
		<tr>	
				<td><label for="addField4">Add Field 4 :</label></td>
				<td><?php echo $response->getAddField4();?></td>
				
				<td><label for="addField5">Add Field 5 :</label></td>
				<td><?php echo $response->getAddField5();?></td>
				
				<td><label for="addField6">Add Field 6 :</label></td>
				<td><?php echo $response->getAddField6();?></td>	
			</tr>
			<tr>	
				<td><label for="addField7">Add Field 7 :</label></td>
				<td><?php echo $response->getAddField7();?></td>
				
				<td><label for="addField8">Add Field 8 :</label></td>
				<td><?php echo $response->getAddField8();?></td>
			</tr>
	
	</table>
</form>
<?php

/*
$session = "http://35.186.157.60/chharohttp/extra/authenticate/";
$curl_session = curl_init();
curl_setopt_array($curl_session, array(
  CURLOPT_URL => $session,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_HTTPHEADER => array(
	"Cache-Control: no-cache",										
  ),
));
$tmpfname = 'cookie.txt';
curl_setopt($curl_session, CURLOPT_COOKIEJAR, $tmpfname);
curl_setopt($curl_session, CURLOPT_COOKIEFILE, $tmpfname);

$response1 = curl_exec($curl_session);
$err = curl_error($curl_session);
curl_close($curl_session);

$res = json_decode($response1);



$post = [
    'sessionId' => $res->sessionId,
    'orderId' => $response->getOrderId(),
    'transactionType'   => "Add Money",
	'customerId'   => $response->getAddField1(),
	'transactionId'   => $response->getPgMeTrnRefNo(),
	'responseCode'   => $response->getResponseCode(),
	'status'   => $response->getStatusCode(),
	'source'   => "Card",
	'note'   => $response->getStatusDesc(),
	'amount'   => $response->getTrnAmt()
];

$api = "http://35.186.157.60/chharohttp/checkout/transactionLog";
$ch = curl_init();
curl_setopt_array($ch, array(
  CURLOPT_URL => $api,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $post,
  CURLOPT_HTTPHEADER => array(
	"Cache-Control: no-cache",										
  ),
));
   // execute!
$tmpfname = 'cookie.txt';
curl_setopt($ch, CURLOPT_COOKIEJAR, $tmpfname);
curl_setopt($ch, CURLOPT_COOKIEFILE, $tmpfname);
$response2 = curl_exec($ch);


// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
$err2 = curl_error($ch);
curl_close($ch);
 



 
$myfile = fopen("otpfail.txt", "a+") or die("Unable to open file!");
		$txt = json_encode($response) . "-------" . $response2."\r\n";
		fwrite($myfile, $txt);
 		fclose($myfile);

print_r($returnArray);*/