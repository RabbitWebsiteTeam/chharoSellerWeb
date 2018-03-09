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
	      Check T-Pin
	      </h1> <a href="#">
            <i class="fa fa-backward text-red" ></i> <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" class="text-red">Go back</a>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">check T-Pin </a></li>
	        
	      </ol>
	    </section>
	    <section class="content">
	      <div class="error-page">
	        <div class="error-content">
	        

	          <form class="search-form">
	            <div class="input-group">
	              <input type="number" id="tpin" maxlength="4"  name="tpin" class="form-control" placeholder="Enter T-pin">

	              <div class="input-group-btn">
	                <button type="button" id="checkTpinBtn" name="submit" class="btn btn-danger btn-flat"><i class="fa fa-check-square"></i>
	                </button>
	              </div>

	            </div>
	            <!-- /.input-group -->
	          </form>
	          	 <input type="text" id="urlPath" style="display:none;" value="passbook.php" name="urlPath" class="form-control" placeholder="urlPath">
	          
	          
	          <div id="errDiv" style="display:none;">
	            <h4 id="errMsg" class="text-red"><i class="fa fa-warning "></i> </h4>

	           <span> <a href="home.php">Return to Home</a> or Try agian. </span>

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
 		//alert('laod'); 
 		//alert(localStorage.succUrl); 
 		var succUrl = localStorage.getItem('succUrl');
 		//$("#back-btn").attr('href',succUrl);
     	 var sessionId = "<?php echo $_SESSION['SessionChharo'];?>"; // $(this).attr('id');
     	 var customerId = "<?php echo $_SESSION['customerId'];?>";
     	
   		$('#checkTpinBtn').on('click',function(){
   			 var tpin =  $("#tpin").val();
   			  var urlPath =  $("#urlPath").val();
             //var incid = $(this).data('incid'); // $(this).attr('id');
			//  alert(sessionId+customerId+tpin);
		      // txt = "You pressed OK!";
		      if(tpin == '' || tpin == "undefined" || tpin == undefined){
   				//$("#checkTpinBtn").hide();
   				//alert();
   				$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("Please provide t-pin");
			 }else if(tpin.length != 4){
		      	//alert(tpin.length );
		      	$("#errDiv").show();
				$("#errMsg").removeClass('text-green').addClass('text-red').html("T-pin should be 4 digits");
				//
		    }else{
		    	$("#errDiv").hide();
				$("#errMsg").html("");
				
		        $.ajax({  
					  type: 'POST',
					  url: 'checkTPinAjax.php',
					  data: { sessionId:sessionId,customerId:customerId ,tpin:tpin},				  
					  success : (function(data) {
					  		var b=JSON.parse(data);
							var status = b.status;
							if(status == 1){
								//$("#sucRes").html(b.message);
								//alert(b.message);
								$("#errDiv").show();
								//$("#errMsg").class();
								$("#errMsg").removeClass('text-red').addClass('text-green').html(b.message);
								window.location.href = succUrl;
							}else{
								$("#errDiv").show();
								$("#errMsg").removeClass('text-green').addClass('text-red').html(b.message);
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
<script>
function goBack() {
	alert();
    window.history.back();
}
</script>