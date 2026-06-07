<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

$configuracion = mysqli_query($conexion, "SELECT * FROM configuracion LIMIT 1");
$datos = mysqli_fetch_assoc($configuracion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Configuración</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="menu">
        <h2>TRANSMETRO</h2>
        <p>VILLEDAS SYSTEMS</p>

        <a href="dashboard.php">Dashboard</a>
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
        <a class="activo" href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Configuración del Sistema</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Información General</h2>

            <table>
                <tr>
                    <th>Campo</th>
                    <th>Información</th>
                </tr>
                <tr>
                    <td>Nombre del Sistema</td>
                    <td><?php echo $datos['nombreSistema']; ?></td>
                </tr>
                <tr>
                    <td>Empresa</td>
                    <td><?php echo $datos['empresa']; ?></td>
                </tr>
                <tr>
                    <td>Versión</td>
                    <td><?php echo $datos['versionSistema']; ?></td>
                </tr>
                <tr>
                    <td>Correo</td>
                    <td><?php echo $datos['correo']; ?></td>
                </tr>
                <tr>
                    <td>Teléfono</td>
                    <td><?php echo $datos['telefono']; ?></td>
                </tr>
            </table>
        </div>

        <div class="panel">
            <h2>Descripción</h2>
            <p>
                El Sistema de Gestion del Transmetro permite administrar líneas, estaciones,
                accesos, buses, pilotos, parqueos, operadores, incidencias, usuarios y reportes.
                Su finalidad es centralizar la información y facilitar el control operativo del sistema de transporte.
            </p>
        </div>

    </div>

</div>

</body>
</html>