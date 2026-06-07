<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

if(isset($_POST['guardar']))
{
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $historialEducativo = $_POST['historialEducativo'];

    $insertar = "INSERT INTO piloto(nombre, telefono, direccion, historialEducativo)
                 VALUES('$nombre', '$telefono', '$direccion', '$historialEducativo')";

    mysqli_query($conexion, $insertar);

    header("Location: pilotos.php");
}

$pilotos = mysqli_query($conexion, "SELECT * FROM piloto");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Pilotos</title>
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
        <a class="activo" href="pilotos.php">Pilotos</a>
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
            <h1>Gestión de Pilotos</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Piloto</h2>

            <form method="POST" class="formulario">
                <label>Nombre del piloto</label>
                <input type="text" name="nombre" required>

                <label>Teléfono</label>
                <input type="text" name="telefono" required>

                <label>Dirección</label>
                <input type="text" name="direccion" required>

                <label>Historial educativo</label>
                <input type="text" name="historialEducativo" required>

                <button type="submit" name="guardar">Guardar Piloto</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Pilotos</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Historial Educativo</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($pilotos)){ ?>
                <tr>
                    <td><?php echo $fila['idPiloto']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['telefono']; ?></td>
                    <td><?php echo $fila['direccion']; ?></td>
                    <td><?php echo $fila['historialEducativo']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>