<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="./css/cssdellctrlv.css" type="text/css" />
<link rel="stylesheet" href="./css/estilo.css" type="text/css" />
<link rel="stylesheet" href="autocomplete.css" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<script src="jquery.js" type="text/javascript"></script>
<script src="dimensions.js" type="text/javascript"></script>
<script src="autocomplete.js" type="text/javascript"></script>


<script type="text/javascript">
	$(function(){
	    setAutoComplete("searchField", "results", "autocomplete.php?part=");
	});
</script>

</head>
<body>
	<div id="contenido">

<?php

include 'conexion.inc';

include 'inuser.inc';

include 'sesion.inc';

include 'cabecera.inc';

if (isset($_POST['searchField']))
{
	$user = $_POST['searchField'];
	$conten = $_POST['contenido'];
	$asunto = $_POST['subject'];
	
	
	date_default_timezone_set('Europe/Madrid');
	setlocale(LC_TIME, 'spanish');
	$fecha= strftime("el %A, %d de %B de %Y a las %H:%M" );
	



	////


  $sth = $dbh->query("SELECT id FROM usuarios WHERE nombre='" . $user . "'");
	session_start();
	if ($sth->columnCount() != 0)
	{
		foreach($sth as $row)
		{

			$user = $row['id'];

		}

		////


		$consulta= "INSERT INTO mensajes_privados (emisor, receptor, mensaje, visto, asunto, fecha) VALUES ('".$_SESSION['id']."','".$user."','".$conten."',1,'".$asunto."','".$fecha."')";
		$query = $dbh->prepare($consulta);

		//ejecuto la consulta
		if ($query->execute())
		{
			echo "mensaje enviado";
			
			header('Location: bandeja_entrada.php?salida=');
		}
		else
		{
			echo "Error al enviar, compruebe los campos ";
		}
	}
	else
	{
		echo "Destinatario no encontrado";
	}
}




?>

<html>
<head>
<title></title>
<link rel="stylesheet" href="./css/cssdellctrlv.css" type="text/css" />
<link rel="stylesheet" href="./css/estilo.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
	<div id="contenido">
	
	
<div class="pmView">
	<div class="pmMessages">
		<div class="contentHeader">

			<div class="largeButtons">
				<ul>
					<li><a href="nuevo_mensaje.php"><img src="iconos/pmNewM.png"
							alt=""> <span>Nuevo mensaje</span> </a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="pmIndex">
		<div class="border pmFolders">
			<script type="text/javascript">
			//<![CDATA[
			var pmFolders = new Array();
			//]]>
		</script>
			<div class="pageMenu">
				<ul>
					<li <?php echo  $aentrada; ?>><a class=""
						href="bandeja_entrada.php?salida=en#mensajes"> <img
							src="iconos/pmInboxM.png" alt=""> <span>Bandeja de entrada
								(1/1)
						</span>
					</a>
					</li>
					<li  <?php echo $asalida; ?>><a href="bandeja_entrada.php?salida=sa"> <img
							src="iconos/pmOutboxM.png" alt=""> <span>Bandeja de salida (1)
						</span>
					</a>
					</li>
					<li><a href="index.php?page=PMList&amp;folderID=-2"> <img
							src="iconos/pmDraftsM.png" alt=""> <span>Borradores (0) </span>
					</a>
					</li>
					<li><a href="index.php?page=PMList&amp;folderID=-3"> <img
							src="iconos/pmTrashEmptyM.png" alt=""> <span>Papelera de
								reciclaje (0) </span>
					</a>
					</li>
				</ul>
			</div>
			<div class="container-3">
				<div class="pmUsage">
					<div class="pmUsageBar">
						<div style="width: 1%;" title="1% de espacio en disco usado"></div>
					</div>
					<p>1% de espacio en disco usado</p>
				</div>
			</div>
			<div class="pageMenu">
				<ul>
					<li><a href="index.php?form=PMFolderEdit"><img
							src="iconos/pmFolderEditM.png" alt=""> <span>Editar carpetas </span>
					</a></li>
				</ul>
			</div>
		</div>
	
	
	<form action="nuevo_mensaje.php" method="Post">

	
		<div class="border content">
			<div class="container-1">
				<fieldset>
					<legend>Información de mensajes</legend>

					<div class="formElement">
						<div class="formFieldLabel">
							<label for="recipients">Destinatario</label>
						</div>
						<div class="formField">
						 <p id="auto">
		
		<input class="inputText" id="searchField"  name="searchField" type="text" />
	</p>
							<div id="optionrecipients" class="hidden"></div>

						</div>
					</div>



					<div class="formElement">
						<div class="formFieldLabel">
							<label for="subject">Asunto</label>
						</div>
						<div class="formField">
							<input type="text" class="inputText" name="subject" id="subject"
								value="">
						</div>
						<textarea rows="4" cols="7" name="contenido">escribe tu mensaje</textarea>
		
		
					</div>

				</fieldset>



			</div>
		</div>

		<input type="submit" />
	</form>
 </div>
</div>





	


</body>
</html>
