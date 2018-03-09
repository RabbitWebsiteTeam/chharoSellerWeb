<?php 
include_once('config.php');

if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId']) ){
	 header('Location:index.php');
}
?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content"> 

      	
	 <div class="row">
      
        <!-- /.col -->

        <div class="col-md-12">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
           <!--    <i class="fa fa-bar-chart-o"></i> -->

            <!--   <h3 class="box-title">Bar Chart</h3> -->

            <!--   <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->
            </div>
            <div class="box-body">

              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="info-box bg-red">
                    <span class="info-box-icon"><i class="fa fa-times-circle"></i></span>
                    <div class="info-box-content">                     
                        <h2>
                           Transaction Cancelled
                        </h2>
                      <p> Your request couldn't be processed. Please try again some time.</P>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <a href="home.php" type="button" class="btn btn-block btn-primary btn-lg">Goto Home</a>
                </div>
             </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
     </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->
 <?php include_once('footer.php');?>

<script src="bower_components/Flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="bower_components/Flot/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="bower_components/Flot/jquery.flot.pie.js"></script>
<!-- FLOT CATEGORIES PLUGIN - Used to draw bar charts -->
<script src="bower_components/Flot/jquery.flot.categories.js"></script>
<!-- Page script -->

