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
    $distanciaTotal = $_POST['distanciaTotal'];
    $idMunicipalidad = $_POST['idMunicipalidad'];

    $insertar = "INSERT INTO linea(nombre, distanciaTotal, idMunicipalidad)
                 VALUES('$nombre', '$distanciaTotal', '$idMunicipalidad')";

    mysqli_query($conexion, $insertar);

    header("Location: lineas.php");
}

$lineas = mysqli_query($conexion,
"SELECT linea.*, municipalidad.nombre AS nombreMunicipalidad
FROM linea
INNER JOIN municipalidad
ON linea.idMunicipalidad = municipalidad.idMunicipalidad");
$municipalidades = mysqli_query($conexion, "SELECT * FROM municipalidad");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de Líneas</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<div class="contenedor">

    <div class="menu">
        <h2>TRANSMETRO</h2>
        <p>VILLEDAS SYSTEMS</p>

        <a href="dashboard.php">Dashboard</a>
        <a class="activo" href="lineas.php">Líneas</a>
        <a href="#">Estaciones</a>
        <a href="#">Buses</a>
        <a href="#">Pilotos</a>
        <a href="#">Parqueos</a>
        <a href="#">Operadores</a>
        <a href="#">Incidencias</a>
        <a href="#">Reportes</a>
        <a href="#">Usuarios</a>
        <a href="#">Configuración</a>
        <a href="cerrar_sesion.php">Cerrar sesión</a>
    </div>

    <div class="contenido">

        <div class="barra-superior">
            <h1>Gestión de Líneas</h1>
            <div>
                <strong>Administrador</strong><br>
                <span><?php echo $_SESSION['usuario']; ?></span>
            </div>
        </div>

        <div class="panel">
            <h2>Registrar Nueva Línea</h2>

            <form method="POST" class="formulario">
                <label>Nombre de la línea</label>
                <input type="text" name="nombre" required>

                <label>Distancia total</label>
                <input type="number" step="0.01" name="distanciaTotal" required>

                <label>Municipalidad</label>
                <select name="idMunicipalidad" required>
                    <option value="">Seleccione una municipalidad</option>
                    <?php while($mun = mysqli_fetch_assoc($municipalidades)){ ?>
                        <option value="<?php echo $mun['idMunicipalidad']; ?>">
                            <?php echo $mun['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="guardar">Guardar Línea</button>
            </form>
        </div>

        <div class="panel">
            <h2>Listado de Líneas</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Distancia Total</th>
                    <th>Municipalidad</th>
                </tr>

                <?php while($fila = mysqli_fetch_assoc($lineas)){ ?>
                <tr>
                    <td><?php echo $fila['idLinea']; ?></td>
                    <td><?php echo $fila['nombre']; ?></td>
                    <td><?php echo $fila['distanciaTotal']; ?> km</td>
                    <td><?php echo $fila['nombreMunicipalidad']; ?></td>
                </tr>
                <?php } ?>

            </table>
        </div>

    </div>

</div>

</body>
</html>