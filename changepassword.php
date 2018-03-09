<?php 
include_once('config.php') ;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId'])){
  // $_SESSION['sessionId'] = $resData->sessionId;  

   header('Location:index.php');
  
  }else{


  }
  ?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

	  <section class="content-header">
	      <h1>
	     Change Password
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">Change Password </a></li>
	        
	      </ol>
	    </section>
	    <section class="content">
	      <div class="error-page">
	        <div class="error-content">
	        

	          <!-- <form class="search-form">
	            <div class="input-group">
	              <input type="number" id="tpin" maxlength="4"  name="tpin" class="form-control" placeholder="Enter T-pin">

	              <div class="input-group-btn">
	                <button type="button" id="checkTpinBtn" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-check-square"></i>
	                </button>
	              </div>
	            </div>
	           
	          </form> 
	          	 <input type="text" id="urlPath" style="display:none;" value="passbook.php" name="urlPath" class="form-control" placeholder="urlPath">
	          	 -->
	          	 <form role="form" id="addShopPro" method="post" enctype="multipart/form-data">
				      <div class="box-body">
						  <div class="row">

					        <div class="col-md-12">
					        	<br>
	              			 <div class="form-group">
				                  <label for="brandname">Old Password</label>
				                  <input type="password" id="ctpin" name="ctpin" class="form-control" placeholder="Old Password">
				               </div>
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">New Password</label>
				                  <input type="password" id="ntpin" name="ntpin" class="form-control" placeholder="New Password">
				               </div>
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Conform Password</label>
				                  <input type="password" id="rntpin" name="rntpin" class="form-control" placeholder="Conform Password">
				               </div>
				            </div>

				              <div class="box-footer">
				                <button type="button" name="submit" id="submitBtn"class="btn btn-danger">Change Password</button>
				              </div>
				          </div>
				       </div>	
	          	</form>
	          <div id="errDiv" style="display:none;">
	            <h6 id="errMsg" class="text-red"><i class="fa fa-warning "></i> 
	         		</h6>
	           <!-- <span > <a href="home.php">Return to Home</a> or Try agian. -->
	          </div>

	      	  <div id="succDiv" style="display:none;">
	            <h6 id="succMsg" class="text-green"><i class="fa fa-warning "></i> 
	         		</h6>
	           <!-- <span > <a href="home.php">Return to Home</a> or Try agian. -->
	          </div>

	        </div>
	        <!-- /.error-content -->
	      </div>
	      <!-- /.error-page -->
	    </section>
	</div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>
 <script type="text/javascript">
 		
 $(document).ready(function() {    
     	 var sessionId = "<?php echo $_SESSION['SessionChharo'];?>"; // $(this).attr('id');
     	 var customerId = "<?php echo $_SESSION['customerId'];?>";
     	
   		$('#submitBtn').on('click',function(){
   			 var ctpin =  $("#ctpin").val();
   			 var ntpin =  $("#ntpin").val();
   			 var rntpin =  $("#rntpin").val();
   			 //Match 8 to 15 character string with at least one upper case letter, one lower case letter, and one digit (useful for passwords).
   			 var passReg = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
   			 		
		      // txt = "You pressed OK!";
		      if(ctpin == '' || ctpin == "undefined" || ctpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide old Password");
				$("#errDiv").fadeOut(5500);
			 }else if(ntpin == '' || ntpin == "undefined" || ntpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide new Password");
				$("#errDiv").fadeOut(5500);
			 }else if(ntpin.length < 8){
		      	//alert(tpin.length );

		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please enter a new password with at least 8 characters");
				$("#errDiv").fadeOut(5500);
		    }else if(!ntpin.match(passReg)){
		      	//alert(ntpin.length );

		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Minimum of defferent classes of characters in password of characters:Lower case, Digits, Special characters.");
				$("#errDiv").fadeOut(5500);
		    }else if(rntpin == '' || rntpin == "undefined" || rntpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide Conform Password");
				$("#errDiv").fadeOut(5500);
			 }else if(ntpin != rntpin){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("New and Conform Password should be match");
				$("#errDiv").fadeOut(5500);
		    }		   
		    else{
		    	$("#errDiv").fadeOut(0);
		        $.ajax({  
					  type: 'POST',
					  url: 'changepasswordajax.php',
					  data: { sessionId:sessionId,customerId:customerId ,ctpin:ctpin,ntpin:ntpin},				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								//$("#sucRes").html(b.message);
								//alert(b.message);
								$("#errDiv").show();
								//$("#errMsg").class();
								///b.message
								$("#errMsg").removeClass('text-red').addClass('text-green').html('Your password is updated successfully.');
								$("#errDiv").fadeOut(5500);
								 window.setTimeout(function(){
							        // Move to a new location or you can do something else
							        window.location.href = "logout.php";

							    }, 5000);
								//window.location.href = urlPath;
							}else{
								$("#errDiv").show();
								$("#errMsg").removeClass('text-green').addClass('text-red').html(b.message);
								$("#errDiv").fadeOut(5500);

							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

			}

		   

	    }); // end cancel   		

   		
});
 </script>
