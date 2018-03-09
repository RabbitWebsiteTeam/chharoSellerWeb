
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
     
      <!-- search form -->
    
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">

        <li class="header">MAIN NAVIGATION

          <?php
          $uri = $_SERVER['REQUEST_URI'];
          //echo $uri; // Outputs: URI
          $array = explode('/', $uri);
          //print_r($array);
          $page =  $array['2'];
           if(!isset($page)){
            $page = 'home.php';
           }
          $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
           
          $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
          //echo $url; // Outputs: Full URL
           
          $query = $_SERVER['QUERY_STRING'];
          //echo $page;
          //echo $query; // Outputs: Query String
          ?>

        </li>
       <?php  if($_SESSION['username'] != '11110001'){ ?>
        
        <li <?php if($page == 'home.php') echo "class='active'"; ?> ><a href="home.php"><i class="fa fa-dashboard text-red"></i> Home </a></li>
        <li <?php if($page == 'orders.php') echo "class='active'"; ?> ><a href="orders.php"><i class="fa fa-reorder text-red"> </i> <span> View Orders</span></a></li>
       
        <li class="treeview <?php if(($page == 'addproduct_shop.php') || ($page == 'addproduct_hotel.php') || ($page == 'addproduct_restaurant.php')) { echo 'active';} ?>">
          <a href="#" actualUrl="#">
            <i class="fa fa-bullhorn text-red"></i> <span>Add Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?php if($page == 'addproduct_shop.php') echo "class='active'"; ?>><a href="addproduct_shop.php"><i class="fa fa-bullhorn"></i>Shop</a></li>
            <li <?php if($page == 'addproduct_restaurant.php') echo "class='active'"; ?>><a href="addproduct_restaurant.php"><i class="fa fa-bullhorn"></i>Restaurant</a></li>
            <li <?php if($page == 'addproduct_hotel.php') echo "class='active'"; ?>><a href="addproduct_hotel.php"><i class="fa fa-bullhorn"></i> Hotel</a></li>
          </ul>
        </li>
         <li <?php if($page == 'products.php') echo "class='active'"; ?>><a href="products.php"><i class="fa fa-database text-red"> </i> <span> View Products</span></a></li>
         <li ><a href="#" onclick="checkTPinFn('checkTPin.php','passbook.php')"><i class="fa fa-book text-red"> </i> <span> Passbook </span></a></li>
       
       <li <?php if($page == 'add_money.php') echo "class='active'"; ?>><a href="#" onclick="checkTPinFn('checkTPin.php','add_money.php')" > <i class="fa fa-money text-red"> </i> <span> Add Money</span></a></li>
      <li <?php if($page == 'pay_money.php') echo "class='active'"; ?>><a href="#"  onclick="checkTPinFn('checkTPin.php','pay_money.php')" > <i class="fa fa-money text-red"> </i> <span> Pay Money</span></a></li>
      <li <?php if($page == 'accept_money.php') echo "class='active'"; ?>><a href="accept_money.php"> <i class="fa fa-money text-red"> </i> <span> Accept Money</span></a></li>
      <li <?php if($page == 'withdraw_money.php') echo "class='active'"; ?>><a href="#"  onclick="checkTPinFn('checkTPin.php','withdraw_money.php')" ><i class="fa fa-money text-red"> </i> <span> Withdraw Money</span></a></li>

       
      <li <?php if($page == 'bookings.php') echo "class='active'"; ?>><a href="bookings.php"><i class="fa fa-reorder text-red"> </i> <span> View Bookings </span></a></li>
    
      <li <?php if($page == 'changetpin.php') echo "class='active'"; ?>><a href="changetpin.php"><i class="fa fa-key text-red"> </i> <span> Change T-Pin </span></a></li>
      <li <?php if($page == 'changepassword.php') echo "class='active'"; ?>><a href="changepassword.php"><i class="fa fa-key text-red"> </i> <span> Change Password </span></a></li>
      
        
        
      <li <?php if($page == 'support.php') echo "class='active'"; ?>><a href="support.php"><i class="fa fa-thumbs-o-up text-red"> </i> <span> Support </span></a></li>
      

     <?php } else{?>
		     <li><a href="passbook.php"><i class="fa fa-book text-red"> </i> <span> Passbook </span></a></li>
		  <?php }?>
        
      <!--  <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>View Reports</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">4</span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="3"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
          </ul>
        </li>
     
        <li class="treeview">
          <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Products</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="fa fa-circle-o"></i> Add Products</a></li>
            <li><a href=""><i class="fa fa-circle-o"></i> View Products </a></li>
            </ul>
        </li>
        
       
         -->
       
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>


 <script type="text/javascript">
   function checkTPinFn(clickedURL,actualUrl){
    // var clickedURL = a; //$(this).children('a').attr('href');
     //var actualUrl = b; //$(this).children('a').attr('actualUrl');
     //alert(clickedURL);
     //alert(actualUrl);

      if(actualUrl == 'undefined' || actualUrl == undefined){       
        window.location.replace(clickedURL);
      }else{
        //alert('actualUrl');
        localStorage.setItem('succUrl',actualUrl);
        window.location.replace(clickedURL);

      }      
      return false; 
  }
</script>
