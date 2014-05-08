<?php session_start(); if($_SESSION["user"]){header("Location: ../dashboard");} ?>
<?php include("../scripts/dbconnect.php");?> <!-- connect to database-->
<?php include("../snippets/header.php");?><!-- header-->

<?php include("../snippets/alert_modal.php");?>

<title>Login | Influence & Co.</title> <!--title of page -->
<!--body goes here-->

<div class="container">
	<div class="row-fluid">
		<div class="span6 offset3">
			<h2>Login</h2>
			<form id="login_form" action="" method="POST">
				<label>Email Address</label>
				<input id="login_email" name="email" type="text" class="input-block-level" placeholder="Email Address">
				
				<label>Password</label>
				<input id="login_password" name="password" type="password" class="input-block-level" placeholder="Password">

				<button>Login</button>
				<div class="clearfix"></div>
				<div class="error" id="login_error"></div>
				<div class="clearfix"></div>
				<div class="bottom_link">
					<a href="../signup">Sign up for new account.</a> <a href="../password-recovery">Forgot your password?</a>		
	
				</div>				
			</form>
		</div>
	</div>
</div>
<!-- end of body -->
<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<!--any other custom scripts here-->
<script type="text/javascript">


$("#login_form").validate({

    rules: {
        email: {
	        email:true,
	        required: true
        },
        password: {
	        required: true
        }

    },
    submitHandler: function (form) {
        $("#login_error").html('<div class="spinner"><i class="fa fa-spinner fa-spin"></i></div>');
                
        var login_email = $("#login_email").val();
        var login_password = $("#login_password").val();

        var data = {
            email: login_email,
            password: login_password,
        };
        
        $.ajax({
            type: "POST",
            url: "../scripts/login.php",
            data: data,
            success: function (res) {
            	 $("#login_error").html("");//remove loading icon here

                if(res == true){
                	window.location = "../dashboard";
                }else{
                        $("#login_error").html(res).hide().fadeIn().delay(2000).fadeOut();
                }
            }
        });
        
    }
});



</script>

</body>
</html>