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
	     		Pay Money
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">Pay Money </a></li>
	        
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
	          	<?php //print_r($_SESSION);?>
	          	 <form role="form" id="addShopPro" method="post" enctype="multipart/form-data">
				      <div class="box-body">
						  <div class="row">
					        <div class="col-md-12">
	 						<br>
	              			 <div class="form-group">
				                  <label for="brandname">Enter Mobile Number to Pay</label>
				                  <input type="number" id="mobileNo" name="mobileNo" class="form-control" placeholder="Mobile No ">
				             </div>

				               <div id="payingDiv" style="display:none;">
				              	 <div class="form-group">
				                  <label for="brandname">Pay To <span id="payeeName"></span></label>
				               		<input type="hidden" id="receiverId" name="receiverId" class="form-control" placeholder="Amount (Nu)">
				                </div>
				               <div class="form-group">
				                  <label for="brandname">Enter Amount</label>
				                  <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount (Nu)">
				               </div>

				                <div class="form-group">
				                  <label for="brandname">Enter Description</label>
				                  <input type="test" id="desc" name="desc" class="form-control" placeholder="Description (Optional) ">
				               </div>

				                 <div class="box-footer">
				                <button type="button"  id="btnProceed"class="btn btn-danger">Proceed</button>
				                
				                <button type="button" id="btnCancle"class="btn btn-danger">Cancel</button>
				              </div>
				            </div>
				           
				          

				              <div class="box-footer">
				                <button type="button" name="submit" id="submitBtn"class="btn btn-danger">Pay Now</button>
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
     	 var username = "<?php echo $_SESSION['username'];?>"; // user mobile no
     	// var accountNoCount = 0;
   		$('#submitBtn').on('click',function(){

   			$("#errDiv").hide();
   			 
   			 var mobileNo =  $("#mobileNo").val();
		      if(mobileNo == '' || mobileNo == "0" || mobileNo == "undefined" || mobileNo == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide mobile number");
				//$("#errDiv").fadeOut(5500);
			 }else if(mobileNo.length != 8){
			 	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Mobile number should be 8 digits");
				
			 }else if( mobileNo == username){
			 	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Same account wallet transfer not possible.");
				
			 }  
		    else{
		    	//$("#errDiv").fadeOut(0);
		    	$('#loading').show();
		        $.ajax({  
					  type: 'POST',
					  url: 'payMoneyAjax.php',
					  data: { sessionId:sessionId,customerId:customerId, mobileNo:mobileNo,method:'pay'},				  
					  success : (function(data) {
					  	$('#loading').hide();
					  		var b=JSON.parse(data);
							var status = b.status;
							console.log(b);

							if(status == 1){
								$("#submitBtn").hide();
								$("#payingDiv").show('slow');
								$("#sucRes").html(b.message);
								$("#payeeName").html(b.name);
								$("#receiverId").val(b.id);								
								var resData = b.resData;
							}else{
								$("#submitBtn").show();
								$("#payingDiv").hide();
								$("#errDiv").show();
								$("#errMsg").removeClass('text-green').addClass('text-red').html(b.message);
								//$("#errDiv").fadeOut(5500);

							}
							
					  }),
					  error : (function(){
						alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

			}

		   

	    }); // end cancel   		

   		$('#btnCancle').on('click',function(){
   			location.reload();
   		});

   		/* 8888 */

   		$('#btnProceed').on('click',function(){
   			
   			$("#errDiv").hide(); 
   			  
   			var mobileNo =  $("#mobileNo").val();			 
   			 var amount =  $("#amount").val();
   			 var desc =  $("#desc").val();
   			 var receiverId =  $("#receiverId").val();
   			 //alert(mobileNo);
   			 //return false;
   			 if(mobileNo.length != 8){
			 	$("#submitBtn").show();
				$("#payingDiv").hide();
				$("#addShopPro")[0].reset();
				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Mobile number should be 8 digits");
				
			 }else if(amount == '' || amount == "0" || amount == "undefined" || amount == undefined){
   				
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide amount");
				//$("#errDiv").fadeOut(5500);
			 } else if(receiverId == '' || receiverId == "0" || receiverId == "undefined" || receiverId == undefined){
			 	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Something went wrong, Please refresh and try again!. ");
				
			 }else if(customerId == '' || customerId == "0" || customerId == "undefined" || customerId == undefined){
			 	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Something went wrong, Please refresh and try again!. ");
				
			 }

		    else{
		    	//$("#errDiv").fadeOut(0);
		    	$('#loading').show();
		        $.ajax({  
					  type: 'POST',
					  url: 'payMoneyAjax.php',
					  data: { sessionId:sessionId,customerId:customerId,amount:amount, mobileNo:mobileNo,method:'transfer',receiverId:receiverId},				  
					  success : (function(data) {
					  	$('#loading').hide();
					  		var b=JSON.parse(data);
							var status = b.status;
							console.log(b);

							if(status == 1){
								$("#submitBtn").show();
								$("#payingDiv").hide('slow');
								$("#errDiv").show('slow');
								$("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
								$("#payeeName").html();
								$("#receiverId").val();
								$("#addShopPro")[0].reset();								
								//var resData = b.resData;
							}else{
								$("#submitBtn").show();
								$("#payingDiv").hide();
								$("#addShopPro")[0].reset();
								$("#errDiv").show();
								$("#errMsg").removeClass('text-green').addClass('text-red').html(b.message);
								//$("#errDiv").fadeOut(5500);

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
