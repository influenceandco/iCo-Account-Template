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
	
	$new = $_POST["is_new"];
	
	
	$clearance_level = 0;
	
	$password = $_POST["password"];
	$salt     = sha1(md5($password));
    $password = md5($password . $salt);	
	
	if($firstname && $lastname && $email && $password){

		mysql_query("INSERT INTO users (firstname, lastname, email, password, clearance_level, date_created, date_updated, author) VALUES ('$firstname', '$lastname', '$email', '$password', '$clearance_level', NOW(), NOW(), '$author')")or die(mysql_error());
		$id = mysql_insert_id();
		
		if($new == 1){
		    $_SESSION['user'] = $id;
	        $_SESSION['email'] = $email;
	        $_SESSION['firstname'] = $firstname;
	        $_SESSION['lastname'] = $lastname;
	        $_SESSION['clearance_level'] = 0;
		}
		
		echo true;
	}else{
		echo "Something went wrong. Please try again later.";
	}


?>