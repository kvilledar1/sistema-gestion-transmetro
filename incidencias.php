<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: index.php");
}

include("conexion.php");

if(isset($_POST['guardar']))
{
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];
    $estado = $_POST['estado'];
    $idEstacion = $_POST['idEstacion'];

    $insertar = "INSERT INTO incidencia(tipo, descripcion, fecha, estado, idEstacion)
                 VALUES('$tipo', '$descripcion', '$fecha', '$estado', '$idEstacion')";

    mysqli_query($conexion, $insertar);

    header("Location: incidencias.php");
}

$incidencias = mysqli_query($conexion,
"SELECT incidencia.*, estacion.nombre AS nombreEstacion
FROM incidencia
INNER JOIN estacion
ON incidencia.idEstacion = estacion.idEstacion");

$estaciones = mysqli_query($conexion, "SELECT * FROM estacion");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Incidencias</title>
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
        <a class="activo" href="incidencias.php">Incidencias</a>
        <a href="reportes.php">Reportes</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Gestión de Incidencias</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nueva Incidencia</h2>

            <form method="POST" class="formulario">
                <label>Tipo de incidencia</label>
                <input type="text" name="tipo" required>

                <label>Descripción</label>
                <input type="text" name="descripcion" required>

                <label>Fecha</label>
                <input type="date" name="fecha" required>

                <label>Estado</label>
                <select name="estado" required>
                    <option value="">Seleccione estado</option>
                    <option value="Activa">Activa</option>
                    <option value="En proceso">En proceso</option>
                    <option value="Solucionada">Solucionada</option>
                </select>

                <label>Estación</label>
                <select name="idEstacion" required>
                    <option value="">Seleccione una estación</option>
                    <?php while($est = mysqli_fetch_assoc($estaciones)){ ?>
                        <option value="<?php echo $est['idEstacion']; ?>">
                            <?php echo $est['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Incidencia</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Incidencias</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Estación</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($incidencias)){ ?>
                <tr>
                    <td><?php echo $fila['idIncidencia']; ?></td>
                    <td><?php echo $fila['tipo']; ?></td>
                    <td><?php echo $fila['descripcion']; ?></td>
                    <td><?php echo $fila['fecha']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                    <td><?php echo $fila['nombreEstacion']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>