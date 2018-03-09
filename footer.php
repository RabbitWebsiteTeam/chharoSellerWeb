 <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="https://adminlte.io">CHHARO -SELLER
  </footer>


</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script>
$(function () {
 //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
})
</script>

 <!-- <script type="text/javascript">
	  $('li').click(function(e){
	   var clickedURL = $(this).children('a').attr('href');
	   var actualUrl = $(this).children('a').attr('actualUrl');
	   alert(clickedURL);
	   alert(actualUrl);

     if(clickedURL != '#' && actualUrl != '#'){

        if(actualUrl == 'undefined' || actualUrl == undefined){
          //alert('undefined case');
          
          window.location.replace(clickedURL);

        }else{
          //alert('actualUrl');
         localStorage.setItem('succUrl',actualUrl);
          window.location.replace(clickedURL);

        }
    }else{
      alert('else');
    }

	    
	    return false; 
	});
</script>
-->

    
</body>
</html>
