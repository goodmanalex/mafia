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

		$sthr =  $dbh->query("SELECT *  FROM usuarios WHERE id=".$_GET['idu']."");
		$row = $sthr->fetch();
		
		$sthr2 =  $dbh->query("SELECT COUNT(mensaje) AS num FROM mensajes WHERE jugador=".$_GET['idu']);
		$row2 = $sthr2->fetch();
		
echo "SELECT COUNT(mensaje) AS num FROM mensajes WHERE jugador=".$_GET['idu'];
		 
		
echo'

		<div id="main">


			<ul class="breadCrumbs">
				<li><a href="index.php"><img src="iconos/indexS.png" alt="">
						<span>Mafia</span> </a> »</li>
				<li><img src="iconos/membersS.png" alt=""> <span>Perfil</span> »</li>
			</ul>

			<div class="mainHeadline">
				<img src="iconos/userProfileL.png" alt="">
				<div class="headlineContainer">
					<h2>Perfil de '.$row["nombre"].'</h2>
				</div>
			</div>
 
			<div class="border content">
				<div class="container-1 profileDisplay">
					<div class="userProfileBox">

						<div id="userProfileAvatar">
							<div class="border">
								<div class="containerHead">
									<div class="containerIcon">
										<img src="iconos/avatarM.png" alt="">
									</div>
									<h3 class="containerContent">Avatar</h3>
								</div>
								<div class="container-1">
									<img src="perfiles/2.jpg"  alt="">
								</div>
							</div>
						</div>






						<div id="userProfileOptions">
							<div class="border">
								<div class="containerHead">
									<div class="containerIcon">
										<img src="iconos/userProfileOptionsM.png" alt="">
									</div>
									<h3 class="containerContent">Opciones</h3>
								</div>
								<div class="pageMenu">
									<ul>
										<li><a href="index.php?form=Mail&amp;userID=2">Enviar E-Mail</a>
										</li>

										<li><a
											href="index.php?page=User&amp;userID=2&amp;action=vCard">Descargar
												Tarjeta Virtual</a></li>

									</ul>
								</div>
							</div>
						</div>


						<div id="userProfileAdminOptions">
							<div class="border">
								<div class="containerHead">
									<div class="containerIcon">
										<img src="iconos/userProfileAdminOptionsM.png" alt="">
									</div>
									<h3 class="containerContent">Opciones Administrativas</h3>
								</div>
								<div class="pageMenu">
									<ul>



									</ul>
								</div>
							</div>
						</div>



					</div>


					<div class="userProfileContent">
						<div class="border">
							<div class="containerHead">
								<div class="containerIcon">
									<img src="iconos/userProfileInformationM.png" alt="">
								</div>
								<h3 class="containerContent">General information</h3>
							</div>

							<div class="container-1">
								<div class="fieldTitle">Fecha de Registro</div>
								<div class="fieldValue">Sunday, June 21st 2009, 12:36pm</div>
							</div>


							<div class="container-2">
								<div class="fieldTitle">Numero de visitas al perfil</div>
								<div class="fieldValue">3,221 (2.55 visits per day)</div>
							</div>

							<div class="container-1">
								<div class="fieldTitle">Nivel</div>
								<div class="fieldValue">
									*Super mafioso* 
								</div>
							</div>


							<div class="container-2">
								<div class="fieldTitle">Mensajes</div>
								<div class="fieldValue">
									'.$row2["num"].'
								</div>
							</div>

						</div>
					</div>
					
					
					
					<div class="userProfileContent">
						<div class="border">
							<div class="containerHead">
								<div class="containerIcon">
									<img src="iconos/userProfilePersonalM.png" alt="">
								</div>
								<h3 class="containerContent">Información Personal</h3>
							</div>
							<div class="container-1">
								<div class="fieldTitle">Cumpleaños</div>
								<div class="fieldValue">'.$row["fecha_nac"].'</div>
							</div>
							<div class="container-2">
								<div class="fieldTitle">Sexo</div>
								<div class="fieldValue">'.$row["sexo"].'</div>
							</div>
							
							<div class="container-1">
								<div class="fieldTitle">Localidad</div>
								<div class="fieldValue">'.$row["localidad"].'</div>
							</div>
							<div class="container-2">
								<div class="fieldTitle">Sobre mi</div>
								<div class="fieldValue">'.$row["sobre"].'</div>
							</div>
						</div>
					</div>
					
					
					
					<div class="userProfileContent">
						<div class="border">
							<div class="containerHead">
								<div class="containerIcon">
									<img src="iconos/userProfileContactM.png" alt="">
								</div>
								<h3 class="containerContent">Posibilidades de contacto</h3>
							</div>
							<div class="container-1">
								<div class="fieldTitle">Página Web</div>
								<div class="fieldValue">
									<a href="http://www.metinworld.es" class="externalURL">http://www.metinworld.es</a>
								</div>
							</div>
							<div class="container-2">
								<div class="fieldTitle">Dirección E-mail</div>
								<div class="fieldValue">
									<a href="mailto:Kagetsuya@tec-interactive.com">'.$row["email"].'</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
		';
		
		?>

<div onclick=""></div>

	</div>
</body>
</html>
