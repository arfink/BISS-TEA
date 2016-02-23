<?php

require_once("session_functions.php");

session_start();

$session = new session_functions;

if ($session->login_verify($_POST['email_name'],$_POST['password_name']))
{
	$_SESSION["logged_in"] = true;
	$_SESSION["user_name"] = $_POST['user'];
	echo "<br> we logged in OK";
}
else echo "<br> we failed login";

//header('Location: /index.php');
echo "<br> loginphp has finished";
?>