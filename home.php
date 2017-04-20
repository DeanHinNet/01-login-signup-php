<?php
session_start();
require('new-connection.php');

$query = " SELECT incidents.incident_id,
					incidents.name AS incident_name,
					incidents.created_at AS incident_date,
					users.first_name AS reported_by
					FROM incidents
					JOIN users on incidents.users_user_id = users.user_id";
$records = fetch_all($query);
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
			<th>Incident</th>
			<th>Date</th>
			<th>Reported By</th>
			<th>Did you see it?</th>
			<th>Link</th>
		</thead>
		<tbody>
			<?php
				foreach($records as $incident)
				{
					echo "
						<tr>
						 <td>{$incident['incident_name']}</td>
						 <td>{$incident['incident_date']}</td>
						 <td>{$incident['reported_by']}</td>
						 <td>
						 </td>
						 <td><a href='view.php?incident_id={$incident['incident_id']}'>GO</a></td>
						 </tr>
					";
				}
			?>
		</tbody>
	</table>
</body>
</html>