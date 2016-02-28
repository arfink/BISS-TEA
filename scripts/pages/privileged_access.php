<?php

require_once("session_functions.php");

session_start();

$session = new session_functions;

if ($session->is_admin()) {
	$_SESSION["growl_type"] = "notice";
	$_SESSION["growl_message"] = "You are an admin";
	return true;
}
else {
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "You are not an admin";
	return false;
}

?>