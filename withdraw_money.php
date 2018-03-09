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
	     		Withdraw Money
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">Withdraw Money </a></li>
	        
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
	              			 <div class="form-group">
				                  <label for="brandname">Banks</label>
				                	<select class="form-control" name="bank" id="bank">
					                    <option value="0">Select Bank </option>
					                    <option value="bob">Bank of Bhutan Limited</option>
					                    <option value="bnb">Bhutan National Bank Limited</option>
					                   	 <option value="dpnb">Druk Punjab National Bank Limited</option>
					                    <option value="bdb">Bhutan Development Bank Limited</option>
					                    <option value="tb">T Bank Limited</option>
					                    
					                   
					                </select>
				               </div>
				            </div>

					

					        <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Amount</label>
				                  <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount">
				               </div>
				            </div>
				            <!--  <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Mobile No</label>
				                  <input type="text" id="mobileno" name="mobileno" class="form-control" placeholder="Mobile No">
				               </div>
				            </div> -->
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Account Number</label>
				                  <input type="text" id="accountNumber" name="accountNumber" class="form-control" placeholder="Account Number">
				               </div>
				            </div>

				              <div class="box-footer">
				                <button type="button" name="submit" id="submitBtn"class="btn btn-danger">Withdraw Money</button>
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
     	 var mobileno = "<?php echo $_SESSION['username'];?>";
     	 //alert(mobileno);
     	 var accountNoCount = 0;
   		$('#submitBtn').on('click',function(){
   			 var bank =  $("#bank").val();
   			 var amount =  $("#amount").val();
   			// var mobileno =  $("#mobileno").val();
   			 var accountNumber =  $("#accountNumber").val();
   			if(bank == 'bob'){
	   			 accountNoCount =9;
	   		}else if(bank == 'bnb'){
	   			 accountNoCount =13;
	   		}else if(bank == 'dpnb'){
	   			 accountNoCount =12;
	   		}else if(bank == 'bdb'){
	   			 accountNoCount =12;
	   		}else if(bank == 'tb'){
	   			 accountNoCount =14;
	   		}else{
	   			 accountNoCount =0;
	   		}


   			 //Match 8 to 15 character string with at least one upper case letter, one lower case letter, and one digit (useful for passwords).
   			 //var passReg = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
   			 		
		      // txt = "You pressed OK!";
		      if(bank == '' || bank == "0" || bank == "undefined" || bank == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please select a bank");
				$("#errDiv").fadeOut(5500);
			 }else if(amount == '' || amount == '0' || amount == "undefined" || amount == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide amount");
				$("#errDiv").fadeOut(5500);
			 }else if(mobileno == '' || mobileno == "undefined" || mobileno == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide mobile no");
				$("#errDiv").fadeOut(5500);
			 }else if(accountNumber == '' || accountNumber == "undefined" || accountNumber == "0" || accountNumber == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide account aumber");
				$("#errDiv").fadeOut(5500);
			 }
			 else if(accountNumber.length != accountNoCount){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Account aumber length should be "+accountNoCount);
				$("#errDiv").fadeOut(5500);
			 }    
		    else{
		    	$("#errDiv").fadeOut(0);
		    	$('#loading').show();
		        $.ajax({  
					  type: 'POST',
					  url: 'withdrawMoneyAjax.php',
					  data: { sessionId:sessionId,customerId:customerId ,bank:bank,amount:amount,mobileno:mobileno,accountNumber:accountNumber},				  
					  success : (function(data) {
					  	$('#loading').hide();
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								//$("#sucRes").html(b.message);
								//alert(b.message);
								$("#errDiv").show();
								//$("#errMsg").class();
								$("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
								$("#errDiv").fadeOut(5500);
								$("#addShopPro")[0].reset();
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
