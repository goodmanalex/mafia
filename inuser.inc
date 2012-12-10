<?php


if(isset($_POST['username'])) {
	$email= $_POST ["email"];
	$confirmEmail= $_POST ["confirmEmail"];
	$password= $_POST ["password"];
	$confirmPassword= $_POST ["confirmPassword"];
	$username= $_POST ["username"];
	$perfecto=0;
	 
	if($email==$confirmEmail){
		$perfecto=$perfecto+1;
	}
	if($password==$confirmPassword){
		$perfecto=$perfecto+1;
	}

	if($perfecto==2){
		$consulta= "INSERT INTO usuarios (nombre, contra, email) VALUES ('".$username."','".$password."','".$email."')";
		$query = $dbh->prepare($consulta);
	 	
		//ejecuto la consulta
		if ($query->execute()){
			echo "Registro completado";
		}
		else{
			echo "Error al registrarse";
	
		   
		}
	}
	else{
		echo "Datos incorrectos";
	}
}

?>