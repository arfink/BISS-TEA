<?php
require_once("session_functions.php");

$session = new session_functions;

$_SERVER["REQUEST_URI"] = '/login';

header('Location: /index.php');


$session->logout();

?>
