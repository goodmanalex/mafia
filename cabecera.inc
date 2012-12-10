<div align="center" id="cabecera">


	<?php 
	date_default_timezone_set('Europe/Madrid');
	setlocale(LC_TIME, 'spanish');
	$fecha2= strftime("%A, %d de %B de %Y Hora: %H:%M" );
	
	session_start();
	if($_SESSION['id']=="") {

	 
		?>

	<div id="userPanel" class="userPanel">
		<p id="date">
			<img src="./imagenes/dateS.png" alt="" /> <span><?php echo $fecha2; ?></span>
		</p>
		<p id="userNote">No estas logueado.</p>
		<div id="userMenu">
			<ul>
				<li><a href="index.php?form=UserLogin" id="loginButton"><img
						src="./imagenes/loginOptionsS.png" alt="" id="loginButtonImage" />
						<span>Entrar</span> </a>
					<div class="hidden" id="quickLoginBox">
						<form method="post" action="index.php"
							class="container-1">
							<input type="hidden" value="form" name="form">
							<div>
								<div>
									<input tabindex="1" type="text" class="inputText"
										id="quickLoginUsername" name="loginUsername"
										value="Nombre de Usuario" title="Nombre de Usuario"> <input
										tabindex="2" type="password" class="inputText"
										name="loginPassword" value="" title="Contraseña"> <input
										type="hidden" name="url" value="/index.php"> <input
										tabindex="4" type="image" class="inputImage"
										src="./iconos/submitS.png" alt="Enviar">
								</div>
								<label><input tabindex="3" type="checkbox" id="useCookies"
									name="useCookies" value="1"> Remember me?</label>
							</div>
						</form>
					</div> <script type="text/javascript">
                            	//<![CDATA[
                                var loginFormVisible = false;
                                function showLoginForm() {
                                    var loginBox = document.getElementById("quickLoginBox");
                                    if (loginBox) {
                                        if (!loginFormVisible) {
                                            loginBox.className = "border loginPopup";
                                            loginFormVisible = true;
                                        }
                                        else {
                                            loginBox.className = "hidden";
                                            loginFormVisible = false;
                                        }
                                    }
                                    return false;
                                }
                                document.getElementById('loginButton').onclick = function() { return showLoginForm(); };
                                document.getElementById('loginButton').ondblclick = function() { document.location.href = fixURL('index.php?form=UserLogin'); };
                                document.getElementById('quickLoginUsername').onfocus = function() { if (this.value == 'Nombre de Usuario') this.value=''; };
                                document.getElementById('quickLoginUsername').onblur = function() { if (this.value == '') this.value = 'Nombre de Usuario'; };
                                document.getElementById('loginButtonImage').src = document.getElementById('loginButtonImage').src.replace(/loginS\.png/, 'loginOptionsS.png');
                                //]]>
                            </script>
				</li>
				<li><a href="registro.php"> <img src="./imagenes/registerS.png"
						alt=""> <span>Registrarse</span>
				</a>
				</li>
			</ul>
		</div>
	</div>
	<img id="logo" src="./imagenes/mafia.png" />
	<?php 
	}
	
	else{
		?>



	<div id="userPanel" class="userPanel">
		<p id="date">
			<img src="./imagenes/dateS.png" alt=""> <span><?php echo $fecha2; ?></span>
		</p>
		<p id="userNote">
			Bienvenido! <a href="index.php?page=User&amp;userID=<?php echo $_SESSION['id']; ?> "><?php echo $_SESSION['nombre']; ?> </a>.
		</p>
		<div id="userMenu">
			<ul>
				<li><a
					href="destruir.php"><img
						src="./imagenes/logoutS.png" alt=""> <span>Salir</span>
				</a>
				</li>
				<li><a href="index.php?form=UserProfileEdit"><img
						src="./imagenes/profileS.png" alt=""> <span>Mi Perfil</span>
				</a>
				</li>
				<li><a href="bandeja_entrada.php?salida=en#mensajes"><img src="./imagenes/pmEmptyS.png"
						alt=""> <span>Mensajes Privados</span>
				</a>
				</li>

			</ul>
		</div>
	</div>
	<img id="logo" src="./imagenes/mafia.png" />



	<?php 
	
	$idmen=$_GET['leer'];
	
	$sth =  $dbh->query("SELECT m.*, u.nombre FROM mensajes_privados m, usuarios u WHERE m.receptor = " . $_SESSION['id'] . "  AND m.visto = 1 AND m.emisor = u.id");
	
	
	if ($sth->rowCount() != 0)
	{
		echo '<div class="info" id="pmOutstandingNotifications">
		<a href="index.php?page=PM&amp;action=disableNotifications"
		id="pmOutstandingNotificationsCloseButton" class="close"><img
		src="iconos/pmCancelS.png" alt="" title="Cancelar notificación"> </a>
		<p>Tienes '.$sth->rowCount().' MPs sin leer :</p>';
	
		foreach($sth as $row)
		{
	
			$user = $row['asunto'];
			echo '<ul>
			<li><a href="bandeja_entrada.php?leer='.$row["id"].'&salida=#leer">
			'.$row["asunto"].'
			</a> De <a href="index.php?page=User&amp;userID=5464">'.$row["nombre"].'</a>
			</li>
			</ul>';
	
		}
	
		echo '</div>';
	}
	}
	
	?>



</div>

