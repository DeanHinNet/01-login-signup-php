<?php
session_start();

require('new-connection.php');


//santize each $_POST entry
foreach($_POST as $key => $value)
{
	$value = escape_this_string($value);
}


if(isset($_POST['action']) && $_POST['action'] == 'register')
{
	//check if username exists
	$query = "SELECT user.email FROM users WHERE user.email = '{$_POST['email']}'";
	$credentials = fetch_record($query);

	if(!isset($credentials))
	{

	} 
	else
	{
		$_SESSION['error']['register'] = 'User with that email address already exists! Please Login.';
		header('location: thewall.php');
		exit();
	}
}

if(isset($_POST['action']) && $_POST['action'] == 'login')
{

}

//Once a user is registered and/or login in, here are the options
if(isset($_POST['action']) && $_POST['action'] == 'add_incident')
{

}

if(isset($_POST['action']) && $_POST['action'] == 'report')
{

}


if(isset($_POST['action']) && $_POST['action'] == 'delete')
{


}



?>