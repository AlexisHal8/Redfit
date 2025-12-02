<?php 
$hosy='localhost';
$user='root';
$pass='';
$db='redfit';

$conn=mysqli_connect($hosy,$user,$pass,$db);

// Verificar conexion
if(!$conn){
    die("Error de conexion: ".mysqli_connect_error());
}





?>