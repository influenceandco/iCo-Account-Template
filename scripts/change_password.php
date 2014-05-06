<?php

	session_start();
	$user = $_SESSION["user"];
	include("../scripts/dbconnect.php");
	
	$new_password = $_POST["new_password"];
	$new_password = mysql_real_escape_string($new_password);
	$old_password = $_POST["old_password"];
	$old_password = mysql_real_escape_string($old_password);
	
	
    $salt     = sha1(md5($old_password));
    $old_password = md5($old_password . $salt);
	
	$data = mysql_query("SELECT * FROM users WHERE id = '$user' AND password = '$old_password'") or die(mysql_error());
	
	if(mysql_num_rows($data) > 0){
	
		$salt     = sha1(md5($new_password));
		$new_password = md5($new_password . $salt);
		
		mysql_query("UPDATE users SET password = '$new_password' WHERE id = '$user'")or die(mysql_error());
		echo true;
		
	}else{
		echo "Incorrect Password.";
	}
	
	
	



?>