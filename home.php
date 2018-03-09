<?php 
include_once('config.php');

if(empty($_SESSION['SessionChharo']) || empty($_SESSION['customerId']) ){
	 header('Location:index.php');
}else{
	
	$_SESSION['SessionChharo'];
	
	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => domain."/chharomphttp/marketplace/getsellerdashboarddata",
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_ENCODING => "",
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "POST",
	  CURLOPT_POSTFIELDS => "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"sessionId\"\r\n\r\n".$_SESSION['SessionChharo']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; name=\"storeId\"\r\n\r\n1\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data; 
    name=\"customerId\"\r\n\r\n".$_SESSION['customerId']."\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW--",
	  CURLOPT_HTTPHEADER => array(
		"cache-control: no-cache",
		"content-type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW"  
	  ),
	));
	$tmpfname = 'cookie.txt';
    curl_setopt($curl, CURLOPT_COOKIEJAR, $tmpfname);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $tmpfname);
		
	$response = curl_exec($curl);
	$err = curl_error($curl);
	curl_close($curl);

	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
	 // echo $response;
	  $responseData = json_decode($response);
    if(isset($responseData->error)){
	  if($responseData->error == 5){ 

        $curUrl = $_SERVER['REQUEST_URI'];
        $redirPath = checkSessionId($curUrl);
        header('Location: '.$redirPath);
          die;
  

  	 }
    }
	 // echo $responseData->total;
	  //echo '<pre>';
	  
	 // print_r($responseData);
  
	  $total = $responseData->total;
	  $today =$responseData->today;
	  $week =$responseData->week;
	  $month =$responseData->month;
	  $payout =$responseData->payout;
	  $graphData =$responseData->graphData;
    //print_r($graphData);
	  if(empty($graphData)){
      $graphData = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    $arr = Array ('JAN','FEB','MAR','APR','MAY','JUN','JAL','AUG','SEPT','OCT','NOV','DEC');
    $finalArr = array_combine($arr,$graphData);
    $arr1 = json_encode($finalArr);
	  /*
	  $payout =$responseData->payout;
	  $payout =$responseData->payout;
	  $payout =$responseData->payout;
	  $payout =$responseData->payout;
	  */
	  
	   
	  //exit;
	}

	
} //else session check
?>
<?php include_once('header.php') ;?>
<?php include_once('left_menu.php') ;?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content"> 

    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today's Income</span>
              <span class="info-box-number" id='todayInc'><?php if(isset($today)) { echo $today->amount;} ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
             <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Weekly Income</span>
              <span class="info-box-number" id='todayInc'><?php if(isset($week)) { echo $week->amount;} ?> </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
           
            <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Monthly Income</span>
              <span class="info-box-number" id='todayInc'><?php if(isset($month)) { echo $month->amount;} ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
       
        <!-- /.col -->
      </div>
      	
	 <div class="row">
      
        <!-- /.col -->

        <div class="col-md-12">
          <!-- Bar chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
               <?php  if($responseData =='')
                {
                  echo 'No data found';
                } ?>
           <!--    <i class="fa fa-bar-chart-o"></i> -->

            <!--   <h3 class="box-title">Bar Chart</h3> -->

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div id="bar-chart" style="height: 300px; padding: 0px; position: relative;"><canvas class="flot-base" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 23px; text-align: center;">JAN</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 106px; text-align: center;">February</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 197px; text-align: center;">March</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 286px; text-align: center;">April</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 372px; text-align: center;">May</div><div class="flot-tick-label tickLabel" style="position: absolute; max-width: 84px; top: 283px; left: 454px; text-align: center;">June</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;"><div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 7px; text-align: right;">0</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 203px; left: 7px; text-align: right;">5</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 135px; left: 1px; text-align: right;">10</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 68px; left: 1px; text-align: right;">15</div><div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">20</div></div></div><canvas class="flot-overlay" width="509" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 509.5px; height: 300px;"></canvas></div>
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
<script>
  $(function () {
   
    /*
     * BAR CHART
     * ---------
     */

     var dataJson = <?php echo $arr1; ?>;
    //console.log(dataJson);
    var JAN = dataJson.JAN;
    var FEB = dataJson.FEB;
    var MAR = dataJson.MAR;
    var APR = dataJson.APR;
    var MAY = dataJson.MAY;
    var JUN = dataJson.JUN;
    var JUL = dataJson.JUL;
    var AUG = dataJson.AUG;
    var SEPT = dataJson.SEPT;
    var OCT = dataJson.OCT;
    var NOV = dataJson.NOV;
    var DEC = dataJson.DEC;

    var bar_data = {
      data : [['JAN',JAN ], ['FEB', FEB], ['MAR', MAR], ['APR', APR], ['MAY', MAY],
       ['JUN', JUN],['JUL', JUL],['AUG', AUG],['SEPT', SEPT],['OCT', OCT],['NOV', NOV],['DEC', DEC]],
      color: '#dd4b39 '
    }


    $.plot('#bar-chart', [bar_data], {
      grid  : {
        borderWidth: 1,
        borderColor: '#f3f3f3',
        tickColor  : '#f3f3f3'
      },
      series: {
        bars: {
          show    : true,
          barWidth: 0.5,
          align   : 'center'
        }
      },
      xaxis : {
        mode      : 'categories',
        tickLength: 0
      }
    })
    /* END BAR CHART */

    
  })

</script>
