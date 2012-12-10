<!DOCTYPE html>
<html>
<head>
<title>Mafia Game-Registro</title>
<link rel="stylesheet" href="./css/cssdellctrlv.css" type="text/css" />
<link rel="stylesheet" href="./css/estilo.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript">
function showContent(divid, state, divid2, state2 ){
document.getElementById(divid).style.display=state
document.getElementById(divid2).style.display=state2
}
</script>

<link rel="stylesheet"
	href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css" />
<script>
    $(function() {
        $( "#datepicker" ).datepicker();
    });
    </script>


<script language="javascript" src="/scripts/jquery-1.3.min.js"></script>
<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#form, #fat, #fo3').submit(function() {
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data) {
                $('#result').html(data);

            }
        })
        
        return false;
    }); 
})  
</script> 

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

		?>



		<div id="main">


			<ul class="breadCrumbs">
				<li><a href="index.php"><img src="iconos/indexS.png" alt=""> <span>Mafia</span>
				</a> »</li>
				<li><img src="iconos/membersS.png" alt=""> <span>Perfil</span> »</li>
			</ul>

			<div class="mainHeadline">
				<img src="iconos/userProfileL.png" alt="">
				<div class="headlineContainer">
					<h2>
						Perfil de
						<?php echo $row["nombre"]; ?>
					</h2>
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
									<img src="perfiles/2.jpg" alt="">
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
								<div class="fieldValue">*Super mafioso*</div>
							</div>


							<div class="container-2">
								<div class="fieldTitle">Mensajes</div>
								<div class="fieldValue">
									<?php echo $row2["num"]; ?>
								</div>
							</div>

						</div>
					</div>



					<div class="userProfileContent" id="userProfileContent1"
						style="display: block;">
						<div class="border">
							<div class="containerHead">
								<div class="containerIcon">
									<a
										onclick="showContent('userProfileContent2', 'block', 'userProfileContent1', 'none')"
										title="Mostar el contenido de este post"> <img
										src="iconos/userProfilePersonalM.png" alt="">
									</a>
								</div>
								<h3 class="containerContent">Información Personal</h3>
							</div>
							<div class="container-1">
								<div class="fieldTitle">Cumpleaños</div>
								<div class="fieldValue">
									<?php echo $row["fecha_nac"]; ?>
								</div>
							</div>
							<div class="container-2">
								<div class="fieldTitle">Sexo</div>
								<div class="fieldValue">
									<?php echo $row["sexo"]; ?>
								</div>
							</div>

							<div class="container-1">
								<div class="fieldTitle">Localidad</div>
								<div class="fieldValue">
									<?php echo $row["localidad"]; ?>
								</div>
							</div>
							<div class="container-2">
								<div class="fieldTitle">Sobre mi</div>
								<div class="fieldValue">
									<?php echo $row["sobre"]; ?>
								</div>
							</div>
						</div>
					</div>


					<form method="post" action="envio.php" id="fo3" name="fo3" >
						<div class="userProfileContent" id="userProfileContent2"
							style="display: none;">
							<div class="border">
								<div class="containerHead">
									<div class="containerIcon">

										<img src="iconos/userProfilePersonalM.png" alt="">

									</div>
									<h3 class="containerContent">Información Personal</h3>
								</div>
								<div class="container-1">
									<div class="fieldTitle">Cumpleaños</div>
									<div class="fieldValue">
										<input type="text" id="datepicker"
											value="<?php echo $row["fecha_nac"]; ?>" />
									</div>
								</div>
								<div class="container-2">
									<div class="fieldTitle">Sexo</div>
									<div class="fieldValue">
										<input type="text" value="<?php echo $row["sexo"]; ?>" />
									</div>
								</div>

								<div class="container-1">
									<div class="fieldTitle">Localidad</div>
									<div class="fieldValue">
										<input type="text" value="<?php echo $row["localidad"]; ?>" />
									</div>
								</div>
								<div class="container-2">
									<div class="fieldTitle">Sobre mi</div>
									<div class="fieldValue">
										<input type="text" value="<?php echo $row["sobre"]; ?>" />
									</div>
									<input type="hidden" id="datepicker" name="nombre"	value="<?php echo $row["nombre"]; ?>" />
									<input type="submit" name="mysubmit" value="Enviar" />
									<div id="result"></div>
								</div>
							</div>
						</div>

					</form>


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
									<a href="mailto:Kagetsuya@tec-interactive.com"><?php echo $row["email"]; ?>
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>




	</div>
</body>
</html>
