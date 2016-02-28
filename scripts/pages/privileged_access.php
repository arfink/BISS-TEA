<?php
require_once("/usr/share/BISS-TEA/scripts/actions/session_functions.php");

session_start();

$session = new session_functions;

if ($session->is_admin()) {
	$_SESSION["growl_type"] = "notice";
	$_SESSION["growl_message"] = "You are an admin";
	}
else {
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "You are not an admin";
}

?>