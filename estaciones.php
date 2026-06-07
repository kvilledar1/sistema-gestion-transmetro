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
    $capacidad = $_POST['capacidad'];
    $idLinea = $_POST['idLinea'];

    $insertar = "INSERT INTO estacion(nombre, capacidad, idLinea)
                 VALUES('$nombre', '$capacidad', '$idLinea')";

    mysqli_query($conexion, $insertar);

    header("Location: estaciones.php");
}

$estaciones = mysqli_query($conexion,
"SELECT estacion.*, linea.nombre AS nombreLinea
FROM estacion
INNER JOIN linea
ON estacion.idLinea = linea.idLinea");

$lineas = mysqli_query($conexion, "SELECT * FROM linea");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Estaciones</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="menu">
        <h2>TRANSMETRO</h2>
        <p>VILLEDA SYSTEMS</p>

        <a href="dashboard.php">Dashboard</a>
        <a href="lineas.php">Líneas</a>
        <a class="activo" href="estaciones.php">Estaciones</a>
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
            <h1>Gestión de Estaciones</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nueva Estación</h2>

            <form method="POST" class="formulario">
                <label>Nombre de la estación</label>
                <input type="text" name="nombre" required>

                <label>Capacidad</label>
                <input type="number" name="capacidad" required>

                <label>Línea</label>
                <select name="idLinea" required>
                    <option value="">Seleccione una línea</option>
                    <?php while($lin = mysqli_fetch_assoc($lineas)){ ?>
                        <option value="<?php echo $lin['idLinea']; ?>">
                            <?php echo $lin['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Estación</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Estaciones</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Línea</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($estaciones)){ ?>
                <tr>
                    <td><?php echo $fila['idEstacion']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['capacidad']; ?></td>
                    <td><?php echo $fila['nombreLinea']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>