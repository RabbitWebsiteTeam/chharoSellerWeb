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
	      Change T-Pin
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href=""> Change T-Pin </a></li>
	        
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
				                  <label for="brandname">Old T-Pin</label>
				                  <input type="password" id="ctpin" maxlength="4"  name="ctpin" class="form-control" placeholder="Old T-Pin">
				               </div>
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">New T-Pin</label>
				                  <input type="password" id="ntpin" maxlength="4"  name="ntpin" class="form-control" placeholder="New T-Pin">
				               </div>
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Confirm T-Pin</label>
				                  <input type="password" id="rntpin" maxlength="4"  name="rntpin" class="form-control" placeholder="Confirm T-Pin">
				               </div>
				            </div>

				              <div class="box-footer">
				                <button type="button" name="submit" id="submitBtn"class="btn btn-danger">Change T-Pin</button>
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
   			//  var urlPath =  $("#urlPath").val();
             //var incid = $(this).data('incid'); // $(this).attr('id');
			//  alert(sessionId+customerId+tpin);
		      // txt = "You pressed OK!";
		      if(ctpin == '' || ctpin == "undefined" || ctpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide old t-pin");
				$("#errDiv").fadeOut(5500);
			 }else if(ctpin.length != 4){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Old T-pin should be 4 digits");
				$("#errDiv").fadeOut(5500);
		    }else if(ntpin == '' || ntpin == "undefined" || ntpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide new t-pin");
				$("#errDiv").fadeOut(5500);
			 }else if(ntpin.length != 4){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("New T-pin should be 4 digits");
				$("#errDiv").fadeOut(5500);
		    }else if(!$.isNumeric(ntpin)){

		    	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("New T-pin should be a number");
				$("#errDiv").fadeOut(5500);	
		    }else if(rntpin == '' || rntpin == "undefined" || rntpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide Confirm t-pin");
				$("#errDiv").fadeOut(5500);
			 }else if(rntpin.length != 4){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Confirm T-pin should be 4 digits");
				$("#errDiv").fadeOut(5500);
		    }else if(ntpin != rntpin){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("New and Confirm T-pin should be match");
				$("#errDiv").fadeOut(5500);
		    }else{
		    	$("#errDiv").fadeOut(0);
		        $.ajax({  
					  type: 'POST',
					  url: 'changetpinajax.php',
					  data: { sessionId:sessionId,customerId:customerId ,ctpin:ctpin,ntpin:ntpin},				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								//$("#sucRes").html(b.message);
								//alert(b.message);
								$("#errDiv").show();
								//$("#errMsg").class();
								$("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
								$("#errDiv").fadeOut(5500);
								window.location.href = urlPath;
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
