<style>
.pointer {cursor: pointer;
}
#example1 tr:hover {
	background-color:#e0dacf;
}

.error{
  color:red !important;
}
</style>
  <style>
     /* loading */
#loading{
    width: 100%;
    z-index: 999;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
   
}
 </style>
<?php 
include_once('config.php');

if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  
   header('Location:index.php');
  
  }else{

       $sessionId = $_POST['SessionChharo']; 
       $customerId = $_POST['customerId'];
       $rootId = 279;
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => domain."chharohttp/catalog/getcategoryListTREE",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
           name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
          name=\"rootId\"\r\n\r\n".$rootId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
          name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
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
         //echo  $response;
          $ctData = json_decode($response);
            if(isset($ctData->error))
              {
               if($ctData->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }
              //echo '<pre>';
              $categories = $ctData->categories;
              $children_data = $ctData->children_data;
             // echo count($children_data);
              // print_r($categories);
              // echo '<br>';
            //print_r($children_data);
        }
    
         
            /*$levelData1= array();
           // function searchForId($id, $array) {
             foreach ($ctData as $key => $val) {               
                  if($val->level ==1)  {
                  //  echo 'ok';
                    $levelData1['level'] = $val->level;
                    $levelData1['id'] = $val->id;
                    $levelData1['name'] = $val->name;
                    $levelData1['children_data'] = $val->children_data;

                  }
             }

              $levelData2= array();
           // function searchForId($id, $array) {
             foreach ($levelData1['children_data'] as $key => $val) {               
                  if($val->level ==2)  {
                  //  echo 'ok';
                    $levelData2['level'] = $val->level;
                    $levelData2['id'] = $val->id;
                    $levelData2['name'] = $val->name;
                    $levelData2['children_data'] = $val->children_data;

                  }
             }*/
             //return null;
          //} 
           // print_r($levelData2);

    /*}*/
  } // esle sessionId
          
  ?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div id="content"></div>
         <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Shop Product</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
    <form role="form" id="addShopPro" method="post" enctype="multipart/form-data">
      <div class="box-body">
			  <div class="row">

         <div class="col-md-6">
            <div class="form-group">
                  <label>Product Type</label>
                  <select class="form-control" name="productType" id="productType">
                    <option value="0">Select Product Type </option>
                    <option value="<?php echo RESIDENT_ROOT_ID; ?>">Resident</option>
                    <option value="<?php echo TOURIST_ROOT_ID; ?>">Tourist</option>
                   
                  </select>
            </div>
         </div> 
				<div class="col-md-6">
		      	<div class="form-group">
                  <label>Category</label>
                  <select class="form-control" name="category" id="category">
                    <option value="0">Select category </option>
                  </select>
            </div>
         </div>
				<div class="col-md-6">
				<div class="form-group">
                  <label>Sub Category</label>
                  <select class="form-control" name="subcategory" id="subcategory">
                    <option value="0">Select subcategory </option>
                   
                  </select>
                </div>
                </div>
				<div class="col-md-6">
				<div class="form-group">
                  <label>Segment</label>
                  <select class="form-control" name="segment" id="segment">
                    <option value="0"> Select segmet</option>
                    
                  </select>
                </div>
                </div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="brandname">Brand name</label>
                  <input type="text" class="form-control" name="brandname" id="brandname" placeholder="Brand name here">
                </div>
            </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="producttype">Product Name</label>
                  <input type="text" class="form-control" name="productName" id="productName" placeholder="Product type here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Product Description here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="sku">Sku Code</label>
                  <input type="text" class="form-control" name="sku" id="sku" placeholder="Product sku here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="qty">Quantity</label>
                  <input type="text" class="form-control" name="qty" id="qty" placeholder="Product Quantity here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" name="price" id="price" placeholder="Product Price here">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="spprice">Special Price</label>
                  <input type="text" class="form-control" name="spprice" id="spprice" placeholder="Product Special Price here">
                </div>
				</div>
                <div class="col-md-6">
				<div class="form-group">
                <label>Special Price From Date</label>
                  <input type="text" name="sppricefrom" class="form-control" id="datepickerfrom">
                </div>
                </div>
				<div class="col-md-6">
				<div class="form-group">
                <label>Special Price To Date</label>
                  <input type="text" name="sppriceto" class="form-control" id="datepickerto">
                </div>
                </div>
				<div class="col-md-6">
				<div class="form-group">
                  <label>Size</label>
                  <select class="form-control" name="productsize">
                     <option value="0">Select Size</option>
                    <option value="91">55 cm</option>
                    <option value="92">65 cm</option>
                    <option value="93">75 cm</option>
                    <option value="94">6 food</option>
                    <option value="95">8 food</option>
                    <option value="96">10 food</option>
                    <option value="167">XS</option>
                    <option value="168">S</option>
                    <option value="169">M</option>
                    <option value="170">L </option>
                    <option value="171">XL </option>
                    <option value="172">28"</option>
                    <option value="173">29"</option>
                    <option value="174">30"</option>
                    <option value="175">31"</option>
                    <option value="176">32"</option>
                    <option value="177">33"</option>
                    <option value="178">34"</option>
                    <option value="179">36"</option>
                    <option value="180">38"</option>

                    
                   
                  </select>
                </div>
                </div>
				<div class="col-md-6">
				<div class="form-group">
                  <label>Color</label>
                  <select class="form-control" name="productcolor" id="productcolor">
                    <option value="0">Select Color</option>
                    <option value="49">Black</option>
                    <option value="50">Blue</option>
                    <option value="51">Brown</option>
                    <option value="52">Gray</option>
                    <option value="53">Green</option>
                    <option value="54">Lavender</option>
                    <option value="55">Multi</option>
                    <option value="56">Orange</option>
                    <option value="57">Purple</option>
                    <option value="58" >Red</option>
                    <option value="59">White</option>
                    <option value="60">Yellow</option>
                  </select>
                </div>
                </div>
              <div class="col-md-6">  
  				      <div class="form-group">
                  <label>Color picker:</label>
                  <input type="text" class="form-control my-colorpicker1 colorpicker-element">
                </div>
              </div>
				      <div class="col-md-6">
                <div class="form-group">
                  <label for="exampleInputFile">Add Images</label>
                  <input type="file" id="exampleInputFile" name="files[]" multiple required>
                </div>
                </div>
				</div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="button" name="submit" id="submitBtn"class="btn btn-danger">Add Product</button>
              </div>

              <div class="box-footer text-green">
                <?php if(isset($message)){ echo $message;} ?>
              </div>
              <div class="box-footer text-red">
                <?php if(isset($err_message)){ echo $err_message;} ?>
              </div>

              <div id="errDiv" style="display:none;">
                  <h4 id="errMsg" class="text-red"><i class="fa fa-warning "></i> 
                  </h4>
                 
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

<script src="dist/js/jquery-validator.js"></script>
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
 <script>
   $( document ).ready(function() {
      //alert();
      //$('#content').html('<img id="loader-img" alt="" src="dist/img/loading.gif" style="top:50%;left:50%;position:absolute;" width="100" height="100" align="center"/>');
       $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
           });
      
          //evt.preventDefault();
           var sessionId = "<?php echo $_SESSION['SessionChharo'];?>"; // $(this).attr('id');
           var customerId = "<?php echo $_SESSION['customerId'];?>";
                
            $('#submitBtn').on('click',function(){
               var producttype =  $("#productType").val();
                var brandname =  $("#brandname").val();
                //alert(producttype);
                   //var incid = $(this).data('incid'); // $(this).attr('id');
            //  alert(sessionId+customerId+tpin);
                // txt = "You pressed OK!";
                if(producttype == 0 || producttype == '' || producttype == "undefined" || producttype == undefined){
                //$("#checkTpinBtn").hide();
                //alert();
                $("#errDiv").show();
              $("#errMsg").removeClass('text-green').addClass('text-red').html("Please select product type");
             }else if(brandname == '' || brandname == "undefined" || brandname == undefined){
                  //alert(tpin.length );
                  $("#errDiv").show();
              $("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide brand name");
              //
              }else{

                  $.ajax({  
                  type: 'POST',
                  url: 'addproduct_shop_ajax.php',
                  data: { sessionId:sessionId,customerId:customerId },          
                  success : (function(data) {
                    
                   /* var b=JSON.parse(data);
                    var status = b.status;
                    if(status == 1){
                      //$("#sucRes").html(b.message);
                      //alert(b.message);
                      $("#errDiv").show();
                      //$("#errMsg").class();
                      $("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
                      window.location.href = urlPath;
                    }else{
                      $("#errDiv").show();
                      $("#errMsg").removeClass('text-green').addClass('text-red').html(b.message);
                    }*/
                    
                  }),
                  error : (function(){
                  alert('Whoops! This didn\'t work. Please contact us.')
                  }),
                  
              });

            }

             

            }); // end cancel   
      

      $('#productType').on('change',function(){
        var rootId  = $('#productType').val();
        //alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesShop.php',
            data: { rootId:rootId,storeId:1}, 

            beforeSend: function() {
              $('#loading').show();
                  // setting a timeout
                 // $(placeholder).addClass('loading');
                //$('#content').html('<img id="loader-img" alt="" src="dist/img/loading.gif" style="top:50%;left:50%;position:absolute;" width="100" height="100" align="center"/>');
            },        
            success : (function(data) {
               $('#loading').hide();
                var b=JSON.parse(data);
                var status = b.status;
                 
                if(status == 1){
                  var categories=b.categories;
                  //console.log(categories);
                  $("#category").empty();
                  $("#category").append("<option value='0'> Select category </option>");
                  var len = categories.length;
                  for( var i = 0; i<len; i++){
                        var id =categories[i]['id'];
                        var name = categories[i]['name'];
                       // console.log(id);
                        //console.log(name);
                        
                        $("#category").append("<option value='"+id+"'>"+name+"</option>");

                    }
                  //$("#category").append("<option value=''> Select Jr ASLP </option>"); 
                }
            }),
            error : (function(){
            alert('Whoops! This didn\'t work. Please contact us.');
            }),
            
        });
      });
      
      $('#category').on('change',function(){
        var rootId  = $('#category').val();
        //alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesShop.php',
            data: { rootId:rootId,storeId:1},
            beforeSend: function() {
              $('#loading').show();
                  // setting a timeout
                 // $(placeholder).addClass('loading');
                //$('#content').html('<img id="loader-img" alt="" src="dist/img/loading.gif" style="top:50%;left:50%;position:absolute;" width="100" height="100" align="center"/>');
            },  
              
            success : (function(data) {
                $('#loading').hide();
                var b=JSON.parse(data);
                var status = b.status;
                 
                if(status == 1){
                  var categories=b.categories;
                  //console.log(categories);
                    $("#subcategory").empty();
                    $("#subcategory").append("<option value='0'> Select subcategory </option>");
                  var len = categories.length;
                  for( var i = 0; i<len; i++){
                        var id =categories[i]['id'];
                        var name = categories[i]['name'];
                       // console.log(id);
                        //console.log(name);
                       
                        $("#subcategory").append("<option value='"+id+"'>"+name+"</option>");

                    }
                  //$("#category").append("<option value=''> Select Jr ASLP </option>"); 
                }
                $('#loading').hide('slow');
            }),
            error : (function(){
            alert('Whoops! This didn\'t work. Please contact us.')
            }),
            
        });
      });

      $('#subcategory').on('change',function(){
        var rootId  = $('#subcategory').val();
        //alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesShop.php',
            data: { rootId:rootId,storeId:1},
            beforeSend: function() {
              $('#loading').show();
            },                     
            success : (function(data) {
             $('#loading').hide();
                var b=JSON.parse(data);
                var status = b.status;
                 
                if(status == 1){
                  var categories=b.categories;
                  //console.log(categories);
                  $("#segment").empty();
                    $("#segment").append("<option value='0'> Select segment </option>");
                  var len = categories.length;
                  for( var i = 0; i<len; i++){
                        var id =categories[i]['id'];
                        var name = categories[i]['name'];
                       // console.log(id);
                        //console.log(name);
                        
                        $("#segment").append("<option value='"+id+"'>"+name+"</option>");

                    }
                  //$("#category").append("<option value=''> Select Jr ASLP </option>"); 
                }
            }),
            error : (function(){
            alert('Whoops! This didn\'t work. Please contact us.')
            }),
            
        });
      });


    });
</script>
