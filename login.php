<?php
session_start();
include("conexion.php");

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

$consulta = "SELECT * FROM usuario WHERE usuario='$usuario' AND clave='$clave' AND estado='Activo'";
$resultado = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($resultado) > 0)
{
    $_SESSION['usuario'] = $usuario;
    header("Location: dashboard.php");
}
else
{
    echo "<script>
            alert('Usuario o contraseña incorrectos');
            window.location='index.php';
          </script>";
}
?>