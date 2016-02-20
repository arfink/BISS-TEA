<?php

require_once("session_functions.php");

session_start();

$session = new session_functions;

if ($session->login_verify())
{
	$_SESSION["logged_in"] = true;
	$_SESSION["user_name"] = $_POST['user'];
}

header('Location: /index.php');

?>
