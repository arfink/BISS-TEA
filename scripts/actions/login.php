<?php

require_once("session_functions.php");

session_start();

$session = new session_functions;

if ($session->login_verify($_POST['email_name'], $_POST['password_name']))
{
	$_SESSION["logged_in"] = true;
	$_SESSION["email"] = $_POST['email_name'];

	$_SESSION["growl_type"] = "notice";
	$_SESSION["growl_message"] = "Successfully logged in!";
}
else
{
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "incorrect username or password";
}


header('Location: /index.php');

?>
