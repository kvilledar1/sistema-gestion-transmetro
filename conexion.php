<?php

$servidor = "localhost";
$usuario = "root";
$contrasena = "Admin123*";
$basedatos = "bd_transmetro";

$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basedatos);

if(!$conexion)
{
    die("Error de conexión");
}

?>