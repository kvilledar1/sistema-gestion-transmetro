<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

if(isset($_POST['guardar']))
{
    $placa = $_POST['placa'];
    $capacidadMaxima = $_POST['capacidadMaxima'];
    $estado = $_POST['estado'];
    $idLinea = $_POST['idLinea'];
    $idPiloto = $_POST['idPiloto'];

    $insertar = "INSERT INTO autobus(placa, capacidadMaxima, estado, idLinea, idPiloto)
                 VALUES('$placa', '$capacidadMaxima', '$estado', '$idLinea', '$idPiloto')";

    mysqli_query($conexion, $insertar);

    header("Location: buses.php");
}

$buses = mysqli_query($conexion,
"SELECT autobus.*, linea.nombre AS nombreLinea, piloto.nombre AS nombrePiloto
FROM autobus
INNER JOIN linea ON autobus.idLinea = linea.idLinea
INNER JOIN piloto ON autobus.idPiloto = piloto.idPiloto");

$lineas = mysqli_query($conexion, "SELECT * FROM linea");
$pilotos = mysqli_query($conexion, "SELECT * FROM piloto");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Buses</title>
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
        <a class="activo" href="buses.php">Buses</a>
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
            <h1>Gestión de Buses</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Bus</h2>

            <form method="POST" class="formulario">
                <label>Placa del bus</label>
                <input type="text" name="placa" required>

                <label>Capacidad máxima</label>
                <input type="number" name="capacidadMaxima" required>

                <label>Estado</label>
                <select name="estado" required>
                    <option value="">Seleccione estado</option>
                    <option value="Activo">Activo</option>
                    <option value="Mantenimiento">Mantenimiento</option>
                    <option value="Fuera de servicio">Fuera de servicio</option>
                </select>

                <label>Línea asignada</label>
                <select name="idLinea" required>
                    <option value="">Seleccione una línea</option>
                    <?php while($lin = mysqli_fetch_assoc($lineas)){ ?>
                        <option value="<?php echo $lin['idLinea']; ?>">
                            <?php echo $lin['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <label>Piloto asignado</label>
                <select name="idPiloto" required>
                    <option value="">Seleccione un piloto</option>
                    <?php while($pil = mysqli_fetch_assoc($pilotos)){ ?>
                        <option value="<?php echo $pil['idPiloto']; ?>">
                            <?php echo $pil['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Bus</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Buses</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Placa</th>
                    <th>Capacidad</th>
                    <th>Estado</th>
                    <th>Línea</th>
                    <th>Piloto</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($buses)){ ?>
                <tr>
                    <td><?php echo $fila['idBus']; ?></td>
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