<?php
include_once('config.php');
//print_r($_SESSION);
//$_SESSION['reg1Data'] = '';
if(empty($_SESSION['reg1Data'])){
	header('Location:register.php');
}
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
    <p class="login-box-msg">Add Address</p>

    <form action="#" id="sellerReg" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Shop Number" name="snumber" id="snumber">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
   
    <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Address" name="address" id="address">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
	  
      <div class="form-group has-feedback">
		
       <div class="form-group">
                
                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="city" id="city" >
				<option value="0"> Dzongkhang</option>
                  <option  value="Bumthang">Bumthang</option>
                  <option value="Chhukha">Chhukha</option>
                  <option value="Dagana">Dagana</option>
                  <option value="Haa">Haa</option>
				  <option value="Lhuentse">Lhuentse</option>
				  <option value="Mongar">Mongar</option>
				  <option value="Paro">Paro</option>
				  <option value="Pema Gatshel">Pema Gatshel</option>
				  <option value="Punakha">Punakha</option>
				  <option value="Samdrup Jongkhar">Samdrup Jongkhar</option>
				  <option value="Samtse">Samtse</option>
				  <option value="Sarpang">Sarpang</option>
				  <option value="Thimphu">Thimphu</option>
				  <option value="Trashigang">Trashigang</option>
				  <option value="Trashi Yangtse">Trashi Yangtse</option>
				  <option value="Trongsa">Trongsa</option>
				  <option value="Zhemgang">Zhemgang</option>
				  
                  
                </select> 
           </div>
      </div>
	  
	  <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Postal Code" name="pcode" id="pcode" maxlength="5">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
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
	  
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Answer" name="answer" id="answer">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div> 
	  
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-8">
          <button type="submit" id="submitBtn" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>


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
	$( document ).ready(function() {
		//alert();
   
	$('#submitBtn').on('click', function() {
			  $.validator.addMethod("valueNotEquals", function(value, element, arg){
		  return arg !== value;
		 });
			 $("#sellerReg").validate({
				rules: {
					snumber: { required : true, }, 								
					address: { required : true, }, 
					city: { valueNotEquals: "0" } ,
					pcode: { required : true,}, 
					squetion: { valueNotEquals: "0" } ,
					answer: { required : true, }, 
							  
				 },
				messages: {							   
					snumber:  { required : "Please enter shop number",	}, 
					address:  { required : "Please enter address", },
					city:  { valueNotEquals : "Please select Dzongkhang", }, 		 
					pcode:  { required : "Please enter postal code",}, 
					squetion:  { valueNotEquals : "Please select security question",},    
					answer:  { required : "Please enter answer",},
					
				},

		  /*  submitHandler: function(form) {
				form.submit();
			}*/
			 submitHandler: function(form) {      
					
				   //alert('form');
					
					//$(this).find("button[type='submit']").prop('disabled',true);
				   
					var snumber = $('#snumber').val();
					var address = $('#address').val(); 
					 var city = $('#city').val();  
					var pcode = $('#pcode').val();
					var squetion = $('#squetion').val();
					var answer = $('#answer').val();
					
				   // alert(branch + ','+ center +','+date1 +','+maxCount);
					$.ajax({  
						  type: 'POST',
						  url: 'registerAjax1.php',
						  data: {snumber:snumber,address:address,city:city,pcode:pcode,squetion:squetion,answer:answer  
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
									  alert('Register successfully'); 
									  window.location.href = 'index.php';
									//$("#createSlotFrm")[0].reset();
								}else{
									 console.log(b.message);                                     
									//$("#createSlotFrm")[0].reset();
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
