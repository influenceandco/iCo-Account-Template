<?php
session_start();
include('../scripts/dbconnect.php');

$email = $_POST['email'];
$email = mysql_real_escape_string($email);
$password = $_POST['password'];
$password = mysql_real_escape_string($password);

if ($email && $password) {
    $email = strtolower($email);
    $query = mysql_query("SELECT * FROM users WHERE email = '$email'") or die(mysql_error());
    
    $numrows = mysql_num_rows($query);
    
    if ($numrows != 0) {
        //code to login
        while ($row = mysql_fetch_assoc($query)) {
            $dbemail = $row['email'];
            $dbpassword = $row['password'];
            $email = $row['email'];
            $id = $row['id'];
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $clearance_level = $row['clearance_level'];
        }
        
        $salt     = sha1(md5($password));
        $password = md5($password . $salt);
        
        //check to see if they match!
        if ($email == $dbemail && $password == $dbpassword) {
            $_SESSION['user'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['clearance_level'] = $clearance_level;
            echo true;
            
        } else {
        	$error = "Invalid email or password.";
            echo $error;
        }
        
    } else {
        $error = "Invalid email or password.";
        echo $error;
    }
    
} else {
    $error = "Please enter a email and password";
    echo $error;
    
}
?>