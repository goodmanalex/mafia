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
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />



 <link rel="stylesheet" type="text/css" media="all" href="ajax/modeform/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="ajax/modeform/fancybox/jquery.fancybox.css">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  <script type="text/javascript" src="ajax/modeform/fancybox/jquery.fancybox.js?v=2.0.6"></script>
    <script type="text/javascript" language="javascript" src="scripts/jquery-1.3.2.min.js"></script>
  <script type="text/javascript" language="javascript" src="scripts/modal-window.min.js"></script>
   <link href="css/modal-window.css" type="text/css" rel="stylesheet" />
  

</head>
<body>
	<div id="contenido">
		<?php
		
		include 'conexion.inc';
		
		include 'inuser.inc';
		
		include 'sesion.inc';
	
		include 'cabecera.inc';	
		
		
		$sth =  $dbh->query("SELECT * FROM partida");
		
	
		?>

<!-- formulario de la nueva partida -->
<div id="inline">
	<h2>Crea una nueva partida</h2>

	<form id="contact" name="contact" action="#" method="post">
		<label for="email">Nombre de la partida</label>
	
	
		<input type="hidden" id="email" name="email" class="txt" value="ese@es.es">
		
		
		<input type="text" id="msg" name="nompar"  class="txt">
		<label for="email">Numero maximo de jugadores</label>
		 
		<select name="numju">
			<option value="9">9</option>
			<option value="12">12</option>
			<option value="18">18</option>
			<option value="21">21</option>
			<option value="24">24</option>
			
		</select>
		<br>
		<input type="hidden" name="msg" value="nueva partida" />
		
		<button id="send">Crear partida</button>
	</form>
</div>
<!-- fin -->	
		



		<div id="centro">
			<div id="divbot">
				<input type="button" value="Esperando" class="button" />
			    <input type="button" value="En curso" class="button" />
				<input type="button" value="Finalizadas" class="button" />
				<a class="modalbox" href="#inline">	<input type="button" value="Nueva partida" class="button" /></a>
			</div>
			<div id="divtabla">
				<table id="tablacont">
					<tr>
						<td class="celdat">Jugadores</td>
						<td class="celdat">Estado</td>
						<td class="celdat">Accion</td>
						<td class="celdat">Rangos</td>
					</tr>
					<?php 
					foreach($sth as $row)
					{
						
						if ($row["estado"] == 1)
						{
							$estp = 'Esperando';
						}
						if ($row["estado"] == 2)
						{
							$estp = 'En curso';
						}
						if ($row["estado"] == 3)
						{
							$estp = 'Finalizada';
						}
						
						
						echo '<tr>
						<td class="celda">'.$row["jugadores"].'/'.$row["j_totales"].'</td>
						<td class="celda">'.$estp.'</td>
						 
						<td class="celda">';
						
						if($row["estado"] == 1){
							echo '<a href="modal_partida.php?partida='.$row["id"].'&user='. $_SESSION['id'].'" onclick="$(this).modal({width:833, height:453}).open(); return false;"> Entrar </a>';
						}
						if($row["estado"] == 2){
							echo '<a href="partida.php?idp='.$row["id"].'"> Ver </a>';
						}
						if($row["estado"] == 3){
							echo '<a href="partida.php?idp='.$row["id"].'"> Ver </a>';
						}
						
						echo'
						</td>
						
						<td  class="celda"> yo que se :B </td>
						  
						 
					</tr>';
						
					}
						
					?> 
					<tr>
						<td class="celda">7/15</td>
						<td class="celda">Esperando</td>
						<td class="celda"><a href="partida.php?idp='8'"> entrar </a></td>
						<td class="celda"><img title="ERES CACA"
							src="./imagenes/Doctor.png" /><img title="ERES MUY CACA"
							src="./imagenes/Ninja.png" />
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<script type="text/javascript">
	function validateEmail(email) { 
		var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return reg.test(email);
	}

	$(document).ready(function() {
		$(".modalbox").fancybox();
		$("#contact").submit(function() { return false; });

		
		$("#send").on("click", function(){
			var emailval  = $("#email").val();
			var msgval    = $("#msg").val();
			var msglen    = msgval.length;
			var mailvalid = validateEmail(emailval);
			
			if(mailvalid == false) {
				$("#email").addClass("error");
			}
			else if(mailvalid == true){
				$("#email").removeClass("error");
			}
			
			if(msglen < 4) {
				$("#msg").addClass("error");
			}
			else if(msglen >= 4){
				$("#msg").removeClass("error");
			}
			
			if(mailvalid == true && msglen >= 4) {
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send").replaceWith("<p><strong>LISTO!! la partida ha sido creada</strong></p>");

				
				 
			}
			if(mailvalid == true && msglen >= 4) {
				// if both validate we attempt to send the e-mail
				// first we hide the submit btn so the user doesnt click twice
				$("#send").replaceWith("<em>sending...</em>");
				
				$.ajax({
					type: 'POST',
					url: 'ajax/modeform/sendmessage.php',
					data: $("#contact").serialize(),
					success: function(data) {
						if(data == "true") {
							$("#contact").fadeOut("fast", function(){
								$(this).before("<p><strong>Success! Your feedback has been sent, thanks :)</strong></p>");
								setTimeout("$.fancybox.close()", 1000);
							});
						}
					}
				});
			}
		});
	});
</script>
</body>
</html>
