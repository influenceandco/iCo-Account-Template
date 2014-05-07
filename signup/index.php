<?php session_start(); if($_SESSION["user"]){header("Location: ../dashboard");} ?>
<?php include("../scripts/dbconnect.php");?> <!-- connect to database-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    <meta name="description" content="">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <!-- Le styles -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-editable.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../assets/css/font-awesome.min.css"  rel="stylesheet">
    <link href="../assets/css/icomoon.css"  rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
         
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-49176808-1', 'copymint.com');
	  ga('send', 'pageview');
	
	</script>     
           
    
  </head>

  <body>
  
<div id='wrap'>
<title>Sign Up | Influence & Co.</title> <!--title of page -->
<!--body goes here-->

	<div class="container">
		<div class="row-fluid">
		
			<div class="span6 offset3">
				<div id="register_user">
					<div class="form_wrapper">
						<div class="clearfix"></div>
					
						<form id="register_form">
							<h3>Sign up.</h3>
							
							<label>First Name</label>
							<div class="right-inner-addon">
								<span class="validation"></span>
								<input class="input-block-level" id="register_firstname" type="text" name="firstname" placeholder="First Name">
							</div>
							<label>Last Name</label>
							<div class="right-inner-addon">
								<span class="validation"></span>
								<input class="input-block-level" id="register_lastname" type="text" name="lastname" placeholder="Last Name">	
							</div>
							<label>Email Address</label>
							<div class="right-inner-addon">
								<span class="validation"></span>
								<input class="input-block-level" id="register_email" type="text" name="email" placeholder="Email Address">	
							</div>
							<label>Password</label>
							<div class="right-inner-addon">
								<span class="validation"></span>
								<input class="input-block-level" id="register_password" type="password" name="password" placeholder="Password">	
							</div>		
							<label>Password Confirmation</label>
							<div class="right-inner-addon">
								<span class="validation"></span>
								<input class="input-block-level" id="register_password_confirm" type="password" name="confirm_password" placeholder="Password">	
							</div>						
							<button>Sign up</button>
							<div class="error" id="register_error"></div> 
							<div class="clearfix"></div>
							<div class="bottom_link">
								Already have an account? <a href="../login">Login here</a>		
							</div>	
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

 	
<?php include("../snippets/footer.php");?> <!--global javascripts -->
<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<!--any other custom scripts here-->
<script type="text/javascript">

$.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[A-Z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
});    

$.validator.addMethod("new_email", function(value) {
	var isSuccess = false;
    $.ajax({url: "../scripts/check_email.php", 
            data: {email:value}, 
			type: 'POST',
			async: false, 
            success: 
                function(res) { 
                	if(res == true){
	                	isSuccess = true;
                	}else{
	                	isSuccess = false;
                	}
                
                }
          });
    return isSuccess;
});

$("#register_form").validate({

    rules: {
        firstname: {
            required: true,

        },
        lastname: {
            required: true,
        },
        email: {
            required: true,
            email: true,
            new_email: true
        },
        password: {
            required: true,
            pwcheck:true,
            minlength: 5
        },
        confirm_password: {
            equalTo: "#register_password",
            required: true

        }
    },
    messages:{
      email:{
	      new_email:"Email already in use.",
      },
	  password:{
		  pwcheck: "Password must include at least one upper-case and one numerical character.",
	  }  
    },
	success: function(label, element){
		$(element).removeClass("form_error").siblings(".validation").show().removeClass("error").html("<i class='fa fa-check'></i>");
		
	},
	highlight: function(element, errorClass) {
	    $(element).addClass("form_error");	
		$(element).siblings(".validation").show().addClass("error").html("<i class='fa fa-exclamation-triangle'></i>");
	},
    submitHandler: function (form) {
    
        $("#register_error").html('<div class="spinner"><i class="fa fa-spinner fa-spin"></i></div>').show();
        
        var register_password = $('#register_password').val();
        var register_firstname = $('#register_firstname').val();
        var register_lastname = $('#register_lastname').val();
        var register_email = $('#register_email').val();

        var data = {
            password: register_password,
            firstname: register_firstname,
            lastname: register_lastname,
            email: register_email,
            is_new: 1
        }; 

        $.ajax({
            type: "POST",
            url: "../scripts/register.php",
            data: data,
            success: function (res) {
                        	
            	 if (res == true) {
        	 		  window.location = "../dashboard";
                 }else{
                     $("#register_error").html(res).hide().fadeIn().delay(2000).fadeOut();
                 }
            }
        });
    }
});

</script>

</body>
</html>