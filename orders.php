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
    

          <div class="box">
            <div class="box-header">
              <h3 class="box-title text-red">Oreder </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"></div>
              <div class="col-sm-6">
                <div id="example1_filter" class="dataTables_filter"></div></div></div><div class="row"><div class="col-sm-12">
                <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">
                   Order # </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" style="width: 200px;">Product Name</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">Quality </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Status</th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Order Total </th>
                  

                </thead>
                <tbody> 
				<?php foreach($orderList as $order){ ?> 
                <tr role="row" class="odd pointer" data-incid="<?php echo $order->incrementId; ?>" data-status="<?php echo $order->status; ?>">
                  <td class="sorting_1 text-red" ><strong><?php echo $order->label; ?></strong></td>
                  <td><?php //print_r($order->orderList);
				  echo $order->orderList[0]->name;  // echo $order->orderList->name; ?> </td>
                  <td><?php echo $order->orderList[0]->qty; ?></td>
                  <td><?php echo $order->status; ?></td>
                  <td><?php //echo $order->orderTotal; 
                  $prices = explode(':',$order->orderTotal);
                  //print_r($prices);
                  echo $prices['1'];

                  ?></td>
                  
                </tr>
				<?php } ?>
				
				
               
                



              </tbody>
               
              </table></div></div>
			  
			 <!--  <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div>
			  
			  <div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div>
			  
			  </div> -->
			  
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
			  url: 'orderAjax.php',
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
