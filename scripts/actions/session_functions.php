<?php
require "mysql_functions.php";

class session_functions {

	function verify_login()
	{
		echo "here";
	}

	function logout()
	{
		//set session variables and redirect to login page
		$_SESSION["logged_in"] = FALSE;
		$_SESSION["user_name"] = "";
	}

	function signup()
	{
		echo "here";
	}
}

?>
