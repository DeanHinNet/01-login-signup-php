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

	//if there is no record register, else error warning
	if(!isset($credentials))
	{
		//If there is no email in the database, the registration process begins. All provided credentials are checked. If an entry is invalid or incomplete, an error message is generated and added to the $_SESSION['error'].
		foreach($_POST as $name => $value)
		{
			if(empty($value))
			{
				$_SESSION['error'][$name] = $name . " cannot be blank!";
			}
			else
			{
				switch($name)
				{
					case 'first_name':
					case 'last_name':
						if(is_numeric($value))
						{
							$_SESSION['error'][$name] = $name . ' cannot contain numbers.';
						}
					break;
					
					case 'email':
						if(!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION['error'][$name] = $name . ' is not a valid email.';
						}
					break;
					
					case 'password':
						if(strlen($value) < 5)
						{
							$_SESSION['error'][$name] = $name . ' must be greater than 5 characters.';
						}
					break;

					case 'confirm_password':
						if($_POST['password'] != $value)
						{
							$_SESSION['error'][$name] = 'Passwords do not match.';
						}
					break;
				}
			}
		}

		//If any errors were generated, go back to index and send the error messages for correction. Otherwise, create a database entry for the new user.
		if(isset($_SESSION['error']))
		{
			header('location: index.php');
			exit();
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$_POST['password']}', NOW(), NOW())";
			$_SESSION['user_id'] = run_mysql_query($query);
			$_SESSION['first_name'] = $_POST['first_name'];
			$_SESSION['success_message'] = 'You are now registered.';
			header('location: home.php'); //Logged in screen where options are.
			exit();
		}
	} 
	else
	{
		$_SESSION['error']['register'] = 'User with that email address already exists! Please Login.';
		header('location: index.php');
		exit();
	}
}//end register

//LOGIN
if(isset($_POST['action']) && $_POST['action'] == 'login')
{
	if(!empty($_POST['email']))
	{
		if(!empty($_POST['password']))
		{
			$query = "SELECT users.user_id, users.email, users.password FROM users WHERE users.email = '{$_POST['email']}'";
			$credentials = fetch_record($query);

			if(isset($credentials))
			{
				if($credentials['password'] == $_POST['password'])
				{
					$_SESSION['user_id'] = $credentials['user_id'];
					$query = "SELECT users.first_name FROM users WHERE users.user_id = '{$_SESSION['user_id']}'";
					$record = fetch_record($query);
					$_SESSION['first_name'] = $record['first_name'];
					header('location: home.php');
					exit();
				}
				else
				{
					$_SESSION['error']['login'] = 'Login with username/password that you entered does not exist.';
					header('location: index.php');
					exit();
				}
			}
			else
			{
				$_SESSION['error']['login'] = 'Login with username/password that you entered does not exist.'
				header('location: index.php');
				exit();
			}
		}
		else
		{
			$_SESSION['error']['password'] = 'Please enter your password to login.';
			header('location: index.php');
			exit();
		}
	}
	else
	{
		$_SESSION['error']['email'] = 'Please enter your email to login.';
		header('location: index.php');
		exit();
	}
}//end login

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