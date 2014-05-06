<?php
    session_start();if(!$_SESSION["user"]){die("Session has expired.");}
    $editor = $_SESSION["user"];
	include("../scripts/dbconnect.php");
	$user_id = $_POST["id"];
	if($editor == $user_id){
		echo "You cannot delete yourself.";
	}else{
		mysql_query("DELETE FROM users WHERE id = '$user_id'")or die(mysql_error());
		echo true;

	}
	
?>