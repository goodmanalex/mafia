<?php
$conexionc= mysql_connect ('localhost','root','root');

mysql_select_db("mafia");
 
$nicke=$_REQUEST['username'];  
$sql="SELECT nombre FROM usuarios WHERE nombre='$nicke'";  

$resc=mysql_query($sql,$conexionc);  

$totalc=mysql_num_rows($resc);  

if($totalc>0)  
{   
  // El usuario existe en la Base de Datos  
  echo "Este nick está ocupado";  
}  
else  
{  
  // Ese nick esta libre  
  echo "Nick libre";  
}  
?>  