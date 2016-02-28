<?php
require_once "mysql_functions.php";

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
		//connect
		$conn = connect_to_mysql();

		//we want to select by user id using $session["user_id"]
		$sql = "select * from users where id = ".$_SESSION["user_id"].";";

		//find record by user id number
		$result = $conn -> query($sql);

		//make sure we get a record back
		if ($result->num_rows !== 1)
			return false;

		//get the row data
		$row = mysqli_fetch_array($result);

		// get the user's permissions level. value 1 is admin
		$user_level = $row["perm_level"];

		if ($user_level == 1) {
			return true;
		}
		else 
			return false;

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
		if ($result->num_rows !== 1)
			return false;

		// get the first row
		$row = mysqli_fetch_array($result);	

		// get the password hash
		$db_passhash = $row["password_hash"];


		//compare password hash, if true, set session vars
		if (password_verify($password, $db_passhash)) {
			$_SESSION["logged_in"] = true;
			$_SESSION["user_id"] = $row["id"];
			$_SESSION["username"] = $row["username"];
			return true;
		}
		else
			return false;
	}

	function signup()
	{
		echo "here";
	}
}

?>
