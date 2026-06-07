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
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];
    $idEstacion = $_POST['idEstacion'];

    $insertar = "INSERT INTO operador(nombre, usuario, clave, idEstacion)
                 VALUES('$nombre', '$usuario', '$clave', '$idEstacion')";

    mysqli_query($conexion, $insertar);

    header("Location: operadores.php");
}

$operadores = mysqli_query($conexion,
"SELECT operador.*, estacion.nombre AS nombreEstacion
FROM operador
INNER JOIN estacion
ON operador.idEstacion = estacion.idEstacion");

$estaciones = mysqli_query($conexion, "SELECT * FROM estacion");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Operadores</title>
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
        <a class="activo" href="operadores.php">Operadores</a>
        <a href="incidencias.php">Incidencias</a>
        <a href="reportes.php">Reportes</a>
        <a href="usuarios.php">Usuarios</a>
        <a href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Gestión de Operadores</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Operador</h2>

            <form method="POST" class="formulario">
                <label>Nombre del operador</label>
                <input type="text" name="nombre" required>

                <label>Usuario</label>
                <input type="text" name="usuario" required>

                <label>Clave</label>
                <input type="password" name="clave" required>

                <label>Estación asignada</label>
                <select name="idEstacion" required>
                    <option value="">Seleccione una estación</option>
                    <?php while($est = mysqli_fetch_assoc($estaciones)){ ?>
                        <option value="<?php echo $est['idEstacion']; ?>">
                            <?php echo $est['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Operador</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Operadores</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Estación</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($operadores)){ ?>
                <tr>
                    <td><?php echo $fila['idOperador']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['usuario']; ?></td>
                    <td><?php echo $fila['nombreEstacion']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>