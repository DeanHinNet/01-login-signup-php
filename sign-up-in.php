<?php
session_start();

//Errors and warnings.


?>
<html>
<head>
	<title>Sign-up Now!</title>
	<link rel="stylesheet" type="text/css" href="main.css">
<body>
	<div class='wrapper'>
		<h1>Sign-up</h1>
		<div class='signup_box'>
			<h2>Sign Up</h2>
			<?php
				if(isset($_SESSION['errors']))
				{
					foreach($_SESSION['errors'] as $key=>$value)
					{
						unset($_SESSION['reg_info'][$key]);
						echo "<p class='errors'>" . $value . "</p>";
					}
					unset($_SESSION['errors']);
					foreach($_SESSION['reg_info'] as $key=>$value)
					{

					}
					var_dump($_SESSION);
				}
				else 
				{
					$_SESSION['reg_info']['username'] = '';
					$_SESSION['reg_info']['first_name'] = '';
					$_SESSION['reg_info']['last_name'] = '';
					$_SESSION['reg_info']['email'] = '';
				}
			?>
			<form action='process.php' method='post'>
				<section>
					<label for='username'>Username</label>
					<input type='text' name='username' id='username' value='<?=$_SESSION['reg_info']['username']?>'>
				</section>
				<section>
					<label for='first_name'>First Name</label>
					<input type='text' name='first_name' id='first_name' value='<?=$_SESSION['reg_info']['first_name']?>'>
				</section>
				<section>
					<label for='last_name'>Last Name</label>
					<input type='text' name='last_name' id='last_name' value='<?=$_SESSION['reg_info']['last_name']?>'>
				</section>
				<section>
					<label for='email'>Email</label>
					<input type='text' name='email' id='email' value='<?=$_SESSION['reg_info']['email']?>'>
				</section>
				<section>
					<label for='password'>Password</label>
					<input type='text' name='password' id='password'>
				</section>
				<section>
					<label for='confirm_password'>Confirm Password</label>
					<input type='text' name='confirm_password' id='confirm_password'>
				</section>
				<section>
					<input type='hidden' name='action' value='register'>
					<input type='submit' value='register'>
				</section>
			</form>
		</div>
		<div class='signin_box'>
			<h2>Sign In</h2>
			<form action='process.php' method='post'>
				<section>
					<label for='email'>Email</label>
					<input type='text' name='email'>
				</section>
				<section>
					<label for='password'>Password</label>
					<input type='text' name='password'>
				</section>
				<section>
					<input type='hidden' name='action' value='login'>
					<input type='submit' value='login'>
				</section>
			</form>
		</div>
	</div>
</body>
</head>
</html>