<?php
	session_start();
	include("../scripts/dbconnect.php");
	
	$title = $_POST['name'];
	$value = $_POST['value'];
	$value = mysql_real_escape_string($value);
	$id = $_POST['pk'];
	
	$date_updated = date('Y-m-d H:i:s');

	if($title == "email"){
		$value = strtolower($value);
		$data = mysql_query("SELECT id FROM users WHERE email = '$value'")or die(mysql_error());
		if(mysql_num_rows($data) > 0){
			die("Email already in use. Please select another.");
		}else{
		if($_SESSION["user"] == $id){
			$_SESSION[$title] = $value;
		}		
	}
	}else{
		if($_SESSION["user"] == $id){
			$_SESSION[$title] = $value;
		}		
	}

	
	
	
	mysql_query("UPDATE users SET $title = '$value', date_updated = '$date_updated' WHERE id = '$id'")or die(mysql_error());
	
	echo true;

?>