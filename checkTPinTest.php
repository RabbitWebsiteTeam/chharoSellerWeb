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
include_once('config.php') ;
 header('Access-Control-Allow-Origin: *'); 
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
	      </h1>
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
	                <button type="button" id="checkTpinBtn" class="btn btn-danger btn-flat"><i class="fa fa-check-square"></i>
	                </button>
	              </div>
	            </div>
	            <!-- /.input-group -->
	          </form>
	          	 <input type="text" id="urlPath" style="display:none;" value="passbook.php" name="urlPath" class="form-control" placeholder="urlPath">
	          
	          
	          <div id="errDiv" style="display:none;">
	            <h4 id="errMsg" class="text-red"><i class="fa fa-warning "></i> 
	         		</h4>
	           <span > <a href="home.php">Return to Home</a> or Try agian.
	          </div>
	      		<?php print_r($_SESSION); ?>

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
     	 var customerId = "<?php echo trim($_SESSION['customerId']);?>";
     	 var apiUrl = "<?php echo domain.'chharohttp/customer/CheckTpin'?>"; 

     	
   		$('#checkTpinBtn').on('click',function(event){
   			event.preventDefault();
   			 var tpin =  $("#tpin").val();
   			  var urlPath =  $("#urlPath").val();
   			 
             //var incid = $(this).data('incid'); // $(this).attr('id');
			 alert(sessionId);
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
		    	  var xhttp = new XMLHttpRequest();
				  xhttp.open("POST", "cookie.txt", true);
				  xhttp.send();
		    	 //$('#loading').show();
		    	 var postData = [{"sessionId":sessionId,"customerId":customerId,"tpin":tpin}];
		        $.ajax({  
					  type: 'POST',
					  url: apiUrl,
					 /* headers: {
					  	//'Access-Control-Allow-Origin':'*',
					    //'Accept': 'multipart/form-data', // This is set on request
					    'Content-Type': 'application/json', // This is set on request					   
					    'Cache': 'no-cache', // This is set on request					 
					    'Cookie': 'sessionId=unbfhauo6uifmp9t58deg2l7s0', // This is missing from request
					  },*/
					  /*beforeSend : function(xhttp){ 
					  	xhttp.setRequestHeader("Content-type", "application/json");
					  	//xhttp.setRequestHeader("Content-type", "application/json");
					    xhttp.setRequestHeader('Cookie', 'sessionId=j77h5tir5u38t7prpt9i2cull7 ');
					    //$('#loading').show();
					  },*/
					  //data: JSON.stringify(postData),
					   						
					  data : { "sessionId":sessionId,"customerId":customerId,"tpin":tpin }, 							   
					  success : (function(data, textStatus, XMLHttpRequest){
					  		Set_Cookie(cookietoSet.split('=')[0],cookietoSet.split('=')[1],expires, path, domain, secure)//change as per ur needs
					  		 $('#loading').hide();
					  		//var b=JSON.parse(data);
							//var status = b.status;
							//console.log(data);
							if(data.error && data.error==5){
								  alert(data.message);
							}else{
									alert('sessionId Ok');
							}
						
					  }),
					  error : (function(XMLHttpRequest, textStatus, errorThrown){
					  	//console.log(err);
					  	alert(XMLHttpRequest.getResponseHeader('some_header'));
						//alert('Whoops! This didn\'t work. Please contact us.')
					  }),
					  
				});

				

			}

		   

	    }); // end cancel   		
function Set_Cookie( name, value, expires, path, domain, secure )
				{
				// set time, it's in milliseconds
				var today = new Date();
				today.setTime( today.getTime() );

				/*
				if the expires variable is set, make the correct
				expires time, the current script below will set
				it for x number of days, to make it for hours,
				delete * 24, for minutes, delete * 60 * 24
				*/
				if ( expires )
				{
				expires = expires * 1000 * 60 * 60 * 24;
				}
				var expires_date = new Date( today.getTime() + (expires) );

				document.cookie = name + "=" +escape( value ) +
				( ( expires ) ? ";expires=" + expires_date.toGMTString() : "" ) +
				( ( path ) ? ";path=" + path : "" ) +
				( ( domain ) ? ";domain=" + domain : "" ) +
				( ( secure ) ? ";secure" : "" );
				}
   		
});
 </script>
