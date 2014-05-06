<?php
	session_start();
	$author = $_SESSION["user"];

	include("../scripts/dbconnect.php");
	
	$firstname = $_POST["firstname"];
	$firstname = mysql_real_escape_string($firstname);
	$lastname = $_POST["lastname"];
	$lastname = mysql_real_escape_string($lastname);
	$email = $_POST["email"];
	$email = mysql_real_escape_string($email);
	
	$clearance_level = 0;
	
	$password = $_POST["password"];
	$salt     = sha1(md5($password));
    $password = md5($password . $salt);	
	
	mysql_query("INSERT INTO users (firstname, lastname, email, password, clearance_level, date_created, date_updated, author) VALUES ('$firstname', '$lastname', '$email', '$password', '$clearance_level', NOW(), NOW(), '$author')")or die(mysql_error());
	
	echo true;


?>