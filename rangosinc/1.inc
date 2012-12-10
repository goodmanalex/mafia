
 <script type="text/javascript">

function showContent(divid, state){
document.getElementById(divid).style.display=state
}

</script>


<div class="message content messageMinimized" id="simpleReplyMinimized">

			<div class="messageInner container-1">

				<img src="iconos/threadReplyM.png" alt="" />

					<p class="userCredits smallFont light">

						<a   onclick="showContent('simpleReply', 'block')" title="Mostar el contenido de este post">

							<span>Responder</span>

						</a>
						
					</p>

			</div>

</div>

<div id="simpleReply" class="message" style="display: none;">

		

			<div class="messageInner messageLeft dividers dividers container-3">

				<div class="messageSidebar">

				
				<?php

				 
					echo'
					<form action="partida.php?idp='.$part.'" method="Post">
					<div class="messageAuthor">

						<p class="userName">

						
							<img src="iconos/onlineS.png" alt="" title="'.$row["nombre"].' esta online" />

							<a href="index.php?page=User&amp;userID='.$row["id"].'" title="Abrir perfil del usuario '.$row["nombre"].'" >

								<span>'.$row["nombre"].'</span>

							</a>

						
						</p>
									<p class="userRank"><img src="avatars/'.$row["imagen"].'" style="width: 150px; height: 150px;" alt="" /></p>

						</div>
					';
				 
				
				?>
					

						

						
						

						
					</div>



				<div class="messageContent">

					<div class="messageContentInner color-2">

						

						<div class="messageHeader">

							<div class="containerIcon">

								<img src="iconos/threadReplyM.png" alt="">

							</div>

							<div class="containerContent">

								<p class="smallFont light"><b>Hoy</b> <?php echo $fecha2; ?> </p> 

							</div>

						</div>

						

						<div class="messageForm" style="width:100%;">

					
							<fieldset style="border:0;margin:5px 0 0 0;padding:0;position:static;width:100%;">

								<textarea name="text" onkeyup="sz(this);" style="" id="text" rows="11" cols="30" tabindex="6"></textarea>

							</fieldset>
 
							<?php   

							echo'<input type="hidden" name="jugador" value="'.$row["usuario"].'" /> ';
							?>
							
						</div>
						
							<div class="messageFooterRight">

							<div class="smallButtons">

								<ul>

									<li class="extraButton"><a href="#top"><img src="iconos/upS.png" alt="Ir al inicio de la página" title="Ir al inicio de la página" /></a></li>

									<li><input class="simpleReplyInput" type="reset" name="reset" accesskey="r" value="Reiniciar" /></li>

									<li><input type="submit"   value="Enviar" /></li>
					
								</ul>

							</div>

						</div>

						<hr />

					</div>

				</div>

			</div>

		</form>

	</div>




		<div class="border infoBox">
			<div class="container-1">
				<div class="containericonos">
					<img src="./iconos/submitS.png" alt="">
				</div>
				
				<div class="containerContent">
					<h3>
					
					<form>
	 Abrir paredon: <select> 
	 
                    	<?php 
                    	$sthr =  $dbh->query("SELECT nombre  FROM jugadores WHERE partida=".$part);  
                    	foreach($sthr as $row)
                    	{
                    		echo '<option>'.$row["nombre"].'</option>';
                    	}
                    	?>
							
					</select>
					 </form>
					 	
					</h3>
					<form action="">
					 
					</form>
					<p class="smallFont" align="right">
						Veces que has muerto: 1 <br /> Veces resucitado: 1 <br /> Veces
						que te abrieron paredon: 2 <br /> Veces salvado del paredon: 1 <br />
						Veces muerto en FN: 0
					</p>
					

				</div>
				
					
			</div>
		</div>
		