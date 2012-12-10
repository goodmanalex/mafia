<?php
session_start();
$_SESSION['nombre'] = "";
$_SESSION['id'] = "";
header('Location: index.php');
?>