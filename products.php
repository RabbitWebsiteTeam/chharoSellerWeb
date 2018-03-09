<?php include_once('config.php') ;
if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  
   header('Location:index.php');
} else{
  


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => domain."chharohttp/customer/ViewProducts",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
        name=\"sellerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
				if($responseData->error == 5){
				 
         $curUrl = $_SERVER['REQUEST_URI'];
         $redirPath = checkSessionId($curUrl);
         header('Location: '.$redirPath);

				}else{
					$productsData =  $responseData->data;
         // echo '<pre>';
					///print_r($productsData);
				}
				
			}
	
  }
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
              <h3 class="box-title text-red">Products </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"></div>
              <div class="col-sm-6">
                <div id="example1_filter" class="dataTables_filter"></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                <thead>
                <tr role="row">
                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending" style="width: 182px;">
                  Image </th>
				           <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" style="width: 156px;">Name</th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" style="width: 199px;">Quantity </th>
                  
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">Price </th>
                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" style="width: 112px;">View</th></tr>

                </thead>
                <tbody> 
                <?php if(!empty($productsData)) { foreach($productsData as $product) {?>
				        <tr role="row" class="odd">
                    <td class="sorting_1 text-red">
                      <?php 
                     /* $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' 
                          || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
                         $curUrl = $_SERVER['REQUEST_URI'];
                        $basePath = $protocol.$_SERVER['HTTP_HOST'].'/'.$_SERVER['SERVER_NAME'];
                        */

                       $path1 = domain.productImgPath.$product->small_image;
                        // $path2 = $basePath.'/dist/img/default.png';

                     //file_exists($path1) ? $path1 : $path2;
                       ?>
                      <img src="<?php echo $path1;?>"  class="user-image" style="max-height: 50px;" alt="Product Image">
                    
                  </td>
  				   
                    <td><?php echo $product->name;?> </td>
                    <td><?php echo $product->quantity_and_stock_status->qty;?>   </td>
                  
                    <td><?php echo number_format((float)$product->price, 2, '.', '');  
                    //echo $product->price;
                    ?></td>
                    <td>  <a href="#" id="<?php echo $product->entity_id;?>" class="label label-danger proId">Edit </a>  
                     
                    </td>
                </tr>
				<?php } } ?>
				
                 
                



              </tbody>
               
              </table>

            </div>
          </div>

         <!--  <div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div>
              <div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                <ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li>
              <li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li>
              <li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li>
              <li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div>
 -->
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
$('.proId').click(function (e) {
    e.preventDefault();
    var productId = this.id;  // get the button id here
    //alert(productId);         // you can also check it using alert
    $.ajax({  
        type: 'POST',
        url: 'productsAjax.php',
        data: {productId:productId},
        /* beforeSend: function() {
          // setting a timeout
          $('#submitBtn').prop('disabled',true)
        },*/
        success : (function(data) {
        //  alert();
          //console.log(data);
            //var b=JSON.parse(data);
          //var status = b.status;
           window.location.href = 'productEdit.php';
          
        }),
        error : (function(){
        alert('Whoops! This didn\'t work. Please contact us.')
        }),
        
    });
    // Your code goes here...
});
 </script>