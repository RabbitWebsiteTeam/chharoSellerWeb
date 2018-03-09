<?php 
include_once('config.php') ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId']) || empty($_SESSION['status']) ){
  // $_SESSION['sessionId'] = $resData->sessionId;  

   header('Location:index.php');
  
  }else{
  	//echo $_SESSION['status'];
	//	print_r($_SESSION);
	$incrementId = $_SESSION['incid'];
	if(empty($incrementId)){
		 header('Location:orders.php');
	}
	$storeId  = 1;//$_SESSION['storId']
	$customerId = $_SESSION['customerId'];
	$incrementId = $_SESSION['incid'];
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => domain."/chharomphttp/marketplace/GetOrderDetails",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
	   name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"customerId\"\r\n\r\n".$customerId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"incrementId\"\r\n\r\n".$incrementId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
	// echo $response;
	 
	   $responseData = json_decode($response);
	 // print_r($responseData);
	  if(isset($responseData->error))
	  {
		 if($responseData->error == 5){
			$curUrl = $_SERVER['REQUEST_URI'];
            $redirPath = checkSessionId($curUrl);
            header('Location: '.$redirPath);

		 }
	  }else{

		  

		$success = $responseData->success; 

		//cancelOrderAction
		if(isset($responseData->cancelOrderAction)){
			 $cancelOrderWarning  = $responseData->cancelOrderWarning;
		}else{
			$cancelOrderWarning = '';
		}
		//invoiceWarning
		if(isset($responseData->invoiceAction)){
				 $invoiceWarning  = $responseData->invoiceWarning;
		}else{
			$invoiceWarning = '';
		}

		//sendmailAction
		if(isset($responseData->sendmailAction)){
			$sendmailAction  = $responseData->sendmailAction;
		}else{
			$sendmailAction = '';
		}


	  //echo $responseData['mainHeading'];
	 
		  
		$mainHeading = $responseData->mainHeading;
		
		
		$subHeading = $responseData->subHeading;	
		$orderDateTitle = $responseData->orderDateTitle;
		
		
		$orderDateValue = $responseData->orderDateValue;
		$buyerData = $responseData->buyerData;
	  }
		
	}

  }?>
  
  
  
  
  
  
  
  
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

 <section class="content-header">
      <h1>      
        <big class="text-red"> <?php echo $subHeading; ?> </big> 
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
       
        <li class="active">Ship & Invoice</li>
      </ol>
    </section>

    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa  fa-ship"></i> Ship & Invoice.
            <small class="pull-right">Order Date: <?php echo $orderDateValue; ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
	  
        <div class="col-sm-4 invoice-col">
         <strong class="text-red">  <?php echo $buyerData->title; ?> </strong>
          <address>
           <?php echo $buyerData->name; ?>
           <!--  795 Folsom Ave, Suite 600<br>
            San Francisco, CA 94107<br>
            Phone: (804) 123-5432<br>
            Email: info@almasaeedstudio.com -->
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
         <strong class="text-red">  <?php if (isset($responseData->shippingAddressData)){ 
         	$shippingAddressData = $responseData->shippingAddressData; echo $shippingAddressData->title;}else{ echo 'N/A';} ?>  </strong>
          <address>
		 <?php if(isset($shippingAddressData->address)) { $address= $shippingAddressData->address;
			foreach ($address as $key => $val) {
			   echo $val.'<br>';
			}
		}else{echo 'N/A';}
			?>
          
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b class="text-red"><?php $billingAddressData= $responseData->billingAddressData; echo $billingAddressData->title; ?></b><br>
         
           <address>
           <?php  $address= $billingAddressData->address;
			foreach ($address as $key => $val) {
			   echo $val.'<br>';
			}
			?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

     

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
              
              <strong class="text-red"><?php $paymentMethodData= $responseData->paymentMethodData; echo $paymentMethodData->title; ?>  : </strong> <?php  echo $paymentMethodData->method;  ?>
              <br>
            <strong class="text-red"> <?php $items= $responseData->items; ?>  ITEM ORDERED </strong>
            <br>
          <?php echo $items[0]->productName; ?>  <br>
            PRICE : <?php echo $items[0]->price; ?><br>
            QUANTITY : <?php  $qty = $items[0]->qty; 
			//print_r($qty); 
			foreach ($qty as $key => $val) {
			   echo $key .' : '.$val.'<br>';
			}
			 $Ordered = $qty->Ordered;
			 $Invoiced = $qty->Invoiced;
			 $Shipped = $qty->Shipped;
			 $Canceled = $qty->Refunded;
			 
			
		
			?>  <br>
			
		
           
           
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
         

          <div class="table-responsive">
            <table class="table">
				<?php $subtotal= $responseData->subtotal; ?>
              <tbody><tr>
			  
                <th style="width:50%"> <?php echo $subtotal->title ?> : </th>
                <td><?php echo $subtotal->value; ?></td> 
              </tr>
              <tr>
                <th> <?php $shipping= $responseData->shipping;  echo $shipping->title ?> : </th>
                <td><?php  echo $shipping->value ?> </td>
              </tr>
              
              <tr>
                <th> <?php $totalOrderedAmount= $responseData->totalOrderedAmount;  echo $totalOrderedAmount->title ?>  : </th>
                <td><?php echo $totalOrderedAmount->value ?> </td>
              </tr>
            </tbody></table>
          </div>
        </div>
        <!-- /.col -->
      </div>
	  <?php
	 // echo $_SESSION['status'];
	   if($_SESSION['status'] == 'ORDER PLACED'){
				 $invoiceAction = $responseData->invoiceAction;
				$invoiceWarning = $responseData->invoiceWarning;
				$shipAction = $responseData->shipAction;
				$shipWarning = $responseData->shipWarning;
				$cancelOrderAction = $responseData->cancelOrderAction;
				$cancelOrderWarning = $responseData->cancelOrderWarning;
				$sendmailAction = $responseData->sendmailAction;
				$sendmailWarning = $responseData->sendmailWarning;
			 ?>
      <!-- /.row -->
		<div class="row no-print">
        <div class="col-xs-12">
         
          <button type="button" id="acceptOrderBtn" class="btn btn-success pull-right" ince><i class="fa fa-clone"></i> Accept Order
          </button>
          <button type="button" id="cancelOrderBtn" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-clone"></i> Cancel Order
          </button>
        </div>
        <div class="col-xs-12 text-red" id="errRes">
        
        </div>
          <div class="col-xs-12 text-green" id="sucRes">
        
        </div>
      </div>
	  
	   <?php }else if( ($_SESSION['status'] == 'ORDER ACCEPTED') || ($_SESSION['status'] =='ORDER_ACCEPT')){

	   		//echo $_SESSION['status'] ; ?>
	   	<div class="row no-print">
        <div class="col-xs-12">
       
          <button type="button" id="shipInvoiceOrderBtn" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-clone"></i>Ship & Invoice
          </button>
        </div>
        <div class="col-xs-12 text-red" id="errRes">
        
        </div>
          <div class="col-xs-12 text-green" id="sucRes">
        
        </div>
      </div>
	  <?php  }else if ($_SESSION['status'] == 'ORDER DELIVERED'){ ?>
	  		<div class="row no-print">
		        <div class="col-xs-12">
		       
		          <button type="button" id="deleveredOrderBtn" class="btn btn-danger pull-right" style="margin-right: 5px;">
		            <i class="fa fa-clone"></i>ORDER DELIVERED
		          </button>
		        </div>
		        <div class="col-xs-12 text-red" id="errRes">
		        
		        </div>
		          <div class="col-xs-12 text-green" id="sucRes">
		        
		        </div>
		  </div>
	  <?php }
	  elseif ($_SESSION['status'] =='ORDER SHIPPED BY SELLER') { ?>
	  <?php // echo 'hhhhh'; toDo :: write oreder delevered condition here ?>
	  <?php } ?>
   
    </section>
       <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>
 <script type="text/javascript">
 		
 $(document).ready(function() {    
     	 var incid = "<?php echo $_SESSION['incid'];?>"; // $(this).attr('id');
     	 var customerId = "<?php echo $_SESSION['customerId'];?>";
     	 //alert(incid);
   		$('#cancelOrderBtn').on('click',function(){
       // var incid = $(this).data('incid'); // $(this).attr('id');
	       var cancelOrderWarning = "<?php echo $cancelOrderWarning;?>";
	       var r = confirm(cancelOrderWarning);
		    if (r == true) {
		       // txt = "You pressed OK!";
		        $.ajax({  
					  type: 'POST',
					  url: 'orderCancel.php',
					  data: { incid:incid,customerId:customerId },				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								$("#sucRes").html(b.message);
								alert(b.message);
								window.location.href = 'orders.php';
							}else{

								$("#errRes").html(b.message);
							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

		    } else {
		       // txt = "You pressed Cancel!";
		        alert('Your order not Canceled');

		    }

	    }); // end cancel   		

   		$('#acceptOrderBtn').on('click',function(){
       // var incid = $(this).data('incid'); // $(this).attr('id');
	       var acceptOrderWarning = "Are you sure you want to accept this order?";
	       var r = confirm(acceptOrderWarning);
		    if (r == true) {
		       // txt = "You pressed OK!";
		        $.ajax({  
					  type: 'POST',
					  url: 'orderAccept.php',
					  data: { incid:incid,customerId:customerId },				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								$("#sucRes").html(b.message);
								alert(b.message);
								window.location.href = 'orders.php';
							}else{

								$("#errRes").html(b.message);
							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

		    } else {
		       // txt = "You pressed Cancel!";
		        alert('Your order not Canceled');

		    }

	    }); // end accept


   		$('#shipInvoiceOrderBtn').on('click',function(){
       // var incid = $(this).data('incid'); // $(this).attr('id');
	       var shipInvoiceOrderWarning = "Are you sure you want to Ship&Invoice this order?";
	       var r = confirm(shipInvoiceOrderWarning);
		    if (r == true) {
		       // txt = "You pressed OK!";
		        $.ajax({  
					  type: 'POST',
					  url: 'orderShipInvoice.php',
					  data: { incid:incid,customerId:customerId },				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								$("#sucRes").html(b.message);
								alert(b.message);
								window.location.href = 'orders.php';
							}else{

								$("#errRes").html(b.message);
							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

		    } else {
		       // txt = "You pressed Cancel!";
		        alert('Your order not Canceled');

		    }

	    }); // end ship & invoice

   		$('#deleveredOrderBtn').on('click',function(){
       // var incid = $(this).data('incid'); // $(this).attr('id');
	       var deliveredOrderWarning = "Are you sure you want to delivered this order?";
	       var r = confirm(deliveredOrderWarning);
		    if (r == true) {
		       // txt = "You pressed OK!";
		        $.ajax({  
					  type: 'POST',
					  url: 'orderDelivered.php',
					  data: { incid:incid,customerId:customerId },				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								$("#sucRes").html(b.message);
								alert(b.message);
								window.location.href = 'orders.php';
							}else{

								$("#errRes").html(b.message);
							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

		    } else {
		       // txt = "You pressed Cancel!";
		        alert('Your order not Canceled');

		    }

	    }); // end ship & invoice



} );
 </script>
