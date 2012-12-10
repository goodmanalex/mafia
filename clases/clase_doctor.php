<?php
include "clase_noble.php";
class doctor extends noble{
	protected $poder;
	function doctor($usu,$part,$est){
		parent::noble($usu,$part,$est);
	}
	function salvar(){
		
	}
}
?>