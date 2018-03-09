<?php
include_once('config.php');

//print_r($_SESSION);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Chharo Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/red.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   <style>
  .error{
    color:red !important;
  }
  </style>
</head>
<body class="hold-transition login-page">


  <div class="register-box">
  <div class="register-logo">
    <a href="index.php"><b class="text-red">CHHARO SELLER</b></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="#" id="sellerReg" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
   
    <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
		
        <input type="text" class="form-control" placeholder="Mobile Number" name="phone" id="phone" maxlength="8">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email Id" name="email" id="email">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	   <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="T-Pin" name="tpin" id="tpin" maxlength="4">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Business Name" name="bname" id="bname">
        <span class="fa fa-briefcase  form-control-feedback"></span>
      </div>

      
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="pass" id="pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="repass" id="repass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label class="">
              <div class="icheckbox_square-red" aria-checked="false" aria-disabled="false" style="position: relative;"><input type="checkbox" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;" name="agree1" id="agree1"><ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" id="submitBtn" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
		<div class="col-xs-12 text-red" id="err">
         
        </div>
        <!-- /.col -->
      </div>
    </form>

  

    <a href="index.php" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="dist/js/jquery-validator.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-red',
      radioClass: 'iradio_square-red',
      increaseArea: '20%' // optional
    });
  });
</script>

 <script>
                $( document ).ready(function() {
                    //alert();
                 $.validator.addMethod("valueNotEquals", function(value, element, arg){
                      return arg !== value;
                     });
				$('#submitBtn').on('click', function() {
      
						 $("#sellerReg").validate({
							rules: {
								fname: { required : true, }, 
								
								lname: { required : true, }, 
								phone: { required : true, }, 
								email: { required : true,
										email : true,}, 
								tpin: { required : true, }, 
								bname: { required : true, }, 
								pass: { required : true,
										minlength : 8, }, 
								repass: { required : true, 
									   equalTo : "#pass",
									   }, 
								agree1: { required : true, }, 					
										  
							 },
							messages: {
							   
								fname:  { required : "Please enter first name",                                        
										},                               
								
								lname:  { required : "Please enter last name",                                        
										 },
								email:  { required : "Please enter email id",  
										email:"Please enter a valide mail id"  ,                           
										 }, 		 
								phone:  { required : "Please enter phone no",                                        
										  }, 
								tpin:  { required : "Please enter middle name",                                        
										},    
								bname:  { required : "Please enter business name",                                        
										  },
								pass:  { required : "Please enter password",
										  minlength : "Please enter minimum 8 charectors",                                        
										  },
								repass :  { required : "Please enter Re-password",
											equalTo : "Not matched to password" ,                                       
										  },  
								agree1:  { required : "Please agree the terms and conditions",}
							},

					  /*  submitHandler: function(form) {
							form.submit();
						}*/
						 submitHandler: function(form) {      
								
							   //alert('form');
								
								//$(this).find("button[type='submit']").prop('disabled',true);
							   
								var fname = $('#fname').val();
								var tpin = $('#tpin').val(); 
								 var lname = $('#lname').val();  
								var phone = $('#phone').val();
								var bname = $('#bname').val();
								var pass = $('#pass').val();
								var repass = $('#repass').val();
								var email = $('#email').val();
								
								
							   // alert(branch + ','+ center +','+date1 +','+maxCount);
								$.ajax({  
									  type: 'POST',
									  url: 'registerAjax.php',
									  data: {fname:fname,tpin:tpin,lname:lname,phone:phone,bname:bname,pass:pass,repass:repass,email:email  
									  },
									   beforeSend: function() {
											// setting a timeout
											$('#submitBtn').prop('disabled',true)
										},
									  success : (function(data) {
										  console.log(data);
										    var b=JSON.parse(data);
											var status = b.status;
											if(status == 1){
												//$("#success_message").fadeIn(); 
												// $('#success_message').html(b.message);  
												  //$("#success_message").fadeOut(5000);  
												  console.log(b.message);
												  window.location.href = 'registerAddress.php';
												//$("#createSlotFrm")[0].reset();
											}else{
												 console.log(b.message); 
													
												$("#err").html(b.message);
											} 
									  }),
									  error : (function(){
										alert('Whoops! This didn\'t work. Please contact us.')
									  }),
									  complete: function() {
										$('#submitBtn').prop('disabled',false);
									},
								});
							 }// end submit handler
				 
								 
					});
			
				}); 
                });
            </script>
</body>
</html>
