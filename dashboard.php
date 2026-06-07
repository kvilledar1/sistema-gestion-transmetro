<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

$totalLineas = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM linea"));
$totalEstaciones = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM estacion"));
$totalBuses = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM autobus"));
$totalPilotos = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM piloto"));
$totalParqueos = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM parqueo"));
$totalIncidencias = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM incidencia"));
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Dashboard - Sistema de Gestion del Transmetro</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="menu">
        <h2>TRANSMETRO</h2>
        <p>VILLEDA SYSTEMS</p>

        <a class="activo" href="dashboard.php">Dashboard</a>
<a href="lineas.php">Líneas</a>
<a href="estaciones.php">Estaciones</a>
<a href="accesos.php">Accesos</a>
<a href="buses.php">Buses</a>
<a href="pilotos.php">Pilotos</a>
<a href="parqueos.php">Parqueos</a>
<a href="operadores.php">Operadores</a>
<a href="incidencias.php">Incidencias</a>
<a href="reportes.php">Reportes</a>
<a href="usuarios.php">Usuarios</a>
<a href="configuracion.php">Configuración</a>
<a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Dashboard</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="tarjetas">

            <div class="tarjeta">
                <h3>Líneas</h3>
                <h2><?php echo $totalLineas; ?></h2>
                <p>Registradas</p>
            </div>

            <div class="tarjeta">
                <h3>Estaciones</h3>
                <h2><?php echo $totalEstaciones; ?></h2>
                <p>Registradas</p>
            </div>

            <div class="tarjeta">
                <h3>Buses</h3>
                <h2><?php echo $totalBuses; ?></h2>
                <p>Registrados</p>
            </div>

            <div class="tarjeta">
                <h3>Pilotos</h3>
                <h2><?php echo $totalPilotos; ?></h2>
                <p>Registrados</p>
            </div>

            <div class="tarjeta">
                <h3>Parqueos</h3>
                <h2><?php echo $totalParqueos; ?></h2>
                <p>Registrados</p>
            </div>

            <div class="tarjeta">
                <h3>Incidencias</h3>
                <h2><?php echo $totalIncidencias; ?></h2>
                <p>Registradas</p>
            </div>

        </div>

        <div class="panel">
            <h2>Resumen del Sistema</h2>
            <p>
                Bienvenido al Sistema de Gestion del Transmetro. Desde este panel podrá administrar
                lineas, estaciones, buses, pilotos, parqueos, operadores, incidencias y reportes.
            </p>
        </div>

    </div>

</div>

</body>
</html>