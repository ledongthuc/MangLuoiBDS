<?php 
	session_start();
	if($_SESSION['security_code'] == $_GET['captcha']) {		
		echo "true";
	} else {
		echo "false";
	}

?>