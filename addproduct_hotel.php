<style>
.pointer {cursor: pointer;
}
#example1 tr:hover {
	background-color:#e0dacf;
}
</style>
<?php 
include_once('config.php') ;

if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  
   header('Location:index.php');
  
  }else{

	$fromDate  = '2017-01-01';
	$toDate= date('Y-m-d');
	$storeId = 1;
	$pageNumber = 1;
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => domain."/chharomphttp/marketplace/GetMySoldOrdersData",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"toDate\"\r\n\r\n".$toDate."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"fromDate\"\r\n\r\n".$fromDate."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"pageNumber\"\r\n\r\n".$pageNumber."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
	   //echo $response;
	   
	    $responseData = json_decode($response);
		if($responseData->error == 5){
			 $curUrl = $_SERVER['REQUEST_URI'];
   			 $redirPath = checkSessionId($curUrl);
    		header('Location: '.$redirPath);
		}
		//print_r($responseData);
		//echo '<pre>';
		 $totalCount = $responseData->totalCount;
		$orderList = $responseData->orderList;
		//print_r($orderList);
	}
  } // esle sessionId
  
  ?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form">
              <div class="box-body">
			  <div class="row">
				<div class="col-md-12">
				<div class="col-md-6">
				<div class="form-group">
                  <label>Sub Category</label>
                  <select class="form-control" id="subcat">
                    <option value="luxury">Luxury</option>
                    <option value="sluxury">Semi Luxury</option>
                    <option value="homestay">Home-Stay</option>
                  </select>
                </div>
                </div>
								
				<div class="col-md-6">
                <div class="form-group">
                  <label for="hotelname">Hotel name</label>
                  <input type="text" class="form-control" name="hotelname" id="hotelname" placeholder="Hotel name here">
                </div>
                </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="primarynumber">Primary number</label>
                  <input type="text" class="form-control" name="producttype" id="producttype" placeholder="Primary number here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="alternumber">Alternate number</label>
                  <input type="text" class="form-control" name="altertype" id="altertype" placeholder="Alternate number here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="dinesku">Sku Code</label>
                  <input type="text" class="form-control" name="dinesku" id="dinesku" placeholder="Sku here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="latitude">Location Latitude</label>
                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Location Latitude here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="longitude">Location Longitude</label>
                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Location Longitude here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="readdress">Address</label>
                  <input type="text" class="form-control" name="readdress" id="readdress" placeholder="Address here">
                </div>
				</div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="hrsoperation">Hours of Operation</label>
                  <input type="text" class="form-control" name="hrsoperation" id="hrsoperation" placeholder="Hours of Operation">
                </div>
				</div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Description here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="service">Service</label>
                  <input type="text" class="form-control" name="service" id="service" placeholder="Service here">
                </div>
				</div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="imageshotel">Add Images</label>
                  <input type="file" id="imageshotel">
                </div>
                </div>

				</div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-danger">Add Product</button>
              </div>
            </form>
          </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
$(function () {
 //Date picker
    $('#datepickerfrom').datepicker({
      autoclose: true
    })
	 $('#datepickerto').datepicker({
      autoclose: true
    })
})
</script>
 <script type="text/javascript">
 		/*$('#example1 tr').click(function(){
 			alert($(this).attr("#data-id1"));
		   var autoid =  $(this).data('id1'); //$(this).data('id'); //$(this).attr('id');
		    alert(autoid);
		    var status = $(this).data('status1'); //$(this).attr('status');
		    alert(status);
		});*/
 $(document).ready(function() {    
     
    $('#example1').on('click','tr',function(){
        var incid = $(this).data('incid'); // $(this).attr('id');
        var status = $(this).data('status'); // $(this).attr('id');
       //alert(incid);
       // alert(status);
        $.ajax({  
			  type: 'POST',
			  url: 'orederAjax.php',
			  data: {incid:incid,status:status  
			  },
			  /* beforeSend: function() {
					// setting a timeout
					$('#submitBtn').prop('disabled',true)
				},*/
			  success : (function(data) {
			  //	alert();
				  //console.log(data);
				    //var b=JSON.parse(data);
					//var status = b.status;
					 window.location.href = 'order.php';
					
			  }),
			  error : (function(){
				alert('Whoops! This didn\'t work. Please contact us.')
			  }),
			  
		});
    });
} );
 </script>
