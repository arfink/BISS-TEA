<?php

function connect_to_mysql()
{
	$servername = "localhost";
	$username = "php";
	$password = "password";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
		//die("Connection failed: " . $conn->connect_error);
		echo "Failed!";
		return FALSE;
	} 

	echo "Connected successfully";
	return $conn;
}









?>
