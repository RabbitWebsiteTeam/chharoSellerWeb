<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
	/**
	 * This Is the Kit File To Be Included For Transaction Request
	 */
	// echo 'here';  exit;
	include '../PHP_WLIPG/Standard/AWLMEAPI.php';
	
	
	
	//create an Object of the above included class
	$obj = new AWLMEAPI();
	//print_r($obj); exit;	
	//create an object of Request Message
	$reqMsgDTO = new ReqMsgDTO();

	$currency = $_GET['currency'];
	$quoteId = $_GET['quoteId'];
	$customerId = $_GET['customerId'];
	$amountinrupees = round($_GET['amount'], 2, PHP_ROUND_HALF_UP);
	$amountinpaise = $amountinrupees *100;
		/*
		
		$mid = "WL0000000006860";
		$enckey = "a75ff45c55195be55d1f8f02d00bd2ba";
		$currencyName = "INR";
		$responseurl = "http://35.187.232.245/PHP_WLIPG/Standard/meTrnSuccessINR.php";
		
		*/
	
	$mid =0;
	if($currency == 'inr')
	{
	
		$mid = "WL0000000006860";
		$enckey = "a75ff45c55195be55d1f8f02d00bd2ba";
		$currencyName = "INR";
		$responseurl = domain."meTrnSuccessINR.php";
	}
	else
	{
		//Adding Indian Details till conversion rates come through
		$mid = "WL0000000006860";
		$enckey = "a75ff45c55195be55d1f8f02d00bd2ba";
		$currencyName = "INR";
		$responseurl = domain."meTrnSuccessINR.php";
		
		/*********************************
		//Commenting below USD Gateway details
		$mid = "WL0000000006870";
		$enckey = "3cadfa01c6e796f1977702e07431f321";
		$currencyName = "USD";
		$responseurl = "https://chharouat.bob.bt/PHP_WLIPG/Standard/meTrnSuccessUSD.php";
		********************************/
	}
	
	
	// PG MID INR
	$reqMsgDTO->setMid($mid);
	
	// Merchant Unique order id
	$reqMsgDTO->setOrderId($quoteId);
	
	//Transaction amount in paisa format
	$reqMsgDTO->setTrnAmt($amountinpaise);
	
	//Transaction remarks
	$reqMsgDTO->setTrnRemarks("This txn has to be done ");
	
	// Merchant transaction type (S/P/R)
	$reqMsgDTO->setMeTransReqType("S");
	
	// Merchant encryption key:
	$reqMsgDTO->setEnckey($enckey);
	
	// Merchant transaction currency
	$reqMsgDTO->setTrnCurrency($currencyName);
	
	// Recurring period, if merchant transaction type is R
	$reqMsgDTO->setRecurrPeriod("NA");
	// Recurring day, if merchant transaction type is R
	$reqMsgDTO->setRecurrDay("NA");
	// No of recurring, if merchant transaction type is R
	$reqMsgDTO->setNoOfRecurring("NA");
	// Merchant response URl
	$reqMsgDTO->setResponseUrl($responseurl);
	// Optional additional fields for merchant
	$reqMsgDTO->setAddField1($customerId);
	$reqMsgDTO->setAddField2($_REQUEST['addField2']);
	$reqMsgDTO->setAddField3($_REQUEST['addField3']);
	$reqMsgDTO->setAddField4($_REQUEST['addField4']);
	$reqMsgDTO->setAddField5($_REQUEST['addField5']);
	$reqMsgDTO->setAddField6($_REQUEST['addField6']);
	$reqMsgDTO->setAddField7($_REQUEST['addField7']);
	$reqMsgDTO->setAddField8($_REQUEST['addField8']); 
	
	/* 
	 * After Making Request Message Send It To Generate Request 
	 * The variable `$urlParameter` contains encrypted request message
	 */
	 //Generate transaction request message
	 
	 
	$merchantRequest = "";
	
	$reqMsgDTO = $obj->generateTrnReqMsg($reqMsgDTO);
	
	if ($reqMsgDTO->getStatusDesc() == "Success"){
		$merchantRequest = $reqMsgDTO->getReqMsg();
	}
	
	$myfile = fopen("otp23.txt", "a+") or die("Unable to open file!");
		$txt = $customerId . "-------" . $quoteId."\r\n";
		fwrite($myfile, $txt);
 		fclose($myfile);
?>


<form action="https://ipg.in.worldline.com/doMEPayRequest" method="post" name="txnSubmitFrm">
	<h4 align="center">Redirecting To Payment Please Wait..</h4>
	<h4 align="center">Please Do Not Press Back Button OR Refresh Page</h4>
	<input type="hidden" size="200" name="merchantRequest" id="merchantRequest" value="<?php echo $merchantRequest; ?>"  />
	<input type="hidden" name="MID" id="MID" value="<?php echo $reqMsgDTO->getMid(); ?>"/>
</form>
<script  type="text/javascript">
	//submit the form to the worldline
	 document.txnSubmitFrm.submit();
</script>

