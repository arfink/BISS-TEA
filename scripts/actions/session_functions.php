<?php
require "mysql_functions.php";

class session_functions {

	function logout()
	{
		//set session variables and redirect to login page
		$_SESSION["logged_in"] = false;
		$_SESSION["user_name"] = "";
	}


	// checks a user's permission level
	function is_admin()
	{

	}


	// verifys a user's credentials
	function login_verify($email, $password)
	{
		//connect to db
		$conn = connect_to_mysql();

		$sql = "select * from users where user_email = '".$email."';";

		// find user record via email
		$result = $conn -> query($sql);

		// make sure we got a record back
		if ($result->num_rows != 1)
			return false;


		// get the first row
		$row = mysqli_fetch_array($result);	

		// **WARNING DO NOT USE IN PRODUCTION**
		// temporary login using plaintext password stored in "password_hash"

		$db_passplain = $row["password_hash"];

		if (strcmp ($db_passplain, $password) == 0)
			return true;
		else
			return false;
		

		// get the password hash
		//$db_passhash = $row["password_hash"]


		//compare password hash
		//if (password_verify($password, $db_passhash))
		//	return true;
		//else
		//	return false;
	}

	function signup()
	{
		echo "here";
	}
}

?>
