<?php

function connect_to_mysql()
{
	$servername = "localhost";
	$username = "php";
	$password = "password";

	$database = "biss";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);

	// Check connection
	if ($conn->connect_error) {
		//die("Connection failed: " . $conn->connect_error);
		return FALSE;
	} 

	echo "connected successfully";
	return $conn;
}

?>
