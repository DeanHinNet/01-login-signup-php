<?php
//define constants for db_host, db_user, db_pass, and db_database
//adjust the values below to match your database settings
require('../credentials.php');

// echo DB_HOST;
// echo DB_USER;
// echo DB_PASS;
// echo DB_DATABASE;

//connect to database host
$connection = new mysqli(GREEN_HOST, GREEN_USER, GREEN_PASS, GREEN_DATABASE);

//make sure connection is good or die
if ($connection->connect_errno)
{
	die("Failed to connect to MySQL: (" . $connection->connect_errno . ")" . $connection->connect_error);
}

//used when expecting multiple results
function fetch_all()
{
	$data = array();
	global $connection;
	$result = $connection->query($query);

	while($row = mysqli_fetch_assoc($result))
	{
		$data[] = $row;
	}
	return $data;
}

//used when expecting a single result
function fetch_record($query)
{
	global $connection;
	$result = $connection->query($query);
	return mysqli_fetch_assoc($result);
}

//use to run INSERT/DELETE/UPDATE, queries that don't return a value
//notice this function returns a value. This value will be equal to the ID of the most recent query item
//ran by your PHP code
function run_mysql_query($query)
{
	global $connection;
	$result = $connection->query($query);
	return $connection->insert_id;
}

//This function will return an escaped string. IE the string "That's crazy!" Will be returned as: "That\'s crazy!"...This helps secure the database!

function escape_this_string($string)
{
	global $connection;
	return $connection->real_escape_string($string);
}

?>