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
	    	For support or assistance
	      </h1>
	      <ol class="breadcrumb">
	        <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
	        <li><a href="">support </a></li>
	        
	      </ol>
	    </section>
	    <section class="content">
	      <div class="row">
	      		
		        <div class="col-md-6 col-sm-6 col-xs-12">

		          <div class="info-box">
		            <span class="info-box-icon bg-red"><i class="fa fa-phone-square"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-number">Please call us on</span>
		              <span class="info-box-text">02350766</span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
		        <!-- /.col -->
		        <div class="col-md-6 col-sm-6 col-xs-12">
		          <div class="info-box">
		            <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>

		            <div class="info-box-content">
		              <span class="info-box-number">Please write to us on</span>
		              <span class="info-box-text">chharo@bob.bt</span>
		            </div>
		            <!-- /.info-box-content -->
		          </div>
		          <!-- /.info-box -->
		        </div>
       
      </div>
	      <!-- /.error-page -->
	    </section>
	</div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>
 