<?php
	include("../scripts/dbconnect.php");
	
	function generatePassword ($length=8 ) { // code to generate new password
	$password="" ;
	$possible="2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ" ;
	$maxlength = strlen($possible);

	if ($length > $maxlength) {
		$length = $maxlength;
	}

	$i = 0;

	while ($i < $length) {

		$char = substr($possible, mt_rand(0, $maxlength-1), 1);

		if (!strstr($password, $char)) {
			$password .= $char;
			$i++;
		}

	}

	return $password;

	}
	
	

	
	$email = $_POST["email"];
	$email = mysql_real_escape_string($email);
	$email = strtolower($email);

	$data = mysql_query("SELECT id FROM users WHERE email = '$email'")or die(mysql_error());
	
	if(mysql_num_rows($data) > 0){
		
		while($info = mysql_fetch_array($data)){
			$id = $info["id"];
		}
		
		$password = generatePassword();
		$hashpassword = $password;
		$salt     = sha1(md5($hashpassword));
		$hashpassword = md5($hashpassword . $salt);
		$safe_password = mysql_real_escape_string($hashpassword);
		
		mysql_query("UPDATE users SET password = '$safe_password' WHERE id = '$id'") or die(mysql_error());
		
		
		$to = $email;
		$subject = "CopyMint Password Recovery";
		$message = "The password for Influecena & Co. has been reset.  Use the following email address and password to login.<br><br>Email: ".$email."<br>Password: ".$password."<br><br>You can change your password at anytime in the account settings section. <br>";
				    
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: CopyMint <noreply@copymint.com>' . "\r\n";
		
		
		mail($to, $subject, $message, $headers);

		echo true;
		
	}else{
		echo true;
	}
	
	
	




	

?>
