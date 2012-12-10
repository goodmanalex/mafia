<!DOCTYPE html>
<html>
<head>
<title>Mafia Game-Registro</title>
<link rel="stylesheet" href="./css/cssdellctrlv.css" type="text/css" />
<link rel="stylesheet" href="./css/estilo.css" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	
		<script src="ajax/prototype.js" type="text/javascript"></script>  
	<script type="text/javascript"><!--  
 //<![CDATA[  
function comprobar(nick)   
{  
  var url = 'ajax/verificar.php';  
  var pars= ("username=" + nick); 
  var myAjax = new Ajax.Updater( 'comprobar_mensaje', url, { method: 'get', parameters: pars});  
  
}  
// -->  
</script>  
</head>
<body>
	<?php
	
	
	include 'conexion.inc';

	?>
	<div id="contenido">
		<?php
		include 'cabecera.inc';

		?>

		

		<div id="centro">
			<div id="divtabla">
				<form method="post" action="index.php">
					<div class="border content">
						<div class="container-1">
							<div class="formElement">
								<div class="formFieldLabel">
									<label for="username">Nombre de Usuario</label>
								</div>
								<input type="hidden" name="username" onKeyUp="comprobar(this.value)" /> <span id="comprobar_mensaje"></span>  
		
								<div class="formField">
									<input type="text" class="inputText" name="username" value=""
										id="username" onKeyUp="comprobar(this.value)"/>
								</div>
								<div class="formFieldDesc">
								
								
									<p>El nombre de usuario debe tener al minimo 3 caracteres y
										como máximo 25 caracteres.</p>
								</div>
							</div>
							<fieldset>
								<legend>
									<label for="email">Dirección E-Mail</label>
								</legend>
								<div class="formElement">
									<div class="formFieldLabel">
										<label for="email">Dirección E-Mail</label>
									</div>
									<div class="formField">
										<input type="text" class="inputText" name="email" value=""
											id="email" />
									</div>
									<div class="formFieldDesc">
										<p>Por favor introduce tu dirección de E-Mail</p>
									</div>
								</div>
								<div class="formElement">
									<div class="formFieldLabel">
										<label for="confirmEmail">Confirmar dirección E-Mail</label>
									</div>
									<div class="formField">
										<input type="text" class="inputText" name="confirmEmail"
											value="" id="confirmEmail" />
									</div>
									<div class="formFieldDesc">
										<p>Por favor confirma tu dirección de E-Mail</p>
									</div>
								</div>
							</fieldset>
							<fieldset>
								<legend>
									<label for="password">Contraseña</label>
								</legend>
								<div class="formElement">
									<div class="formFieldLabel">
										<label for="password">Contraseña</label>
									</div>
									<div class="formField">
										<input type="password" class="inputText" name="password"
											value="" id="password" />
									</div>
									<div class="formFieldDesc">
										<p>Una contraseña segura debe tener al mínimo 8 letras.</p>
									</div>
								</div>
								<div class="formElement">
									<div class="formFieldLabel">
										<label for="confirmPassword">Confirmar Contraseña</label>
									</div>
									<div class="formField">
										<input type="password" class="inputText"
											name="confirmPassword" value="" id="confirmPassword" />
									</div>
									<div class="formFieldDesc">
										<p>Por favor confirma tu contraseña</p>
									</div>
								</div>
							</fieldset>
						</div>
					</div>
					<div class="formSubmit">
						<input type="submit" accesskey="s" value="Enviar" /> <input
							type="reset" accesskey="r" value="Reiniciar" />
					</div>
					<input type="hidden" name="action" value="register" />
				</form>
			</div>
		</div>
	</div>
</body>
</html>
