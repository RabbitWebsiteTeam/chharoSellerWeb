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
					        	 <div class="form-group">
				                 </div>
	              			 <div class="form-group has-feedback">
						        <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="squetion" id="squetion" >
									<option value="0">Select Security Question</option>
						                 <option value="What is the first name of the person you first kissed?">What is the first name of the person you first kissed?</option>
										<option value="What is the last name of the teacher who gave you your first failing grade?">What is the last name of the teacher who gave you your first failing grade?  </option>
										 <option value="What was the name of your elementary / primary school?">What was the name of your elementary / primary school?</option> 
										  <option value="In what city or town does your nearest sibling live?">In what city or town does your nearest sibling live?</option> 
										   <option value="What is your pet’s name?">What is your pet’s name?</option>
										  <option value="In what year was your father born?">In what year was your father born?</option>
						              <option value="In what year was your father born?">In what year was your father born ?  </option>
						          </select> 
						      </div>
							  
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Answer</label>
				                  <input type="text" id="answer" name="answer" class="form-control" placeholder="Answer">
				               </div>
				            </div>
				             <div class="col-md-12">
	              			 <div class="form-group">
				                  <label for="brandname">Conform T-Pin</label>
				                  <input type="number" id="ntpin" maxlength="4"  name="ntpin" class="form-control" placeholder="New T-Pin">
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

   			 var squetion =  $("#squetion").val();
   			 var answer =  $("#answer").val();
   			 var ntpin =  $("#ntpin").val();
   			//  var urlPath =  $("#urlPath").val();
             //var incid = $(this).data('incid'); // $(this).attr('id');
			//  alert(sessionId+customerId+tpin);
		      // txt = "You pressed OK!";
		      if(squetion == 0 || squetion == "undefined" || squetion == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please select Security Question");
				$("#errDiv").fadeOut(5500);
			 }else if(answer == '' || answer == "undefined" || answer == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide answer");
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
		    }else{
		    	$("#errDiv").fadeOut(0);
		        $.ajax({  
					  type: 'POST',
					  url: 'resetTPinAjax.php',
					  data: { sessionId:sessionId,customerId:customerId ,answer:answer,ntpin:ntpin},				  
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
