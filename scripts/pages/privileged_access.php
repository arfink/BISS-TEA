<?php
require_once("/usr/share/BISS-TEA/scripts/actions/session_functions.php");
require_once("/usr/share/BISS-TEA/scripts/actions/mysql_functions.php");

session_start();

$session = new session_functions;

// make sure this user has permission to visit the admin page
if (!$session->is_admin())
{
	header('Location: /home');	
	$_SESSION["growl_type"] = "error";
	$_SESSION["growl_message"] = "You are not an admin";
	$has_permission = false;
}


// build users table
$conn = connect_to_mysql();
$sql = "select * from users;";
$result = $conn -> query($sql);

$users = "";

while($row = $result->fetch_assoc()){
	$users .= "<tr>";
	$users .= "<td>".$row['username'] . '</td>';
	$users .= "<td>".$row['user_email'] . '</td>';


	if ($row['perm_level'] == 1)
	{
		$admin = 'checked="checked"';
		$not_admin = "";
	}
	else
	{
		$admin = "";
		$not_admin = 'checked="checked"';
	}
	
	$users .= '
	<td>
		<label>
			<input class="permission_choice "type="radio" name="permissions_'.$row['id'].'" '.$admin.'">
			Admin
		</label>
		<label style="padding-left:20px">
			<input class="permission_choice "type="radio" name="permissions_'.$row['id'].'" '.$not_admin.'">
			Not Admin
		</label>
	</td>';

	$users .= "</tr>";
}

$body = str_replace("==users==", $users, $body);	

?>
