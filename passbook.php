<?php
include_once('config.php') ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  

   header('Location:index.php');
  
  }else{
  	//print_r($_SESSION);
  		//check t-pin existig or not
  		if(empty($_SESSION['new-tpin']) || !isset($_SESSION['new-tpin'])){

  			//header('Location:checkTPin.php');
  		}

  		
  		// .. /chharohttp/wallet/balance

  		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => domain."chharohttp/wallet/balance",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		   name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
		  name=\"senderId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;",

		  /*  name=\"username\"\r\n\r\n".$_SESSION['username']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
		   name=\"password \"\r\n\r\n".$_SESSION['sesPpassword']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		*/
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
		$walletBalance = 0;
		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			//echo $response1;
			 $responseData1 = json_decode($response1);
			// echo $responseData1->balance;
			//echo round_to_2dp($responseData1->balance);
			  $walletBalance= number_format((float)$responseData1->balance, 2, '.', '');
		}

  	/*	if(isset($_SESSION[$psDate])){
  			$sDate = date("Y-m-d",strtotime($_SESSION[$psDate]));
  		}else{
  			$sDate = date("Y-m-d",strtotime("-1 month"));
  		}
  		if(isset($_SESSION[$peDate])){
  			$eDate = date("Y-m-d",strtotime($_SESSION[$peDate]));
  		}else{
  			$eDate = date('Y-m-d');
  		}*/
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
  		

} // main else

?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content" style="min-height:100px;"> 

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Wallet Balance</span>
              <span class="info-box-number" id='todayInc'><?php if(isset($walletBalance)) { echo 'Nu. '.$walletBalance;} ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-bank"></i></span>
            <a href="#">
	            <div class="info-box-content">
	              <span class="info-box-text">Send Money to Bank</span>
	             
	            </div>
       		 </a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
            <a href="#">
	            <div class="info-box-content">
	              <span class="info-box-text">Add money to wallet</span>
	              
	            </div> 
        	</a>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
       
      </div>
    
     </section>


     <section class="content">

      <div class="row">
       
        <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom" >
            <ul class="nav nav-tabs" id="tabs">
              <li class="active"><a href="#all" data-toggle="tab">All</a></li>
              <li><a href="#paid" data-toggle="tab">Paid</a></li>
              <li><a href="#received" data-toggle="tab">Received</a></li>
              <li><a href="#add-withdraw" data-toggle="tab">Add/Withdraw</a></li>
              
            </ul>
            <div class="tab-content">
            	<form >
            		  <div class="row">
	            		<div class="col-md-3">
			                <div class="form-group">
			                 
			                  <input type="date" class="form-control" name="sDate" id="sDate" placeholder="Start Date" required>
			                </div>
			            </div>
			            <div class="col-md-3">
			                <div class="form-group">
			                 
			                  <input type="date" class="form-control" name="eDate" id="eDate" placeholder="End Date" required>
			                </div>
			            </div>
			            <div class="col-md-3">
				           <div class="form-group">				            
			                <button type="submit" id="submitFilter"class="btn btn-danger">Filter</button>
			              </div>
			             </div>

			              
			           </div>
            	</form>
            	<span class="bg-red">
                     <?php echo $sDate.' to '.$eDate; ?>
                 </span> 


              <div class="active tab-pane" id="all">
                <!-- Post -->
               
                  <button onclick="exportAllTable('passbook_all.csv')" class="pull-right text-red"> <i class="fa fa-download text-red"> </i> Export CSV </button>
               
            	 <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                
				  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Transaction Type</th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">To </th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Amount </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Note </th>

                </thead>
                <tbody> 
                <?php 
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
						   //print_r($responseAll);

					  
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
					}
				$i=1;
				 if(count($walletData) > 0) { foreach($walletData as $walletData1) {?>

				        <tr role="row" class="odd">
                   
                    <td><?php if($walletData1->action == 'debit') { $sign = '-Nu. ';}else{ $sign = '+Nu. ';}  echo $walletData1->action;?> </td>
                    <td><?php if(isset($walletData1->sender_name)){echo $walletData1->sender_name;}else{ echo 'N/A';}?>   </td>
                  
                    <td><?php //echo round($walletData1->amount,2); echo '<br>';
                    echo $sign.number_format((float)$walletData1->amount, 2, '.', ''); ?></td>
                    <td><?php echo $walletData1->transaction_at;?></td>
                    <td><?php echo $walletData1->transaction_note; ?></td>
                    
                </tr>
				<?php $i++;} }else{ ?>
				<td><?php echo "Transactions not available."; ?></td>
				<?php } ?>
                 
                



              </tbody>
               
              </table>

               
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="paid">
           
                <!-- Post -->
                  <button onclick="exportPaidTable('passbook_paid.csv')" class="pull-right text-red"> <i class="fa fa-download text-red"> </i> Export CSV </button>
            	 <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		                <thead>
		                <tr role="row">
		                
						  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Transaction Type</th>
		                  
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">To </th>
		                  
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Amount </th>
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Date</th>
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Note </th>

		                </thead>
		                <tbody> 
		            		<?php 
                //print_r($_SESSION);
                	$type = 'wwdebit';
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

					 $response2 = curl_exec($curl);
					$err = curl_error($curl);

					curl_close($curl);

					if ($err) {
					  echo "cURL Error #:" . $err;
					} else {
					 //echo '<pre>';
						   $responseAll2 = json_decode($response2);
							   //print_r($responseAll);

						  
							  if(isset($responseAll2->error))
							  {
								 if($responseAll2->error == 5){

									 $curUrl = $_SERVER['REQUEST_URI'];
						             $redirPath = checkSessionId($curUrl); //exit;
						            header('Location: '.$redirPath);

								 }
							  }
							 if(!empty($responseAll2)){

						    	$walletData2 = $responseAll2->walletData;
						    }
						}
					
					 if(count($walletData2) > 0) { foreach($walletData2 as $walletData1) {?>

					        <tr role="row" class="odd">
	                   
	                    <td><?php if($walletData1->action == 'debit') { $sign = '-Nu. ';}else{ $sign = '+Nu. ';}  echo $walletData1->action;?> </td>
	                    <td><?php if(isset($walletData1->sender_name)){echo $walletData1->sender_name;}else{ echo 'N/A';}?>   </td>
	                  
	                    <td><?php echo $sign.number_format((float)$walletData1->amount, 2, '.', '');  ?></td>
	                    <td><?php echo $walletData1->transaction_at;?></td>
	                    <td><?php echo $walletData1->transaction_note; ?></td>
	                    
	                </tr>
					<?php } }else{?>

						<td><?php echo "Transactions not available."; ?></td>
					<?php } ?>
					
		                



		              </tbody>
		               
		              </table>
                
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="received">
                <!-- Post -->
                  <button onclick="exportReceivedTable('passbook_received.csv')" class="pull-right text-red"> <i class="fa fa-download text-red"> </i> Export CSV </button>
            	 <table id="example3" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                
				  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Transaction Type</th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">From </th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Amount </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Date</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Note </th>

                </thead>
                <tbody> 
	              	<?php 
                //print_r($_SESSION);
                	$type = 'wwcredit';
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
						   //print_r($responseAll);

					  
						  if(isset($responseAll->error))
						  {
							 if($responseAll->error == 5){

								 $curUrl = $_SERVER['REQUEST_URI'];
					             $redirPath = checkSessionId($curUrl); //exit;
					            header('Location: '.$redirPath);

							 }
						  }
						 if(!empty($responseAll)){

					    	$walletData3 = $responseAll->walletData;
					    }
					}
				
				 if(count($walletData3) > 0) { foreach($walletData3 as $walletData1) {?>

				        <tr role="row" class="odd">
                   
                    <td><?php if($walletData1->action == 'debit') { $sign = '-Nu. ';}else{ $sign = '+Nu. ';}  echo $walletData1->action;?> </td>
                    <td><?php if(isset($walletData1->sender_name)){echo $walletData1->sender_name;}else{ echo 'N/A';}?>   </td>
                  
                    <td><?php echo $sign.number_format((float)$walletData1->amount, 2, '.', '');  ?></td>
                    <td><?php echo $walletData1->transaction_at;?></td>
                    <td><?php echo $walletData1->transaction_note; ?></td>
                    
                </tr>
				<?php } }else{?>
					<td><?php echo "Transactions not available."; ?></td>
				<?php } ?>
				


              </tbody>
               
              </table>
				
              </div>
               <div class="tab-pane" id="add-withdraw">
                		<!-- Post -->
                		   <button onclick="exportAddWithdrawTable('Passbook-AddWithdraw.csv')" class="pull-right text-red"> <i class="fa fa-download text-red"> </i> Export CSV </button>
		            	 <table id="example4" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
		                <thead>
		                <tr role="row">
		                
						  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Transaction Type</th>
		                  
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">To</th>
		                  
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Amount</th>
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Date</th>
		                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Note </th>

		                </thead>
		                <tbody> 
		            			<?php 
                //print_r($_SESSION);
                	$type = 'ewcreditdebit';
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
						   //print_r($responseAll);

					  
						  if(isset($responseAll->error))
						  {
							 if($responseAll->error == 5){

								 $curUrl = $_SERVER['REQUEST_URI'];
					             $redirPath = checkSessionId($curUrl); //exit;
					            header('Location: '.$redirPath);

							 }
						  }
						  
						 if(!empty($responseAll)){

					    	$walletData4 = $responseAll->walletData;
					    }
					    
					}
				//	echo count($walletData4);
				if(count($walletData4) > 0) {

				 foreach($walletData4 as $walletData1) {?>

				        <tr role="row" class="odd">
                   
                    <td><?php if($walletData1->action == 'debit') { $sign = '-Nu. ';}else{ $sign = '+Nu. ';} 
                    echo $walletData1->action;?> </td>
                    <td><?php if(isset($walletData1->sender_name)){echo $walletData1->sender_name;}else{ echo 'N/A';}?>   </td>
                  
                    <td><?php echo $sign.number_format((float)$walletData1->amount, 2, '.', ''); ?></td>
                    <td><?php echo $walletData1->transaction_at;?></td>
                    <td><?php echo $walletData1->transaction_note; ?></td>
                    
                </tr>
				<?php  }

				 }else{ ?>

					<td><?php echo "Transactions not available."; ?></td>
				<?php } ?>
				


		              </tbody>
		               
		              </table>
				
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->

          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>

 <script>
function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV file
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    //downloadLink = document.createElement("a");
    //example3
    downloadLink = document.createElement("a");
    // File name
    downloadLink.download = filename;

    // Create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Hide download link
    downloadLink.style.display = "none";

    // Add the link to DOM
    document.body.appendChild(downloadLink);

    // Click download link
    downloadLink.click();
}

function exportAllTable(filename) {
    var csv = [];
	var rows = document.querySelectorAll("#all table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
function exportPaidTable(filename) {
    var csv = [];
	var rows = document.querySelectorAll("#paid table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}


function exportReceivedTable(filename) {
    var csv = [];
	var rows = document.querySelectorAll("#received table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}
function exportAddWithdrawTable(filename) {
    var csv = [];
	var rows = document.querySelectorAll("#add-withdraw table tr");
	
    for (var i = 0; i < rows.length; i++) {
		var row = [], cols = rows[i].querySelectorAll("td, th");
		
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
		csv.push(row.join(","));		
	}

    // Download CSV file
    downloadCSV(csv.join("\n"), filename);
}

</script>

