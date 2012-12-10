<?php
include "clase_noble.php";
class detective extends noble{
	protected $poder;
	function detective($usu,$part,$est){
		parent::noble($usu,$part,$est);
	}
	function investigar(){
		
	}
}
?>