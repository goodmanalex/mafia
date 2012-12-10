<?php
class jugador{
	protected $usuario;
	protected $partida;
	protected $estado;
	function jugador($usu,$part,$est){
		$estado=$est;
		$usuario=$usu;
		$partida=$part;
	}
	function votar_paredon(){
		
	}
	function cambiar_estado($est){
		$estado=$est;
	}
}
?>