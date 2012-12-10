<?php


if (isset($_POST['form'])) 
{
	
	$user = $_POST['loginUsername'];
	$pass = $_POST['loginPassword'];



	$sth = $dbh->query("SELECT * FROM usuarios WHERE contra='" . $pass . "' AND nombre='" . $user . "'");


	if ($sth->columnCount() != 0)
	{

		session_start();

		foreach($sth as $row)
		{
				
			$_SESSION['nombre'] = $row['nombre'];
			$_SESSION['id'] = $row['id'];
		}

		header('Location: index.php');
	}
	else
	{

		header('Location: index.php?error="1"');

	}

}

else
{
	$user = '';
	$pass = '';
	
}
?>
