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
	     		Add Money
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">Add Money </a></li>
	        
	      </ol>
	    </section>
	    <section class="content">
	      <div class="error-page">
	        <div class="error-content">
	       
          	 <form role="form" id="addShopPro" method="post" enctype="multipart/form-data">
			    <div class="box-body">
					<div class="row">
				    <div class="col-md-12">
						<?php
						$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
						$basePath = $protocol.$_SERVER['HTTP_HOST'].'/chharoseller/'; 
		 				?>
	      			 	<div class="form-group">
			                  <label for="brandname">Amount</label>
			                  <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount">
		              	</div>
				    </div>

	              <div class="box-footer" id='addMoneyDiv'>
	                <button type="button" name="submit" id="btnAddMoney"class="btn btn-block btn-danger">Add Money</button>
	              </div>

		            <div id="optionsDiv" style="display:none;">
		              	 <div class="form-group">		              

		                <div class="box-footer">
		                 	<button type="button"  data-toggle="modal" data-target="#cardsDisclousureNotice" id="btnCards"class="btn btn-block btn-danger ">CARDS</button>
		                    <button type="button" id="btnBanks"class="btn btn-block btn-danger ">BANKS</button>
		               </div>
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

	   <div class="modal modal-danger fade in" id="cardsDisclousureNotice">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Disclosure Notice</h4>
              </div>
              <div class="modal-body">
                <p> A convenience Fee of 3.5% will be charged while loading your wallet using Debit/Credit/Prepaid card. The credit to your wallet will be the amount after deducting the Convenience Fee. <br> Do you wish to proceed?</p>
              </div>
              <div class="modal-footer">
                <button type="button" id="btnConcle" class="btn btn-default pull-left" data-dismiss="modal">No</button>
                <button type="button" id="btnAddMoneyProcces" data-dismiss="modal" class="btn btn-primary">Ok</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>
 <script type="text/javascript">
 		
 $(document).ready(function() {    
     	 var sessionId = "<?php echo $_SESSION['SessionChharo'];?>"; // $(this).attr('id');
     	 var customerId = "<?php echo $_SESSION['customerId'];?>";
     	 var basePath = "<?php echo $basePath; ?>";


     	 //concel
     	$('#btnCancle').on('click',function(){
   			//location.reload();
   		});

     	// add money action
     	$('#btnAddMoney').on('click',function(){
     		//alert();
     		 var price =  $("#amount").val();
     		 if(price == '' || price == "0" || price == "undefined" || price == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide amount");
				//$("#errDiv").fadeOut(5500);
			 }   
		    else{
		    	$("#btnAddMoney").hide();
				$("#optionsDiv").show('slow');
		    	$("#errDiv").hide();
		    	$("#errMsg").removeClass('text-red').addClass('text-green').html('');	
		    }
   			//location.reload();
   		});

     	// add money action
     	$('#btnAddMoneyProccesDummy').on('click',function(){
     		//alert();
     		 var price =  $("#amount").val();
     		 if(price == '' || price == "0" || price == "undefined" || price == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide amount");
				//$("#errDiv").fadeOut(5500);
			 }   
		    else{
		    	$("#btnAddMoney").hide();
				$("#optionsDiv").show('slow');
		    	$("#errDiv").hide();
		    	$("#errMsg").removeClass('text-red').addClass('text-green').html('');	
		    }
   			//location.reload();
   		});

   		$('#btnAddMoneyProcces').on('click',function(){ 
   			$("#cardsDisclousureNotice").hide();
   			$("#errDiv").hide();
   			 var storeId =  1;
   			 var price =  $("#amount").val();
   			 var productId =  437;
   			 var qty =  1;
   			 //Match 8 to 15 character string with at least one upper case letter, one lower case letter, and one digit (useful for passwords).
   			 //var passReg = /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&]).*$/;
   			 		
		      // txt = "You pressed OK!";
		      if(price == '' || price == "0" || price == "undefined" || price == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide amount");
				//$("#errDiv").fadeOut(5500);
			 }   
		    else{
		    	//$("#errDiv").fadeOut(0);
		    	$('#loading').show();
		        $.ajax({  
					  type: 'POST',
					  url: 'add_money_ajax.php',
					  data: { sessionId:sessionId,customerId:customerId, price:price,storeId:storeId,productId:productId,qty:qty},				  
					  success : (function(data) {
					  	$('#loading').hide();
					  		var b=JSON.parse(data);
							var status = b.status;

							if(status == 1){
								//$("#sucRes").html(b.message);
								var resData = b.resData;
								console.log(resData);
								currencyCode = resData.currencyCode;
								customerId = resData.customerId;
								quoteId = resData.quoteId;
								unformatedPrice = resData.unformatedPrice;

								//$("#errDiv").show();
								//$("#errMsg").class();
								//$("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
								////$("#errDiv").fadeOut(5500);
								//$("#addShopPro")[0].reset();

								var redPath = basePath+"meTrnPayAPI.php?currency="+b.resData.currencyCode+"&quoteId="+b.resData.quoteId+"&customerId="+b.resData.customerId+"&amount="+b.resData.unformatedPrice;
								//console.log(redPath);
								
							    window.location.replace(redPath);
							  
								//window.location.href = redPath;
							}else{
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
