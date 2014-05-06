<?php session_start(); if(!$_SESSION["user"]){header("Location: ../login");}
include("../scripts/dbconnect.php");

	if($_GET["id"]){
		$user = $_GET["id"];
		$data = mysql_query("SELECT * FROM users WHERE id='$user' LIMIT 1")or die(mysql_error());
		if(mysql_num_rows($data) > 0){
			while($info = mysql_fetch_array($data)){
				$user = $info["id"];	
				$firstname = $info["firstname"];
				$lastname = $info["lastname"];
				$email = $info["email"];
				
				if($_SESSION["user"] == $user){
					$my_account = 1;
				}else{
					$my_account = 0;
				}
			}
		}else{
			header("Location: ../");
		}
		
			
	}else{
		$user = $_SESSION["user"];	
		$firstname = $_SESSION["firstname"];
		$lastname = $_SESSION["lastname"];
		$email = $_SESSION["email"];
		$my_account = 1;
	}

?>


<?php include("../snippets/header.php");?><!-- header-->

<?php if($my_account == 1){?>
	<title>My Account | Influence & Co.</title>
<? }else{ ?>
	<title><?php echo $firstname." ".$lastname."'s";?> Account | Influence & Co.</title>
<? } ?>		
<!--body goes here-->
	<?php include("../snippets/alert_modal.php");?>
	<?php include("../snippets/navbar.php");?>

	<div id="main_section">
		<div class="container">
			<div class="row-fluid">
				<div class="span3">
					<?php include("../snippets/side_menu.php");?>
				</div>
				<div class="span9">	
					<?php if($my_account == 1){?>
						<h3>My account settings</h3>
					<? }else{ ?>
						<h3><?php echo $firstname." ".$lastname."'s";?> account settings</h3>
					<? } ?>				
					
					<div class="editable_section">
						<label>First name:</label>
						<a href="#" class="editable_info_first" data-type="text" data-name="firstname" data-url="../scripts/edit_user_info.php" data-pk="<?php echo $user;?>" placeholder="Press enter to save"><?php echo $firstname;?></a>
					</div>
					<div class="editable_section">
						<label>Last name:</label>
						<a href="#" class="editable_info" data-type="text" data-name="lastname" data-url="../scripts/edit_user_info.php" data-pk="<?php echo $user;;?>" placeholder="Press enter to save"><?php echo $lastname;?></a>
					</div>
					<div class="editable_section">
						<label>Email address:</label>
						<a href="#" class="editable_info" id="editable_email" data-type="email" data-name="email" data-url="../scripts/edit_user_info.php" data-pk="<?php echo $user;?>" placeholder="Press enter to save"><?php echo $email;?></a>
					</div>			
					
					<div class="linebreak"></div>
					<?php if($my_account == 1){?>
					<div class="row-fluid">
						<div class="span8">
							<h3>Change password</h3>
							<div id="change_password">
			  					<form id="password_form" action="" method="POST">
			  						<label>New Password</label>
			  						<input type="password" placeholder="New Password" name="new_password" id="new_password" class="input-block-level">
			  						<label>Confirm Password</label>
			  						<input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password" class="input-block-level">
			  						<label>Old Password</label>
			  						<input type="password" placeholder="Old Password" name="old_password" id="old_password" class="input-block-level">
			  						<div class="clearfix"></div>
			  						<button>Save</button>
			  						
			  						<div id="password_error" class="error"></div>
			  					</form>
			  				</div>	
						</div>	
				    </div> 			
					<? } ?>				
				</div>
			</div>
		</div>

	</div>


<!-- end of body -->
<?php include("../snippets/footer.php");?> <!--global footer -->

<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<script src="../assets/js/check.session.min.js"></script>

<!--any other custom scripts here-->
<script type="text/javascript">

$(document).ready(function(){

   $.fn.editable.defaults.mode = 'inline';
   var clearance_level = <?php echo $_SESSION["clearance_level"];?>;
   var my_account = <?php echo $my_account;?>;
   if(my_account == 1){
	  $("#account").addClass("active");
   }
 
  
   
   if(my_account == 1 || clearance_level > 1){
   		 $(".editable_info_first").editable({
		   showbuttons:false,
		   placeholder: "Press enter to save.",
		   success:function(res, newValue){
		   		if(res != true){
			       		showAlert("Error", res, "", "Ok", function(){}, function(){}, true);
		   		}else{
		   			if(my_account == 1){
			   			$("#first_name_area").html(newValue);
		   			}
		   		}
		   }
	   }); 
   
   
	   $(".editable_info").editable({
		   showbuttons:false,
		   placeholder: "Press enter to save.",
		   success:function(res){
		   		if(res != true){
			       		showAlert("Error", res, "", "Ok", function(){}, function(){}, true);
		   		}
		   }
	   });  
   }else{
	    $(".editable_info").editable('option', 'disabled', true);
   }
   

});
$.validator.addMethod("pwcheck", function(value) {
   return /^[A-Za-z0-9\d=!\-@._*]*$/.test(value) // consists of only these
       && /[A-Z]/.test(value) // has a lowercase letter
       && /\d/.test(value) // has a digit
});    

//validation for changing password form
$("#password_form").validate({
    rules: {
        new_password: {
            minlength: 5,
            pwcheck: true
        },
        confirm_password: {
            equalTo: "#new_password"

        },
        old_password: "required"
    },
    messages:{
	  new_password:{
		  pwcheck: "Password must include at least one upper-case and one numerical character.",
	  }  
    },
    submitHandler: function (form) {

       	$("#password_error").html('<div class="spinner"><i class="fa fa-spinner fa-spin"></i></div>');
        
        var new_password = $('#new_password').val();
        var old_password = $('#old_password').val();

        var data = {
            new_password: new_password,
            old_password: old_password
        };
         ///ajax here::::
        $.ajax({
            type: "POST",
            url: "../scripts/change_password.php",
            data: data,
            success: function (res) {
                if (res == true) {
                     $("#new_password").val("");
                     $("#confirm_password").val("");
                     $("#old_password").val("");
                     $("#password_error").html('Your information has been saved').hide().fadeIn().delay(2000).fadeOut();

                } else {
                    $("#password_error").html(res).hide().fadeIn().delay(2000).fadeOut();;
                }
            }
        });
    }
});


</script>

</body>
</html>