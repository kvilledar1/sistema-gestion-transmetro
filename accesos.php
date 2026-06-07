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
    $tipo = $_POST['tipo'];
    $ubicacion = $_POST['ubicacion'];
    $idEstacion = $_POST['idEstacion'];

    $insertar = "INSERT INTO acceso(nombre, tipo, ubicacion, idEstacion)
                 VALUES('$nombre', '$tipo', '$ubicacion', '$idEstacion')";

    mysqli_query($conexion, $insertar);

    header("Location: accesos.php");
}

$accesos = mysqli_query($conexion,
"SELECT acceso.*, estacion.nombre AS nombreEstacion
FROM acceso
INNER JOIN estacion
ON acceso.idEstacion = estacion.idEstacion");

$estaciones = mysqli_query($conexion, "SELECT * FROM estacion");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Accesos</title>
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
        <a class="activo" href="accesos.php">Accesos</a>
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
            <h1>Gestión de Accesos</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Acceso</h2>

            <form method="POST" class="formulario">
                <label>Nombre del acceso</label>
                <input type="text" name="nombre" required>

                <label>Tipo de acceso</label>
                <input type="text" name="tipo" placeholder="Ejemplo: Entrada principal" required>

                <label>Ubicación</label>
                <input type="text" name="ubicacion" required>

                <label>Estación</label>
                <select name="idEstacion" required>
                    <option value="">Seleccione una estación</option>
                    <?php while($est = mysqli_fetch_assoc($estaciones)){ ?>
                        <option value="<?php echo $est['idEstacion']; ?>">
                            <?php echo $est['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Acceso</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Accesos</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Ubicación</th>
                    <th>Estación</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($accesos)){ ?>
                <tr>
                    <td><?php echo $fila['idAcceso']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['tipo']; ?></td>
                    <td><?php echo $fila['ubicacion']; ?></td>
                    <td><?php echo $fila['nombreEstacion']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>