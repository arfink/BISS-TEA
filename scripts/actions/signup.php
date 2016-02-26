<?php

require "mysql_functions.php";

session_start();

$email           = $_POST["email"];
$password        = $_POST["password"];
$password_verify = $_POST["password_verify"];


// verify password
if (strcmp($password, $password_verify) !== 0)
{
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "Passwords do not match!";
	header('Location: /signup');
	return;
}

// verify the email
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "The email address you entered is invlaid";
	header('Location: /signup');
	return;
}


// make sure email is not already taken
$conn = connect_to_mysql();
$sql = "select * from users where user_email = '".$email."';";
$result = $conn -> query($sql);
if ($result -> num_rows > 0)
{
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "This email address is already taken";
	header('Location: /signup');
	return;
}

// hash the password
$hash = password_hash($password, PASSWORD_DEFAULT);
$date = date('Y-m-d');

$sql = "INSERT INTO users
	(username, user_email, password_hash, date_created, date_modified, deleted)
	VALUES
	('".$email."', '".$email."', '".$hash."', '".$date."', '".$date."', 0);";
$result = $conn -> query($sql);


$_SESSION["logged_in"] = true;
$_SESSION["email"] = $email;

$_SESSION["growl_type"] = "notice";
$_SESSION["growl_message"] = "Account successfully created!";

header('Location: /home');

?>
