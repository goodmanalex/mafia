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
	echo 'Connected to database';
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

$nompar = $_POST['nompar'];
$numju = $_POST['numju'];

       $consulta= "INSERT INTO partida (nombre, jugadores, j_totales, nobles, mafia, estado) VALUES ('".$nompar."',0 ,'".$numju."' ,0 ,0 ,0)";
		$query = $dbh->prepare($consulta);
	 	 

//ejecuto la consulta
		if ($query->execute()){
			$error=0;
		}
		else{
			$error=1;
			   
		}


?>