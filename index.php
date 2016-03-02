<?php

//place for all custom mysql helper functions
require "scripts/actions/mysql_functions.php";

//start them engins!
//
//this guy stores everything about the particular instance which is running
//this is what is used to see if a user is logged in, etc...
session_start();

//don't use the html template when going to login page, use other html page
function serve_login_page()
{
	$html = file_get_contents("templates/login.html");

	$growl = get_growl();
	$html = str_replace("==growl==", $growl, $html);	

	echo $html;
}

//don't use the html template when going to login page, use other html page
function serve_signup_page()
{
	$html = file_get_contents("templates/signup.html");

	$growl = get_growl();
	$html = str_replace("==growl==", $growl, $html);	

	echo $html;
}


//make sure the url entered is valid
function validate_url($url_html, $url_php)
{
	if (!file_exists($url_html) && !file_exists($url_php))
		return FALSE;

	return TRUE;
}

// this function grabbs the session variables "growl_type" and "growl_message"
// and creates a notification for the user based on that.
//
// growl_type can be any of the following:
//
//     "error"
//     "warning"
//     "notice"
//
// growl message can be any string.
//
// so, just set those variables when something happens in a php file and you
// want to tell the user, it's that simple!
function get_growl()
{
	if (isset($_SESSION["growl_type"]) && $_SESSION["growl_type"] !== "none")
	{
		$growl_type = $_SESSION["growl_type"];
		$growl_message = $_SESSION["growl_message"];


		echo("here!");

		$growl = "$.growl.".$growl_type."({ message: '".$growl_message."' });";
	}
	else
	{
		$growl = "";
	}

	//clear out session variables for next use!
	$_SESSION["growl_type"] = "none";
	$_SESSION["growl_message"] = "";

	return $growl;
}


//parse url and serve up appropriate files
function parse($url)
{
	//parse $url.  Essentially we are going to take what is given and remove any extension
	$url_array = explode(".", $url);
	
	//define paths
	$url_name = substr($url_array[0], 1);
	$url_html = "templates".$url_array[0].".html";
	$url_php = "scripts/pages".$url_array[0].".php";

	if ($url_array[0] == "/login")
	{
		serve_login_page();
		return;
	}

	if ($url_array[0] == "/signup")
	{
		serve_signup_page();
		return;
	}

	if ($_SESSION["logged_in"] !== true)
	{
		serve_login_page();
		return;
	}

	//validate url
	if (!validate_url($url_html, $url_php))
	{
		$url_name = "home";
		$url_html = "templates/home.html";
		$url_php = "scripts/pages/home.php";
	}

	//load generic template file
	$html = file_get_contents("templates/HTMLTemplate");

	//load body file
	$body = file_get_contents($url_html);

	$has_permission = true;

	//clear out permission variable

	//execute page specific php, if it exists
	file_exists($url_php);	
	include $url_php;

	//check permission variable against user account.
	//If permission variable not set, die loudly
	if (!$has_permission)
	{
		return;
	}

	$html = str_replace("==active==", $url_name, $html);	

	//push body content into $html
	$html = str_replace("==body==", $body, $html);	

	$growl = get_growl();
	$html = str_replace("==growl==", $growl, $html);	

	//echo out resulting webpage
	echo $html;
}

//check if user is logged in, if not return to the login screen and exit
parse($_SERVER["REQUEST_URI"]);


?>
