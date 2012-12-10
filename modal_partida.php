<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
</head>
<body>

	<?php  
	
	include 'conexion.inc';	
 
	include 'sesion.inc';
	
	if(isset($_POST['nombre'])) {
			
	 $userpar=$_POST['userpar'];
	 $partida=$_POST['partida'];
	 $nombre=$_POST['nombre'];
	 $imagen=$_POST['imagen'];
	 
 
	 $consultapar= "INSERT INTO jugadores (usuario, partida, nombre, imagen, rango) VALUES (".$userpar.",".$partida.",'".$nombre."','".$imagen."',1)";
	 $query = $dbh->prepare($consultapar);
	  
	 //ejecuto la consulta
	 if ($query->execute()){
	 	echo "Ya estas dentro de la partifda";
	 	
	 	$anadirju="UPDATE partida SET jugadores=jugadores+1 WHERE id=".$partida."";
	 	$queryju = $dbh->prepare($anadirju);
	 	$queryju->execute();
	 	
	 	$comest="UPDATE partida SET estado=2 WHERE jugadores=j_totales AND id=".$partida."";
	 	$queryest = $dbh->prepare($comest);
	 	$queryest->execute();
	 	
	 	
	 	
	 }
	 else{
	 	echo "Error al entrar en la partida";
	 
	 	 
	 }
	  
	}else {

		$partida=$_GET[partida];
		$userpar=$_GET[user];

	 include 'conexion.inc';

	 $sth =  $dbh->query("SELECT nombre FROM partida WHERE id=".$partida);

	 echo'<div style="margin-top:20px; text-align:center;">';

	 foreach($sth as $row)
	 {
	 	echo'<h2>Estas a punto de entar en la partida: '.$row["nombre"].'</h2>';
	 }
	 ?>



	<form action="modal_partida.php" method="post" accept-charset="utf-8">

		<input type="text" name="nombre" value="nombre_jugador" id="some_name" onFocus="if (this.value=='nombre_jugador') this.value='';">
		
		<h2>Elija su imagen para la partida</h2>
		<table>

			<tr>
				<td><img src="avatars/1.jpg" width="55px" height="55px">
				
				</td>
				<td><img src="avatars/2.jpg" width="55px" height="55px">
				
				</td>
				<td><img src="avatars/3.jpg" width="55px" height="55px">
				
				</td>
			</tr>
			<tr>

				<td><input type=radio name="imagen" value=1.jpg checked>
				
				</td>
				<td><input type=radio name="imagen" value=2.jpg>
				
				</td>
				<td><input type=radio name="imagen" value=3.jpg>
				
				</td>
			</tr>
		</table>
		<?php  echo '<input type="hidden" name="partida" value="'.$partida.'"/>'; ?>
		<?php  echo '<input type="hidden" name="userpar" value="'.$userpar.'"/>'; ?>
       

		<p>
			<input type="submit" />
		</p>

	</form>


	</div>
	<?php  } ?>
</body>
</html>
