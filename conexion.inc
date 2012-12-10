<?php

/*** mysql hostname ***/
$hostname = 'localhost';

/*** mysql username ***/
$username = 'root';

/*** mysql password ***/
$password = 'root';

try {
	$dbh = new PDO("mysql:host=$hostname;dbname=mafia", $username, $password);
	/*** echo a message saying we have connected ***/
	 
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>