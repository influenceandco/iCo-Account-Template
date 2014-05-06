$(document).ready(function(){
	checkSession();
	
	setInterval(function(){
		checkSession();
	}, 1000);
	
});
function checkSession(){
	$.ajax({
	     type: "POST",
	     url: "../scripts/check_session.php",
	     data: {},
	     success: function (res) {
			 if(res != true){
				 showAlert("Session expired", "Your session has expired.  Please logout and log back in.", "", "Ok", function(){
					 window.location = "../scripts/logout.php";
				 }, null, true, true)
			 }else{
				 
		     }
	     }
	});
	
}
