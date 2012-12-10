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

</head>
<body> 
	<div id="contenido">
<?php

include 'conexion.inc';

include 'inuser.inc';

include 'sesion.inc';

include 'cabecera.inc';



	$estar =$_GET['salida'];
	
	if($estar == 'sa'){
	
	$sth =  $dbh->query("SELECT u.nombre,m.mensaje, m.id, m.visto, m.asunto, m.fecha FROM mensajes_privados m, usuarios u WHERE m.emisor = " . $_SESSION['id'] . " AND u.id=m.emisor");
	$estar = "sa";
	$asalida = "class='active'";
	$aentrada = "";
	}
else
{
	$sth =  $dbh->query("SELECT u.nombre,m.mensaje, m.id, m.visto, m.asunto, m.fecha FROM mensajes_privados m, usuarios u WHERE m.receptor = " . $_SESSION['id'] . " AND u.id=m.emisor");

	$estar = "en";
	$asalida = "";
	$aentrada = "class='active'";
	
}

?>


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

		<script type="text/javascript">
		//<![CDATA[
		// data array
		var pmData = new Array();
		var folderID = 0;
		
		// language
		var language = new Object();
		language['wcf.global.button.mark']		= 'Seleccionar';
		language['wcf.global.button.unmark'] 	= 'Deseleccionar';
		language['wcf.global.button.delete'] 	= 'Borrar';
		language['wcf.pm.button.download'] 		= 'Descargar';
		language['wcf.pm.button.recover'] 		= 'Restaurar';
		language['wcf.pm.button.cancel'] 		= 'Cancelar';
		language['wcf.pm.button.edit'] 			= 'Editar';
		language['wcf.pm.button.moveTo'] 		= 'Mover a {$folder}';
		language['wcf.pm.deleteMarked.sure'] 	= 'Realmente deseas borrar los mensajes seleccionados?';
		language['wcf.pm.delete.sure'] 			= 'Realmente deseas borrar este mensaje?';
		language['wcf.pm.markedMessages'] 		= 'this.count == 1 ? "Un mensaje seleccionado" : this.count+" mensajes seleccionados"';
		language['wcf.pm.button.reply'] 		= 'Responder';
		language['wcf.pm.button.forward'] 		= 'Reenviar';
		language['wcf.pm.button.markAsUnread'] 		= 'Marcar como no leido';
		language['wcf.pm.button.markAsRead'] 		= 'Marcar como leido';
		language['wcf.pm.cancelMarked.sure'] 		= 'Realmente deseas cancelar los mensajes seleccionados';
		language['wcf.pm.cancel.sure'] 			= 'Realmente deseas cancelar este mensaje?';
		
		onloadEvents.push(function() { pmListEdit = new PMListEdit(pmData, 0, pmFolders); });
		//]]>
	</script>
		<div class="border pmMessages">
			<table class="tableList">
				<thead>
					<tr class="tableHead">
						<th class="columnMark">
							<div>
								<label class="emptyHead"><input name="pmMarkAll" type="checkbox">
								</label>
							</div>
						</th>
						<th class="columnIcon">
							<div>
								<p>
									<a NAME="mensajes"
										href="Order=DESC"><img
										src="iconos/pmReadS.png" alt=""> </a>
								</p>
							</div>
						</th>
						<th>
							<div>
								<p>
									<a
										href="sortOrder=DESC">
										Asunto </a>
								</p>
							</div>
						</th>
						<th>
							<div>
								<p>
									<a
										href="sortOrder=DESC">
										Autor </a>
								</p>
							</div>
						</th>
						<th class="active">
							<div>
								<p>
									<a
										href="sortOrder=ASC">
										Fecha <img src="iconos/sortDESCS.png" alt="">
									</a>
								</p>
							</div>
						</th>
					</tr>
				</thead>

				<tbody>
<!-- esto con BD --> 
				
				<?php   

				
				
				
					foreach($sth as $row)
					{
						if ($row["visto"] == 1)
						{
							$est = 'class="columnTitle new"'; 
						}
						else
						{
							$est = 'class="columnTitle"';
						}
			     	echo '
					
					<tr class="container-2 activeContainer" id="pmRow26148">
						<td class="columnMark"><label><input name="pmMark"
								id="pmMark26148" type="checkbox" value="'.$row["id"].'"> </label>
						</td>
						<td class="columnIcon"><img id="pmEdit26148"
							src="iconos/pmReadOptionsM.png"
							alt=""
							name="iconos/pmEditOptionsM.png"
							style="cursor: pointer;">
							<div id="pmEdit26148Menu" class="hidden"></div></td>
						<td id="pmColumn26148" '.$est.'
							title="'.$row["mensaje"].'">
							<p>
								<span><a href="bandeja_entrada.php?leer='.$row["id"].'&salida='.$estar.'#leer">'.$row["asunto"].'</a></span>
							</p>
						</td>

						<td class="columnAuthor">
							<p>
								<a href="index.php?page=User&amp;userID=5464">'.$row["nombre"].'</a>
							</p>
						</td>
						<td class="columnDate smallFont">
							<p>
								<b>'.$row["fecha"].'</b>
								
							</p>
						</td>
					</tr>'
					
					;
					}
					?>
<!-- fin de la BD --> 					
					
					
				</tbody>
			</table>
			
		</div>
		<div class="pmMessages">
			<div class="contentFooter">
				<div id="pmEditMarked" class="optionButtons"></div>
				<div class="largeButtons">
					<ul>
						<li><a href="nuevo_mensaje.php"><img src="iconos/pmNewM.png"
								alt=""> <span>Nuevo mensaje</span> </a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php 

if (isset($_GET['leer']))
{
	$idmen=$_GET['leer'];
	
	$sth2 =  $dbh->query("SELECT u.nombre, m.visto, m.id, m.mensaje, m.asunto, m.fecha FROM mensajes_privados m, usuarios u WHERE m.receptor = " . $_SESSION['id'] . " AND u.id=m.emisor AND m.id = " . $idmen . "");
	
	
		foreach($sth2 as $row)
		{
			if ($row["visto"] == 1)
			{
				$dbh->query("UPDATE mensajes_privados SET visto=0 WHERE id=".$row["id"]);
			
			}
			
			echo '
			
			<div class="message messageLeft">
			<div class="messageInner messageLeft dividers container-3">
			<div class="messageSidebar">
			<div class="messageAuthor">
			<p class="userName">
			<img src="iconos/onlineS.png" alt=""
			title="'.$row["nombre"].' esta online"> <a NAME="leer"
			href="index.php?page=User&amp;userID=5464"> <span
			title="Abrir perfil del usuario &quot;'.$row["nombre"].'&quot;">
			'.$row["nombre"].'</span>
			</a>
			
			</p>
			
			
			</div>
			
			
			
			<div class="userCredits">
			<p class="userPosts">
			<a href="index.php?form=Search&amp;userID=5464">Posts: 0</a>
			</p>
			</div>
			
			<div class="userMessenger">
			<ul>
			<li><a href="index.php?form=Mail&amp;userID=5464"><img
			src="iconos/emailS.png" alt=""
			title="Enviar E-mail a &quot;'.$row["nombre"].'&quot;"> </a></li>
			
			
			</ul>
			</div>
			</div>
			
			<div class="messageContent">
			<div class="messageContentInner color-1">
			<div class="messageHeader">
			<div class="containerIcon">
			<img src="iconos/pmReadM.png" alt="">
			</div>
			<div class="containerContent">
			<p class="light smallFont">
			<b>Hoy</b>, 5:54pm
			</p>
			</div>
			</div>
			
			<h3>'.$row["asunto"].'</h3>
			
			<div class="messageBody">
			'.$row["mensaje"].'
			</div>
			
			
			
			<div class="messageFooterRight">
			<div class="smallButtons">
			<ul>
			<li class="extraButton"><a href="#top"><img
			src="iconos/upS.png" alt="" title="Ir al inicio de la página"><span
			class="hidden"> Nach Oben</span> </a></li>
			<li><a
			href="index.php?form=PMNew&amp;action=new&amp;pmID=26148&amp;forwarding=1"><img
			src="iconos/pmForwardS.png" alt=""><span> Reenviar</span> </a>
			</li>
			<li><a
			href="index.php?form=PMNew&amp;action=new&amp;pmID=26148&amp;reply=1"><img
			src="iconos/pmReplyS.png" alt=""><span> Responder</span> </a>
			</li>
			
			<li><a
			href="index.php?page=PM&amp;action=delete&amp;pmID=26148&amp;folderID=0"
			onclick="return confirm("Realmente deseas borrar este mensaje?");"><img
			src="iconos/deleteS.png" alt=""><span> Borrar</span> </a></li>
			<li><a
			href="index.php?page=PM&amp;action=download&amp;pmID=26148"><img
			src="iconos/pmDownloadS.png" alt=""><span> Descargar</span> </a>
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
		
	
}

?>

 </div>
</body>
</html>
