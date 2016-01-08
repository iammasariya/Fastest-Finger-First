<?php
	session_start();
	//this function is used to check whether user is logged in ,if he is return boolien 'true' 
	function logged_in() {
		return isset($_SESSION['refid']);
	}
	
	//this function is used in input forms
	function confirm_logged_in() {
		if (!logged_in()) {
			redirect_to("index.php?login=1");
		}
	}
?>
