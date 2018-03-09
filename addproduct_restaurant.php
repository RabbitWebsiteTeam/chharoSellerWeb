<?php 
include_once('config.php') ;

if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  
   header('Location:index.php');
  
  }else{

          $storeId =1; 
         $website = 1;    
         $restaurant_table = '';
        if(isset($_POST['submit'])){

          //print_r($_POST);
              $finalImg ='';
             foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name)
              {
                 $file_name=$_FILES["files"]["name"][$key];
                 $file_tmp=$_FILES["files"]["tmp_name"][$key];
                 $file_type=$_FILES["files"]["type"][$key];
                 $ext=pathinfo($file_name,PATHINFO_EXTENSION);

                //echo '<br>';
                $finalImg .='\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name="images[]"; filename="'.$file_name.'"\r\nContent-Type: '.$file_type.'\r\n\r\n';
               
            }
            $menuimage ='';
            if($_FILES['menuimg']['name']){
             $menuimgName = $_FILES['menuimg']['name'];
              $menuimgType = $_FILES['menuimg']['type'];
            }
          
            $menuimage .='\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name="memuimg"; filename="'.$menuimgName.'"\r\nContent-Type: '.$menuimgType.'\r\n\r\n';
            

            //exit;
             $spfrom = '';
             $spto = '';
             $categorylist = '';
             $product_brand='';
             $price ='';
             $spprice ='';
             $services = $_POST['services'];
             $phone_number = $_POST['phone_number'];
            $alternate_number = $_POST['alternumber'];
            $location_lat = $_POST['latitude'];
            $location_long = $_POST['longitude'];
            $website_url = '';
            $address = $_POST['address'];
            $hours_of_operation = $_POST['hrsoperation'];
            $sku = $_POST['dinesku'];
           
            $qty = $_POST['qty'];
            $description = $_POST['description'];
             $name = $_POST['restaurantname'];
           
            $cuisines_types ='';
           // if()
              


             $hex_color ="#000";

               if ($_POST['productType'] == 2) {
                     $categorylist = RESIDENT_ROOT_ID .",".RESIDENT_BOOK_SERVICE.",".$_POST['category'].",".$_POST['subcategory'].",".$_POST['cuisine'];
                } else {
                     $categorylist = TOURIST_ROOT_ID ."," .TOURIST_BOOK_SERVICE . ",".$_POST['category'].",".$_POST['subcategory'].",".$_POST['cuisine'];
                }
                //echo $categorylist;
          //  exit;
            $curl = curl_init();
            //$cfile = new CURLFile($img_name,$mimetype,'images');
            //$data = array('images' => $cfile);
            curl_setopt_array($curl, array(
              CURLOPT_URL => domain."chharohttp/customer/AddServiceTypeProducts",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sellerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"storeId\"\r\n\r\n".$storeId."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"websiteId\"\r\n\r\n".$website."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"categorylist\"\r\n\r\n".$categorylist."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"product_brand\"\r\n\r\n".$product_brand."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"name\"\r\n\r\n".$name."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"description\"\r\n\r\n".$description."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"sku\"\r\n\r\n".$sku."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"services\"\r\n\r\n".$services."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"restaurant_table\"\r\n\r\n".$restaurant_table."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"price\"\r\n\r\n".$price."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
              name=\"spprice\"\r\n\r\n".$spprice."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"phone_number\"\r\n\r\n".$phone_number."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"alternate_number\"\r\n\r\n".$alternate_number."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"location_lat\"\r\n\r\n".$location_lat."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"location_long\"\r\n\r\n".$location_long."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"website_url\"\r\n\r\n".$website_url."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"spfrom\"\r\n\r\n".$spfrom."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"spto\"\r\n\r\n".$spto."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"address\"\r\n\r\n".$address."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"hours_of_operation\"\r\n\r\n".$hours_of_operation."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"cuisines_types\"\r\n\r\n".$cuisines_types."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;
              name=\"qty\"\r\n\r\n".$qty."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"menuimage\"\r\n\r\n".$menuimage.$finalImg,
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"            
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
              $response = json_decode($response);
            // exit;
             //echo $response->error;
              if(isset($response->error))
              {
               if($response->error == 5){
                $curUrl = $_SERVER['REQUEST_URI'];
                      $redirPath = checkSessionId($curUrl);
                      header('Location: '.$redirPath);

               }
              }

              if($response->success==1){
                $message =$response->message;
                $Product_id =$response->Product_id;
              }else{
                $err_message =$response->message;
              }

        }

        ///

  }
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
            <form role="form"  id="addRestPro" method="post" enctype="multipart/form-data">
              <div class="box-body">
			  <div class="row">
				<div class="col-md-12">
            <div class="col-md-6">
                <div class="form-group">
                      <label> Product Type</label>
                    <select class="form-control" name="productType" id="productType">
                        <option value="0">Select Product Type </option>
                         <option value="<?php echo RESIDENT_ROOT_ID; ?>">Resident</option>
                        <option value="<?php echo TOURIST_ROOT_ID; ?>">Tourist</option>
                   </select>
                    </div>
            </div>

             <div class="col-md-6">
                <div class="form-group">
                      <label> Category</label>
                    <select class="form-control" name="category" id="category">
                        <option value="0">Select Category </option>
                        </select>
                    </div>
            </div>

				      <div class="col-md-6">
				       <div class="form-group">
                  <label>Sub Category</label>
                  <select class="form-control" id="subcategory" name="subcategory">
                   <option value="0">Select</option>
                   <!--  <option value="dinein">Dine-in</option>
                    <option value="hmdelivery">Home Delivery</option> -->
                  </select>
            </div>
            </div>
				<div id="dine">
				<div class="col-md-6">
				<div class="form-group">
                  <label>Select Cuisine Type</label>
                  <select class="form-control"  name="cuisine" id="cuisine">
                   <option value="0"> Select </option>
                  </select>
                </div>
                </div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="restaurantname">Restaurant name</label>
                  <input type="text" class="form-control" name="restaurantname" id="restaurantname" placeholder="Restaurant name ">
                </div>
         </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="primarynumber">Primary number</label>
                  <input type="text" class="form-control" name="primarynumber" id="primarynumber" placeholder="Primary number ">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="alternumber">Alternate number</label>
                  <input type="text" class="form-control" name="alternumber" id="alternumber" placeholder="Alternate number ">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="dinesku">Sku Code</label>
                  <input type="text" class="form-control" name="dinesku" id="dinesku" placeholder="Sku">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="latitude">Location Latitude</label>
                  <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Location Latitude ">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="longitude">Location Longitude</label>
                  <input type="text" class="form-control" name="longitude" id="longitude" placeholder="Location Longitude ">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="readdress">Address</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Address ">
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
                  <label for="menuimg">Menu Image</label>
                  <input type="file" id="menuimg" name="menuimg">
                </div>
                </div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" name="description" id="description" placeholder="Description">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="service">Services</label>
                  <input type="text" class="form-control" name="services" id="services" placeholder="Services">
                </div>
				</div>
				
				<div class="col-md-6">
                <div class="form-group">
                  <label for="imagesdinein">Add Images</label>
                  <input type="file" id="exampleInputFile" name="files[]" multiple required>
                </div>
                </div>
				</div>
				
				<div id="hmdelivery" style="display:none;">
				<div class="col-md-6">
				<div class="form-group">
                  <label>Select Restaurant Name</label>
                  <select class="form-control" name="segment" id="segment">
                   <option value="0"> Select segmet</option>
                  </select>
                </div>
                </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="prodname">Product name</label>
                  <input type="text" class="form-control" name="prodname" id="prodname" placeholder="Product name">
                </div>
                </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="sku">Sku Code</label>
                  <input type="text" class="form-control" name="sku" id="sku" placeholder="Product sku ">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="productdesc">Product Description</label>
                  <input type="text" class="form-control" name="productdesc" id="productdesc" placeholder="Product Description">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" name="price" id="price" placeholder="Product Price">
                </div>
				</div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="spprice">Special Price</label>
                  <input type="text" class="form-control" name="spprice" id="spprice" placeholder="Product Special Price ">
                </div>
				</div>
                <div class="col-md-6">
				<div class="form-group">
                <label>Special Price From Date</label>
                  <input type="text" name="sppricefrom" class="form-control" id="datepickerfrom" placeholder="Select Special Price From date">
                </div>
                </div>
				<div class="col-md-6">
				<div class="form-group">
                <label>Special Price To Date</label>
                  <input type="text" name="sppriceto" class="form-control" id="datepickerto" placeholder="Select Special Price To date">
                </div>
                </div>
				<div class="col-md-6">
                <div class="form-group">
                  <label for="imageshomedelivery">Add Images</label>
                  <input type="file" id="imageshomedelivery">
                </div>
                </div>
				</div>
				</div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name="submit" id="submitBtn"class="btn btn-danger">Add Product</button>
              </div>

              <div class="box-footer text-green">
                <?php if(isset($message)){ echo $message;} ?>
              </div>
              <div class="box-footer text-red">
                <?php if(isset($err_message)){ echo $err_message;} ?>
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
 $('#subcategory').on('change',function(){
	 if($(this).val()=="502") //hmdelivey
	 {
		$('#hmdelivery').show();
        $('#dine').hide();				
	 }
	 else{
		 $('#hmdelivery').hide();	
		 $('#dine').show();	
	 }
 });
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
       $.validator.addMethod("valueNotEquals", function(value, element, arg){
            return arg !== value;
           });
        $('#submitBtn').on('click', function() {
          //alert();
             $("#addRestPro").validate({
              rules: {
                productType: { valueNotEquals: "0" } ,
                category: { valueNotEquals: "0" } ,
                subcategory: { valueNotEquals: "0" } ,
                cuisine: { valueNotEquals: "0" } ,
                restaurantname: { required : true, },
                primarynumber :{required : true,},
                description :{required : true,},
                
                      
               },
              messages: {
                productType:  { valueNotEquals : "Please select product type", },  
                category:  { valueNotEquals : "Please select category", },  
                subcategory:  { valueNotEquals : "Please select sub category", }, 
                cuisine:  { valueNotEquals : "Please select cuisine", },
                restaurantname :  { required : "Please enter brand name",  },  
                primarynumber:  { required : "Please enter product type",  },
                description:  { required : "Please enter description",  },
               
              },

            /*  submitHandler: function(form) {
              form.submit();
            }*/
             submitHandler: function(form) {      
                
                // alert('form');
                 $( "#addRestPro" ).submit();
                
                //$(this).find("button[type='submit']").prop('disabled',true);
                 
               /* var fname = $('#fname').val();
                var tpin = $('#tpin').val(); 
                 var lname = $('#lname').val();  
                var phone = $('#phone').val();
                var bname = $('#bname').val();
                var pass = $('#pass').val();
                var repass = $('#repass').val();
                var email = $('#email').val();*/
                
                
                  ///alert(branch + ','+ center +','+date1 +','+maxCount);
              /*  $.ajax({  
                    type: 'POST',
                    url: 'registerAjax.php',
                    data: {fname:fname,tpin:tpin,lname:lname,phone:phone,bname:bname,pass:pass,repass:repass,email:email  
                    },
                     beforeSend: function() {
                      // setting a timeout
                      $('#submitBtn').prop('disabled',true)
                    },
                    success : (function(data) {
                      console.log(data);
                        var b=JSON.parse(data);
                      var status = b.status;
                      if(status == 1){
                        //$("#success_message").fadeIn(); 
                        // $('#success_message').html(b.message);  
                          //$("#success_message").fadeOut(5000);  
                          console.log(b.message);
                          window.location.href = 'registerAddress.php';
                        //$("#createSlotFrm")[0].reset();
                      }else{
                         console.log(b.message); 
                          
                        $("#err").html(b.message);
                      } 
                    }),
                    error : (function(){
                    alert('Whoops! This didn\'t work. Please contact us.')
                    }),
                    complete: function() {
                    $('#submitBtn').prop('disabled',false);
                  },
                });*/
               }// end submit handler
         
                 
          });
      
        }); 

      $('#productType').on('change',function(){
        var rootId  = $('#productType').val()
        //alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesRestaurant.php',
            data: { rootId:rootId,storeId:1},          
            success : (function(data) {
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
            alert('Whoops! This didn\'t work. Please contact us.')
            }),
            
        });
      });
      
      $('#category').on('change',function(){
        var rootId  = $('#category').val()
      //  alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesRestaurant.php',
            data: { rootId:rootId,storeId:1},          
            success : (function(data) {
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
            }),
            error : (function(){
            alert('Whoops! This didn\'t work. Please contact us.')
            }),
            
        });
      });

      $('#subcategory').on('change',function(){
        var rootId  = $('#subcategory').val()
        //alert(rootId);
          $.ajax({  
            type: 'POST',
            url: 'getCategoriesRestaurant.php',
            data: { rootId:rootId,storeId:1},          
            success : (function(data) {
                var b=JSON.parse(data);
                var status = b.status;
                 
                if(status == 1){
                  var categories=b.categories;
                  //console.log(categories);
                  $("#cuisine").empty();
                    $("#cuisine").append("<option value='0'> Select cuisine </option>");
                  var len = categories.length;
                  for( var i = 0; i<len; i++){
                        var id =categories[i]['id'];
                        var name = categories[i]['name'];
                       // console.log(id);
                        //console.log(name);
                        
                        $("#cuisine").append("<option value='"+id+"'>"+name+"</option>");

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
