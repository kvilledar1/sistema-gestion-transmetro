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
$totalOperadores = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM operador"));
$totalIncidencias = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM incidencia"));
$totalUsuarios = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM usuario"));

$reporteLineas = mysqli_query($conexion,
"SELECT linea.nombre, linea.distanciaTotal, municipalidad.nombre AS nombreMunicipalidad
FROM linea
INNER JOIN municipalidad ON linea.idMunicipalidad = municipalidad.idMunicipalidad");

$reporteBuses = mysqli_query($conexion,
"SELECT autobus.placa, autobus.capacidadMaxima, autobus.estado, linea.nombre AS nombreLinea, piloto.nombre AS nombrePiloto
FROM autobus
INNER JOIN linea ON autobus.idLinea = linea.idLinea
INNER JOIN piloto ON autobus.idPiloto = piloto.idPiloto");

$reporteEstaciones = mysqli_query($conexion,
"SELECT estacion.nombre AS nombreEstacion, estacion.capacidad, linea.nombre AS nombreLinea
FROM estacion
INNER JOIN linea ON estacion.idLinea = linea.idLinea");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Reportes</title>
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
        <a class="activo" href="reportes.php">Reportes</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Reportes del Sistema</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="tarjetas">
            <div class="tarjeta"><h3>Líneas</h3><h2><?php echo $totalLineas; ?></h2><p>Total registradas</p></div>
            <div class="tarjeta"><h3>Estaciones</h3><h2><?php echo $totalEstaciones; ?></h2><p>Total registradas</p></div>
            <div class="tarjeta"><h3>Buses</h3><h2><?php echo $totalBuses; ?></h2><p>Total registrados</p></div>
            <div class="tarjeta"><h3>Pilotos</h3><h2><?php echo $totalPilotos; ?></h2><p>Total registrados</p></div>
            <div class="tarjeta"><h3>Operadores</h3><h2><?php echo $totalOperadores; ?></h2><p>Total registrados</p></div>
            <div class="tarjeta"><h3>Incidencias</h3><h2><?php echo $totalIncidencias; ?></h2><p>Total registradas</p></div>
        </div>

<div class="panel">
    <h2>Reporte de Líneas</h2>
    <table>
        <tr>
            <th>Línea</th>
            <th>Distancia Total</th>
            <th>Municipalidad</th>
        </tr>

        <?php while($fila = mysqli_fetch_assoc($reporteLineas)){ ?>
        <tr>
            <td><?php echo $fila['nombre']; ?></td>
            <td><?php echo $fila['distanciaTotal']; ?> km</td>
            <td><?php echo $fila['nombreMunicipalidad']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

        <div class="panel">
            <h2>Reporte de Estaciones por Línea</h2>
            <table>
                <tr>
                    <th>Estación</th>
                    <th>Capacidad</th>
                    <th>Línea</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($reporteEstaciones)){ ?>
                <tr>
                    <td><?php echo $fila['nombreEstacion']; ?></td>
                    <td><?php echo $fila['capacidad']; ?></td>
                    <td><?php echo $fila['nombreLinea']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

        <div class="panel">
            <h2>Reporte de Buses Asignados</h2>
            <table>
                <tr>
                    <th>Placa</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Línea</th>
                    <th>Piloto</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($reporteBuses)){ ?>
                <tr>
                    <td><?php echo $fila['placa']; ?></td>
                    <td><?php echo $fila['capacidadMaxima']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['nombreLinea']; ?></td>
                    <td><?php echo $fila['nombrePiloto']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>

    </div>

</div>

</body>
</html>