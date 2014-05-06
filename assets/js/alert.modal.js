function showAlert(header, body, cancel, save, submitCallback, cancelCallback, hide, no_exit){
	$("#alert_header").html(header);
	$("#alert_body").html(body);
	$("#alert_cancel").html(cancel);
	$("#alert_submit").html(save);
	
	if(no_exit){
		$("#alert").modal({
			 backdrop: 'static',
			 keyboard: false
		});
		$("#close_alert_button").hide();
	}else{
		$("#alert").modal({
			 backdrop: true,
			 keyboard: true
		});
		$("#close_alert_button").show();		
	}
	
	$("#alert").modal("show");
	
	$("#alert_cancel").unbind("click");
	$("#alert_cancel").click(function(){
		$("#alert").modal("hide");
		cancelCallback();
	});
	$("#alert_submit").unbind("click");
	$("#alert_submit").click(function(){
		$("#alert").modal("hide");
		submitCallback();
	});
	
	if(hide == true){
		$("#alert_cancel").hide();
	}else{
		$("#alert_cancel").show();
	}
	
}
