<?php
session_start();
require('new-connection.php');

?>

<html>
<head>
	<title>Home</title>
	<link rel='stylesheet' type='text/css' href='home.css'>
</head>
<body>
	<h1>Welcome <?= $_SESSION['first_name']?></h1>
	<h5><a href='logoff.php'>Log Off</a></h5>
	<table>
		<thead>
		</thead>
		<tbody>
		</tbody>
	</table>
</body>
</html>