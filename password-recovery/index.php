<?php session_start(); if($_SESSION["user"]){header("Location: ../purchase-articles");} ?>
<?php include("../scripts/dbconnect.php");?> <!-- connect to database-->
<?php include("../snippets/header.php");?><!-- header-->
<title>Password Recovery | Influence & Co.</title> <!--title of page -->
<!--body goes here-->

<?php include( "../snippets/alert_modal.php");?>
<?php include("../snippets/navbar_landing.php");?>       

<div class="container">
	<div class="row-fluid">
		<div class="span6 offset3">
			<div class="form_wrapper">
				<div class="clearfix"></div>
				
				<div id="forgot_section"> 				
					<form id="forgot_form" action="" method="POST">
					
						<h3>Password Recovery</h3>
						<p>Enter the email address associated with your account.  Your password will then be reset and sent to your email address.</p>
		
						<label>Email Address</label>
						<input type="text" name="email" id="forgot_email" placeholder="Email Address" class="input-block-level">
						
						<div id="forgot_error" class="error"></div>
						<button>Submit</button>
					</form>
				</div>



			</div>
		</div>
	</div>
</div>
<!-- end of body -->
<?php include("../snippets/footer.php");?>
<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<!--any other custom scripts here-->
<script type="text/javascript">

/*********** PASSWORD RECOVERY VALIDATION *************/

$("#forgot_form").validate({

    rules: {
        email: {
	        required: true,
	        email: true
        }

    },
    submitHandler: function (form) {
        
        ///ajax here::::
        $("#forgot_error").html('<div class="spinner"><i class="fa fa-spinner fa-spin"></i></div>');
        
        var email = $("#forgot_email").val();

        var data = {
            email: email
        };
        
        $.ajax({
            type: "POST",
            url: "../scripts/forgot.php",
            data: data,
            success: function (res) {
                
                if(res == true){
                	$("#forgot_email").val("");
                
                     $("#forgot_error").html("Your new password has been sent to your email address").hide().fadeIn().delay(2000).fadeOut(function(){
	                     	$("#login_section").removeClass("cover");
							$("#login_section").addClass("show");
							
							$("#forgot_section").removeClass("show");
							$("#forgot_section").addClass("cover");
                     });

                }else{
                     
                     $("#forgot_error").html(res).hide().fadeIn().delay(2000).fadeOut();
                }
            }
        });
        
    }
});

</script>

</body>
</html>