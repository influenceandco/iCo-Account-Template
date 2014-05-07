<?php
include("../scripts/dbconnect.php");


function sendEmail($title, $body, $subject, $email){
	

$html = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\" xmlns=\"http://www.w3.org/1999/xhtml\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\">
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
    <link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800\" rel=\"stylesheet\" type=\"text/css\" />
    <title>".$title."</title>
    <style>
<![CDATA[
/* -------------------------------------
		GLOBAL
------------------------------------- */
* {
	margin: 0;
	padding: 0;
	font-family: \"Open Sans\", \"Helvetica Neue\", \"Helvetica\", Helvetica, Arial, sans-serif;
	font-size: 100%;
	line-height: 1.6;
	font-weight: 300;
}
h1, h2, h3, h4, h5, h6{
	font-weight: 300;
}
img {
	max-width: 100%;
}

body {
	-webkit-font-smoothing: antialiased;
	-webkit-text-size-adjust: none;
	width: 100%!important;
	height: 100%;
}


/* -------------------------------------
		ELEMENTS
------------------------------------- */
.btn-primary {
	text-decoration: none;
	color: #FFF;
	background-color: #348eda;
	border: solid #348eda;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.btn-secondary {
	text-decoration: none;
	color: #FFF;
	background-color: #aaa;
	border: solid #aaa;
	border-width: 10px 20px;
	line-height: 2;
	font-weight: bold;
	margin-right: 10px;
	text-align: center;
	cursor: pointer;
	display: inline-block;
	border-radius: 25px;
}

.last {
	margin-bottom: 0;
}

.first {
	margin-top: 0;
}

.padding {
	padding: 10px 0;
}
a{
	color: #4CB9D2;
}
a:hover{
	color: #4CB9D2;
}

/* -------------------------------------
		BODY
------------------------------------- */
table.body-wrap {
	width: 100%;
	padding: 20px;
}

table.body-wrap .container {
	border: 1px solid #f0f0f0;
}


/* -------------------------------------
		FOOTER
------------------------------------- */
table.footer-wrap {
	width: 100%;	
	clear: both!important;
}

.footer-wrap .container p {
	font-size: 12px;
	color: #666;
	
}

table.footer-wrap a {
	color: #999;
}


/* -------------------------------------
		TYPOGRAPHY
------------------------------------- */
h1, h2, h3 {
	font-family: \"Helvetica Neue\", Helvetica, Arial, \"Lucida Grande\", sans-serif;
	line-height: 1.1;
	margin-bottom: 15px;
	color: #000;
	margin: 40px 0 10px;
	line-height: 1.2;
	font-weight: 200;
}

h1 {
	font-size: 36px;
}
h2 {
	font-size: 28px;
}
h3 {
	font-size: 22px;
}

p, ul, ol {
	margin-bottom: 10px;
	font-weight: normal;
	font-size: 14px;
}

ul li, ol li {
	margin-left: 5px;
	list-style-position: inside;
}

.container {
	display: block!important;
	max-width: 600px!important;
	margin: 0 auto!important; /* makes it centered */
	clear: both!important;

}

/* Set the padding on the td rather than the div for Outlook compatibility */
.body-wrap .container {
	padding: 20px;
	border: none !important;
	border-bottom: 10px solid #4CB9D2 !important;
} 

/* This should also be a block element, so that it will fill 100% of the .container */
.content {
	max-width: 600px;
	margin: 0 auto;
	display: block;

}

/* Let's make sure tables in the content area are 100% wide */
.content table {
	width: 100%;

}
#logo{
	width: 180px;
}
]]>
    </style>
  </head>
  <body bgcolor=\"#f6f6f6\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; margin: 0; padding: 0;\">


<table style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; width: 100%; margin: 0; padding: 20px;\"><tr style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"><td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"></td>
		<td bgcolor=\"#FFFFFF\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto; padding: 20px; border-color: #f0f0f0#f0f0f0#4CB9D2; border-style: none none solid; border-width: 1px 1px 10px;\">

			
			<div style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; max-width: 600px; display: block; margin: 0 auto; padding: 0;\">
			<table style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; width: 100%; margin: 0; padding: 0;\"><tr style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"><td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\">
						<img src=\"https://copymint.com/assets/img/logo.png\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; max-width: 100%; width: 180px; margin: 0; padding: 0;\" />
						<div style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\">
						".$body."
						</div>
					</td>
				</tr></table></div>
			
			
		</td>
		<td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"></td>
	</tr></table><table style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; width: 100%; clear: both !important; margin: 0; padding: 0;\"><tr style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"><td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"></td>
		<td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto; padding: 0;\">
			
			
			<div style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; max-width: 600px; display: block; margin: 0 auto; padding: 0;\">
				<table style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; width: 100%; margin: 0; padding: 0;\"><tr style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"><td align=\"center\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\">
							<p style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1.6; font-weight: normal; color: #666; margin: 0 0 10px; padding: 0;\">View your account at <a href=\"https://copymint.com\" style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; color: #999; margin: 0; padding: 0;\">CopyMint.com</a>.
							</p>
						</td>
					</tr></table></div>
			
			
		</td>
		<td style=\"font-family: 'Open Sans', 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif; font-size: 100%; line-height: 1.6; font-weight: 300; margin: 0; padding: 0;\"></td>
	</tr></table></body>
</html>";
	
	
	
	
	
	
	$to = $email;
	$message = $html;
	
	require_once('../scripts/PHPMailer/class.phpmailer.php');
	$mail = new PHPMailer(); // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true; // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 465; // or 587
	$mail->IsHTML(true);
	$mail->Username = $phpmailer_email;
	$mail->Password = $phpmailer_password;
	$mail->SetFrom( "noreply@influenceand.com", "Influence & Co.");
	$mail->Subject = $subject;
	$mail->Body = $message;
	$mail->AddAddress($to);
	if(!$mail->Send()){
	//	echo "Mailer Error: " . $mail->ErrorInfo;
	}else{
	//	echo "Message has been sent";
	}
	
}



?>