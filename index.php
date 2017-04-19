<?php
session_start();
?>
<html>
<head>
	<title>DATABASES</title>
	<link rel="stylesheet" type="text/css" href="main.css">
<body>
	<div class='wrapper'>
		<h1>Newsletter Sign-up</h1>
		<div class='signup_box'>
			<h2>Sign Up</h2>
			<form action='process.php' method='post'>
				<label for='first_name'>First Name</label>
				<input type='text' name='first_name' id='first_name'>
				
				<label for='last_name'>Last Name</label>
				<input type='text' name='last_name' id='last_name'>

				<label for='email'>Email</label>
				<input type='text' name='last_name' id='last_name'>

				<label for='password'>Password</label>
				<input type='text' name='last_name' id='last_name'>

				<label for='confirm_password'>Confirm Password</label>
				<input type='text' name='confirm_password' id='confirm_password'>

				<input type='hidden' name='action' value='register'>
				<input type='submit' value='register'>
			</form>
		</div>
		<div class='signin_box'>
			<h2>Sign In</h2>
			<form action='process.php' method='post'>
				<label for='email'>Email</label>
				<input type='text' name='email'>
				
				<label for='password'>Password</label>
				<input type='text' name='password'>

				<input type='hidden' name='action' value='login'>
				<input type='submit' value='login'>
			</form>
		</div>
	</div>
</body>
</head>
</html>