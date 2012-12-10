<!DOCTYPE html>
<html>
<head>
<title>Mafia Game-Registro</title>
<link rel="stylesheet" href="./css/cssdellctrlv.css" type="text/css" />
<link rel="stylesheet" href="./css/estilo.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>

	<?php
	
	

	
	?>
	<div id="contenido">


		<?php
		include 'inuser.inc';
		include 'conexion.inc';
		include 'cabecera.inc';
		
		
		$part =$_GET['idp'];
		
		if (isset($_POST['jugador']))
		{
		
			$menpar = $_POST['text'];
			$jupar = $_POST['jugador'];
		
			$inmen= "INSERT INTO mensajes (partida, mensaje, jugador, fecha_y_hora) VALUES ('".$part."','".$menpar."','".$jupar."','".$fecha2."')";
			$query = $dbh->prepare($inmen);
			$query->execute();
		}
		
		
		$sthp =  $dbh->query("SELECT m.id, m.mensaje, j.nombre, j.imagen FROM mensajes m, jugadores j WHERE m.partida=".$part." AND j.usuario=m.jugador GROUP BY m.id");
		

		?>
		<div class="info" style="background-color:; border-color: #ccc;">
			<p>No hay ningun paredon abierto</p>

		</div>
		
		<?php   
		$numero=0;
		foreach($sthp as $row)
		{
			$numero++;
			echo '
			
			<div id="postRow'.$row["id"].'" class="message threadStarterPost">
			<div class="messageInner messageLeft dividers container-3">
				<a id="post'.$row["id"].'"></a>
				<div class="messageSidebar">
					<div class="messageAuthor">
						<p class="userName">
							<img src="./iconos/offlineS.png" alt=""
								title="jugador esta offline"> <a
								href="index.php?page=User&amp;userID=579"
								title="Abrir perfil del usuario '.$row["nombre"].'"
								class="threadStarter"> <span><strong>'.$row["nombre"].'</strong> </span>
							</a>
						</p>
						<p class="userTitle smallFont">Rango</p>
						<p class="userRank">
							<img src="" alt="">
						</p>
					</div>
					<div class="userAvatar">
						<a href="index.php?page=User&amp;userID=648"
							title="Abrir perfil del usuario &quot;Helldark&quot;"><img
							src="./avatars/'.$row["imagen"].'" alt="" style="width: 150px; height: 150px;">
						</a>
					</div>
					<div class="userCredits">
						<p class="userPosts">
							<a href="partida.php?form=Search&amp;userID='.$row["id"].'">Posts: 6</a>
						</p>
						<p>Partidas ganadas: 12</p>
						<p>Partidas perdidas: 5</p>
						<p>Rango: Silenciador</p>

					</div>

					<div class="userMessenger">
						<ul>
							<li><a href="index.php?form=Mail&amp;userID=579"><img
									src="./iconos/emailS.png" alt=""
									title="Enviar E-mail a '.$row["nombre"].'"> </a>
							</li>
							<li><a
								href="index.php?page=Messenger&amp;userID=579&amp;action=skype"
								onclick="return !window.open(this.href, "icq", "width=350,height=400,scrollbars=yes,resizable=yes")"><img
									src="./iconos/skypeS.png" alt=""
									title="Contactar '.$row["nombre"].' a través de Skype"> </a>
							</li>
						</ul>
					</div>
					
				</div>
				
				<div class="messageContent">
					<div class="messageContentInner color-1">
						<div class="messageHeader">
							<p class="messageCount">
								<a href="partida.php?idp='.$part.'&amp;postID='.$row["id"].'#post'.$row["id"].'"
									title="Permalink to post #'.$numero.'" class="messageNumber">'.$numero.'</a>
							</p>
							<div class="containerIcon">
								<img id="postEdit'.$row["id"].'" src="./iconos/postM.png" alt="">
							</div>
							<div class="containerContent">
								<p class="smallFont light">'.$row["fecha_y_hora"].'</p>
							</div>
						</div>

						<div class="messageBody" id="postText'.$row["id"].'">
							'.$row["mensaje"].' <br>

						</div>

						<div class="messageFooterRight">
							<div class="smallButtons">
								<ul>
									<li class="extraButton"><a href="#top"><img
											src="./iconos/upS.png" alt="Ir al inicio de la página"
											title="Ir al inicio de la página"> </a>
									</li>
								</ul>
							</div>
						</div>


						<hr>
					</div>
				</div>

			</div>
		</div>
			
			';
			
		}
		
		$sthr =  $dbh->query("SELECT *  FROM jugadores WHERE usuario=".$_SESSION['id']." AND partida=".$part);
		$row = $sthr->fetch();
		 
		include 'rangosinc/'.$row["rango"].'.inc';

		?>
	 
	

	</div>
</body>
</html>
