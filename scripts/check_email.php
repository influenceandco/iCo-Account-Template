<?php

session_start();
include('../scripts/dbconnect.php');

$email = $_POST['email'];
$email = mysql_real_escape_string($email);


if ($email) {

	$email = strtolower($email);

	$query = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());

	$numrows = mysql_num_rows($query);
	if ($numrows != 0) {
		echo false;
				
	}else{
		echo true;
	}

	
} else {
	echo false;
}



?>
