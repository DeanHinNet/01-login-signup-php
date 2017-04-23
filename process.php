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
	$query = "SELECT users.email FROM users WHERE users.email = '{$_POST['email']}'";
	$credentials = fetch_record($query);

	//Record validation. IF there is no record register, else error warning.
	if(isset($credentials))
	{
		$_SESSION['errors']['register'] = 'User with that email address already exists! Please Login.';
		header('location: sign-up-in.php');
		exit();
	}
	else
	{	
		//Registration Processing. If there is no email in the database, the registration process begins. All provided credentials are checked. If an entry is invalid or incomplete, an error message is generated and added to the $_SESSION['error'].
		foreach($_POST as $name => $value)
		{
			if(empty($value))
			{
				$_SESSION['errors'][$name] = $name . ' cannot be blank!';
			}
			else
			{
				switch($name)
				{
					case 'first_name':
					case 'last_name':
						if(is_numeric($value))
						{
							$_SESSION['errors'][$name] = $name . ' cannot contain numbers.';
							$_SESSION['reg_info'][$name] = '';
						}
						else
						{
							$_SESSION['reg_info'][$name] = $value;
						}
					break;
					
					case 'email':
						if(!filter_var($value, FILTER_VALIDATE_EMAIL))
						{
							$_SESSION['errors'][$name] = $name . ' is not a valid email.';
							$_SESSION['reg_info'][$name] = '';
						}
						else
						{
							$_SESSION['reg_info'][$name] = $value;
						}
					break;

					case 'username':
						if(strlen($value) < 7)
						{
							$_SESSION['errors'][$name] = $name . ' must be greater than 7 characters.';
							$_SESSION['reg_info'][$name] = '';
						}
						else
						{
							$_SESSION['reg_info'][$name] = $value;
						}
					break;

					case 'password':
						if(strlen($value) < 7)
						{
							$_SESSION['errors'][$name] = $name . ' must be greater than 7 characters.';
						}
					break;

					case 'confirm_password':
						if($_POST['password'] != $value)
						{
							$_SESSION['errors'][$name] = 'Passwords do not match.';
						}
					break;
				}
			}
		}//End Registration Processing.

		//Error Check. If any errors were generated, go back to index and send the error messages for correction. Otherwise, create a database entry for the new user.
		if(isset($_SESSION['errors']))
		{
			header('location: sign-up-in.php');
			exit();
		}
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at, username) VALUES ('{$_POST['first_name']}', '{$_POST['last_name']}', '{$_POST['email']}', '{$_POST['password']}', NOW(), NOW()), {$_POST['username']}";
			$_SESSION['user_id'] = run_mysql_query($query);
			$_SESSION['first_name'] = $_POST['first_name'];
			$_SESSION['success_message'] = 'You are now registered.';
			header('location: home.php'); //Logged in screen where options are.
			exit();
		}//End Error Check.
	}//End Record Validation. 
	
}//end register



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


//LOGIN
if(isset($_POST['action']) && $_POST['action'] == 'login')
{
	if(empty($_POST['email']))
	{
		$_SESSION['errors']['email'] = 'Please enter your email to login.';
		header('location: sign-up-in.php');
		exit();
	}
	else
	{
		if(empty($_POST['password']))
		{
			$_SESSION['errors']['password'] = 'Please enter your password to login.';
			header('location: sign-up-in.php');
			exit();
		}
		else
		{
			$query = "SELECT users.id, users.email, users.password FROM users WHERE users.email = '{$_POST['email']}'";
			$credentials = fetch_record($query);

			if(!isset($credentials))
			{
				$_SESSION['errors']['login'] = 'Login with username/password does not exist.';
				header('location: sign-up-in.php');
				exit();
			}
			else
			{
				if($credentials['password'] != $_POST['password'])
				{
					$_SESSION['errors']['login'] = 'Login with username/password does not exist.';
					header('location: sign-up-in.php');
					exit();
				}
				else
				{
					$query = "SELECT users.first_name FROM users WHERE users.id = '{$credentials['id']}'";
					$record = fetch_record($query);
					$_SESSION['user_id'] = $credentials['id'];
					$_SESSION['first_name'] = $record['first_name'];
					header('location: home.php');
					exit();
				}
			}
		}
	}
	
}//end login
?>