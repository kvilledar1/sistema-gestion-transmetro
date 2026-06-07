<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

if(isset($_POST['guardar']))
{
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $idBus = $_POST['idBus'];

    $insertar = "INSERT INTO parqueo(ubicacion, capacidad, idBus)
                 VALUES('$ubicacion', '$capacidad', '$idBus')";

    mysqli_query($conexion, $insertar);

    header("Location: parqueos.php");
}

$parqueos = mysqli_query($conexion,
"SELECT parqueo.*, autobus.placa AS placaBus
FROM parqueo
INNER JOIN autobus
ON parqueo.idBus = autobus.idBus");

$buses = mysqli_query($conexion, "SELECT * FROM autobus");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Parqueos</title>
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
        <a class="activo" href="parqueos.php">Parqueos</a>
        <a href="operadores.php">Operadores</a>
        <a href="incidencias.php">Incidencias</a>
        <a href="reportes.php">Reportes</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Gestión de Parqueos</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Parqueo</h2>

            <form method="POST" class="formulario">
                <label>Ubicación del parqueo</label>
                <input type="text" name="ubicacion" required>

                <label>Capacidad</label>
                <input type="number" name="capacidad" required>

                <label>Bus asignado</label>
                <select name="idBus" required>
                    <option value="">Seleccione un bus</option>
                    <?php while($bus = mysqli_fetch_assoc($buses)){ ?>
                        <option value="<?php echo $bus['idBus']; ?>">
                            <?php echo $bus['placa']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Parqueo</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Parqueos</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Ubicación</th>
                    <th>Capacidad</th>
                    <th>Bus Asignado</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($parqueos)){ ?>
                <tr>
                    <td><?php echo $fila['idParqueo']; ?></td>
                    <td><?php echo $fila['ubicacion']; ?></td>
                    <td><?php echo $fila['capacidad']; ?></td>
                    <td><?php echo $fila['placaBus']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>