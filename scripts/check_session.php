<?php
	session_start();
	if($_SESSION["user"] && $_SESSION["user"] != 0){
		echo true;
	}else{
		echo false;
	}

?>