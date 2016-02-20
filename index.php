<?php

//place for all custom mysql helper functions
require "scripts/actions/mysql_functions.php";

//don't use the html template when going to login page, use other html page
function serve_login_page()
{
	$html = file_get_contents("templates/login.html");

	echo $html;
}

//don't use the html template when going to login page, use other html page
function serve_signup_page()
{
	$html = file_get_contents("templates/signup.html");

	echo $html;
}


//make sure the url entered is valid
function validate_url($url_html, $url_php)
{
	if (!file_exists($url_html) && !file_exists($url_php))
		return FALSE;

	return TRUE;
}

//parse url and serve up appropriate files
function parse($url)
{
	//parse $url.  Essentially we are going to take what is given and remove any extension
	$url_array = explode(".", $url);
	
	//define paths
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

	//validate url
	if (!validate_url($url_html, $url_php))
	{
		$url_html = "templates/home.html";
		$url_php = "scripts/pages/home.php";
	}

	//load generic template file
	$html = file_get_contents("templates/HTMLTemplate");

	//load body file
	$body = file_get_contents($url_html);

	//clear out permission variable

	//execute page specific php, if it exists
	file_exists($url_php);	
	include $url_php;


	//check permission variable against user account.
	//If permission variable not set, die loudly

	//push body content into $html
	$html = str_replace("==body==", $body, $html);	

	//echo out resulting webpage
	echo $html;
}

//start them engins!
//
//this guy stores everything about the particular instance which is running
//this is what is used to see if a user is logged in, etc...
session_start();


$_SESSION["logged_in"] = true;

//check if user is logged in, if not return to the login screen and exit
if ($_SESSION["logged_in"] == true)
	parse($_SERVER["REQUEST_URI"]);
else
	serve_login_page();


?>
