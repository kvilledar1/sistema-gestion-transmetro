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
    $rol = $_POST['rol'];
    $estado = $_POST['estado'];

    $insertar = "INSERT INTO usuario(nombre, usuario, clave, rol, estado)
                 VALUES('$nombre', '$usuario', '$clave', '$rol', '$estado')";

    mysqli_query($conexion, $insertar);

    header("Location: usuarios.php");
}

$usuarios = mysqli_query($conexion, "SELECT * FROM usuario");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Usuarios</title>
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
        <a class="activo" href="usuarios.php">Usuarios</a>
        <a href="configuracion.php">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Gestión de Usuarios</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nuevo Usuario</h2>

            <form method="POST" class="formulario">
                <label>Nombre completo</label>
                <input type="text" name="nombre" required>

                <label>Usuario</label>
                <input type="text" name="usuario" required>

                <label>Clave</label>
                <input type="password" name="clave" required>

                <label>Rol</label>
                <select name="rol" required>
                    <option value="">Seleccione un rol</option>
                    <option value="Administrador">Administrador</option>
                    <option value="Operador">Operador</option>
                    <option value="Supervisor">Supervisor</option>
                </select>

                <label>Estado</label>
                <select name="estado" required>
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>

                <button type="submit" name="guardar">Guardar Usuario</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Usuarios</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Estado</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($usuarios)){ ?>
                <tr>
                    <td><?php echo $fila['idUsuario']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['usuario']; ?></td>
                    <td><?php echo $fila['rol']; ?></td>
                    <td><?php echo $fila['estado']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>