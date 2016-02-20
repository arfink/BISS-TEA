<?php
require_once("session_functions.php");

session_start();

$session = new session_functions;

header('Location: /index.php');

$session->logout();

?>
