<?php 
include_once('config.php') ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  

   header('Location:index.php');
  
  }else{
  	// get customer informaton 
      $profilePic = '';

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => domain."chharohttp/customer/getaccountinfoData",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
		  name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
		  name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
		  name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
		 // echo $response2;
		  $data2 = json_decode($response2);
		//  print_r($data2);
		  $mobileNo = $data2->mobileNo;
		  $email = $data2->email;
		  $profilePic = $data2->profilePic;

		  if($profilePic == '' || empty($profilePic)){
		  	$profilePic = 'logo.png';
		  }

		}

  	//check default address is ser or not 
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "http://35.186.157.60/chharohttp/customer/getaddrbookData",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			  name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			  name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
			  name=\"sellerId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
			} else
			{
			  // echo $response;
			  $data = json_decode($response);
			  
			  if(isset($data->error))
              {
               if($data->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }
              $customerName = $_SESSION['customerName'];
			  $billingAddress =  $data->billingAddress;
			  $shippingAddress  =  $data->shippingAddress;
			   $billingAddressValue = $billingAddress->value;
			   $billingAddressId = $billingAddress->id;
			   $shippingAddressValue = $shippingAddress->value;
			   $shippingAddressId = $shippingAddress->id;
			  if(!empty($shippingAddressId)){

			  	// call accept			  	

					$curl = curl_init();

					curl_setopt_array($curl, array(
					  CURLOPT_URL => "http://35.186.157.60/chharohttp/wallet/accept",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 30,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "POST",
					  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					  name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
					  name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
					  echo "cURL Error #:" . $err;
					} else {
					  
					 // echo '<pre>';
					    $data1 = json_decode($response1);
					   // print_r($data1);
					   // print_r($_SESSION);
					  //  exit;
			  

					}

			  }
			  else{

			  	 $errAddress ='Please check your address.';

			  }


			}

		// end //check default address is ser or not 	
  }
  ?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="id="donotprintdiv"">

	  <section class="content-header">
	      <h1>
	     Accept Money   <input type="button" class="btn btn-danger btn-flat " onclick="PrintDiv();" value="PRINT" />
		
	      </h1> 		        
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">Accept Money </a></li>
	        
	      </ol>
	    </section>
	    <section class="content">
	     	<div class="row" id='printablediv'>
	     		<?php if(isset($errAddress) && $errAddress ==''){ ?>
	     		<div class="col-md-6">
	     			<?php echo $errAddress; ?>
	     		</div>
	     		<?php }else {?>
	     		<div class="col-md-2">
	     		</div>
		        <div class="col-md-8" style="text-align:center;">
		          <!-- Widget: user widget style 1 -->
		          
		          <div class="box box-danger" >
		                <div class="box-header with-border">
		                	<div class="col-md-6">
		                	 <img src="logo.png" class="user-image" alt="User Image" style='width: 50%;'>	
		                	</div>
		                	<div class="col-md-6">
		                		<?php 
		                		  echo "<h1>To Pay - $customerName</h1>";
						   		 echo "<h3>Scan this Chharo code</h3>";
						   		 ?>
						    
						
		                	</div>
		                	 <?php 

		                		//echo $billingAddressValue = $billingAddress->value;
			                 	// print_r($data1);
			                	 
			           			 $qrcode = $data1->qrcode;
			           			$mobileno = $data1->mobileno;
			           		 ?>
		                </div>
		           
		                 <?php
    
						  
						    include "phpqrcode/qrlib.php";    
						  	// qr codes folder 
						  	$qrcodesFolder = 'qrcodes';
							if (!file_exists($qrcodesFolder)) {
							    mkdir($qrcodesFolder, 0777, true);
							}
						    $filepath = $qrcodesFolder.'/'.$mobileno.'_qrcode.png';
							// Image (logo) to be drawn
							$logopath = $profilePic;
							// qr code content
							$codeContents = $qrcode;
							// Create the file in the providen path
							// Customize how you want
							
							QRcode::png($codeContents,$filepath , QR_ECLEVEL_H, 20);

							// Start DRAWING LOGO IN QRCODE

							$QR = imagecreatefrompng($filepath);

							// START TO DRAW THE IMAGE ON THE QR CODE
							$logo = imagecreatefromstring(file_get_contents($logopath));

							/**
							 *  Fix for the transparent background
							 */
							imagecolortransparent($logo , imagecolorallocatealpha($logo , 0, 0, 0, 127));
							imagealphablending($logo , false);
							imagesavealpha($logo , true);

							$QR_width = imagesx($QR);
							$QR_height = imagesy($QR);

							$logo_width = imagesx($logo);
							$logo_height = imagesy($logo);

							// Scale logo to fit in the QR Code
							$logo_qr_width = $QR_width/6;
							$scale = $logo_width/$logo_qr_width;
							$logo_qr_height = $logo_height/$scale;

							imagecopyresampled($QR, $logo, $QR_width/2.5, $QR_height/2.5, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

							// Save QR code again, but with logo on it
							imagepng($QR,$filepath);

							// End DRAWING LOGO IN QR CODE

							// Ouput image in the browser
							echo '<img src="'.$filepath.'" style="width: 60%;" />'; 
						        
						  

						    ?> 
	
				            
				        
				            <div class="box-footer">

				            <span class="users-list-date">OR <br> Enter phone number</span>
				              <h1> <?php echo $mobileno; ?></h1>
				            </div>
				            <!-- /.box-footer -->
				          </div>
		               
		                <!-- /.box-footer -->
		              </div>

		          <div class="box box-widget widget-user-2">

		          </div>
		          <!-- /.widget-user -->
		        </div>
		        <div class="col-md-2">
		        </div>	
		        <!-- /.col -->
		       
		       <?php } ?>
		        <!-- /.col -->


		           <!-- <div class="row no-print">
			        <div class="col-xs-8">
			        	<input type="button" class="btn btn-block btn-danger btn-flat " onclick="PrintDiv();" value="PRINT" />
			        
			        </div>
			      </div> -->
		      </div>

		   
	      <!-- /.error-page -->
	    </section>
	  
     <script type="text/javascript">
        function PrintDiv() {
            var contents = document.getElementById("printablediv").innerHTML;
            var frame1 = document.createElement('iframe');
            frame1.name = "frame1";
            frame1.style.position = "absolute";
            frame1.style.top = "-1000000px";
            document.body.appendChild(frame1);
            var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
            frameDoc.document.open();         
            frameDoc.document.write('</head><body>');
            frameDoc.document.write(contents);
            frameDoc.document.write('</body></html>');
            frameDoc.document.close();
            setTimeout(function () {
                window.frames["frame1"].focus();
                window.frames["frame1"].print();
                document.body.removeChild(frame1);
            }, 500);
            return false;
        }
    </script>
	</div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>

 
    

