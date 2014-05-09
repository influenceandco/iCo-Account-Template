<?php session_start(); if(!$_SESSION["user"] || $_SESSION["clearance_level"] < 1){header("Location: ../login");} ?>
<?php include("../scripts/dbconnect.php");?> <!-- connect to database-->
<?php include("../snippets/header.php");?><!-- header-->

<title>Manage Users | Influence & Co.</title> <!--title of page -->
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
					<div class="row-fluid">
						<div class="span8">
							<div id="new_user">
								<h3>Add new user</h3>
								<form id="register_form">
								
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
									<button>Add user</button>
									<div class="error" id="register_error"></div>								
								</form>
							</div>
						</div>
					</div>
					<div class="linebreak"></div>
					
					<input id="searchbar" type="text" placeholder="Search users">
					<ul id="user_list">
					
					</ul>
				</div>
			</div>
		</div>

	</div>


<!-- end of body -->
<?php include("../snippets/javascripts.php");?> <!--global javascripts -->
<script src="../assets/js/check.session.min.js"></script>

<!--any other custom scripts here-->
<script type="text/javascript">
$("#users").addClass("active");

var clearance_level = <?php echo $_SESSION["clearance_level"];?>;

var number = 0;
var nodata = false;
var request = $.ajax();
var search = "";

$(document).ready(function(){
	  $.fn.editable.defaults.mode = 'inline';
      getData();	 
});

$(window).scroll(function () {


   if ($(window).scrollTop() >= $(document).height() - $(window).height() && nodata !== true) {
      getData();
      request.abort();
   }
});


function getData(){
	var data = {
		number: number,
		search: search
	};
	request = $.ajax({
	     type: "POST",
	     url: "../scripts/user_data.php",
	     data: data,
	     success: function (res) {
			 	res = $.parseJSON(res);
			 	for(var i = 0; i<res.length; i++){
				 	
				 	userHTML(res[i]);
				 	
				 	number++;
			 	}
			 	activateUserEdit()
			 	
			 	if(res.length == 0){
				 	nodata = true;
				 		if($("#user_list li").length == 0){
					 	$("#user_list").html("<div class='error'>No users found.</div>");
				 	}
			 	}
	     }
	});
	
}

$("#searchbar").keyup(function(){

	search = $(this).val();
	number = 0;
	$("#user_list").empty();
	nodata = false;
	request.abort();
	getData();
	
});


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
            minlength: 5,
            pwcheck:true,
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
        $("#register_error").html('<div class="spinner"><span class="fa fa-spinner fa-spin"></span></div>');
        
        var register_password = $('#register_password').val();
        var register_firstname = $('#register_firstname').val();
        var register_lastname = $('#register_lastname').val();
        var register_email = $('#register_email').val();

        var data = {
            password: register_password,
            firstname: register_firstname,
            lastname: register_lastname,
            email: register_email,
        }; 

        $.ajax({
            type: "POST",
            url: "../scripts/register.php",
            data: data,
            success: function (res) {
            
				$("#register_error").html("");
				            	
            	 if (res == true) {
					 	$("#register_form input").each(function(){
	            	 		$(this).val("");
            	 		});
            	 		
				 		$(".validation").each(function(){
	            	 		$(this).hide();
            	 		});   
            	 		        	 
                   		search = "";
						number = 0;
						$("#user_list").empty();
						nodata = false;
						request.abort();
						getData();
                 }else{
                     $("#register_error").html(res).hide().fadeIn().delay(2000).fadeOut();
                 }
            }
        });
    }
});

function userHTML(data){

   var user_data = '<a href="../account/?id='+data["id"]+'" data-id="'+data["id"]+'" data-level="'+data["clearance_level"]+'">'+data["firstname"]+' '+data["lastname"]+'</a>';	
    var level = "User";
    
    switch(parseInt(data["clearance_level"])){
	    case 0:
	    	level = "User";
	    break;
	    
	    case 1:
	    	level = "Admin";
	    break;
	    
	    case 2:
	    	level = "Super Admin";
	    break;
    }
    
    var editable_level = "";
    
    switch(parseInt(clearance_level)){
	    case 0:
	    	 editable_level = level;
	    break;
	    
	    case 1:
	    	if(data["clearance_level"] == 2){
		    	editable_level = level;
	    	}else{
				editable_level = '<a href="#" id="editable_level_'+data["id"]+'" class="editable_level"  data-type="select" data-name="clearance_level" data-url="../scripts/edit_user_info.php" data-pk="'+data['id']+'"></a>';
	    	}
	    break;
	    
	    case 2:
			editable_level = '<a href="#" id="editable_level_'+data["id"]+'" class="editable_level"  data-type="select" data-name="clearance_level" data-url="../scripts/edit_user_info.php" data-pk="'+data['id']+'"></a>';
	    break;
    }

	var html = '<li>'+
		  			'<div class="user_name user_section">'+
		  				user_data+
		  			'</div>'+
		  			'<div class="user_level user_section">'+
		  				editable_level+
		  			'</div>'+
		  			'<div class="user_remove user_section" data-id="'+data["id"]+'">'+
		  				'<i class="fa fa-minus-circle"></i>'+
		  			'</div>'+
	  			'</li>';
	
	$(html).appendTo("#user_list").hide().fadeIn();
	
	if(clearance_level > 1){
		 $('#editable_level_'+data["id"]).editable({
	        value: parseInt(data["clearance_level"]),    
	        source: [
	              {value: 0, text: 'User'},
	              {value: 1, text: 'Admin'},
	              {value: 2, text: 'Super Admin'}
	           ],
	        showbuttons: false
	
			});
	}else{
	 	$('#editable_level_'+data["id"]).editable({
        value: parseInt(data["clearance_level"]),    
        source: [
              {value: 0, text: 'User'},
              {value: 1, text: 'Admin'},
           ],
        showbuttons: false

		});	
	}
}




//activate editing and removing of user
function activateUserEdit(){

	$("#user_list").unbind("mouseenter");
	$("#user_list li").unbind("mouseleave");
	$("#user_list li").mouseenter(function(){
		if(($(this).children(".user_name").children("a").data("level") == 0 && clearance_level > 0) || ($(this).children(".user_name").children("a").data("level") == 1 && clearance_level > 1)){
		    	$(this).children(".user_remove").children("i").show();
		}
	});
	$("#user_list li").mouseleave(function(){
		 if(($(this).children(".user_name").children("a").data("level") == 0 && clearance_level > 0) || ($(this).children(".user_name").children("a").data("level") == 1 && clearance_level > 1)){
		    $(this).children(".user_remove").children("i").hide();
		}
	});

	$(".user_remove i").unbind("click");
    $(".user_remove i").click(function(){
	     var id = $(this).parent().data("id");
	     var button = this;
	     
	     removeUser(id, this);
	});
}

//remove user from the system
function removeUser(id, button){
	showAlert("Delete user", "Are you sure you want to remove this user?  This cannot be undone.", "Cancel", "Submit", 
	function(){
	
		var data = {
	        id:id
	    };	    
		$.ajax({
		    type: "POST",
		    url: "../scripts/remove_user.php",
		    data: data,
		    success: function (res) {
		    
		        if(res == true){
					
					$(button).parent(".user_remove").parent("li").fadeOut(500, function(){
						$(this).remove();
					});
					

				}else{
					//error
				}
		    }
		  });		
	}, 
	function(){
		
	});  
}




</script>

</body>
</html>