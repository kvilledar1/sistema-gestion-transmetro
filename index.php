<?php
session_start();

if(isset($_SESSION['usuario']))
{
    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - Sistema de Gestión del Transmetro</title>
<link rel="stylesheet" href="css/estilos.css">
</head>
<body class="login-body">

<div class="login-contenedor">

    <div class="login-info">
        <h1>TRANSMETRO</h1>
        <h3>VILLEDAS SYSTEMS</h3>

        <h2>Sistema de Gestión del Transmetro</h2>

        <p>
            Plataforma diseñada para controlar líneas, estaciones,
            buses, operadores, pilotos e incidencias del sistema de transporte.
        </p>

        <div class="bus-dibujo">🚌</div>
    </div>

    <div class="login-formulario">
        <h2>Inicio de Sesión</h2>
        <p>Ingrese sus credenciales para acceder al sistema</p>

        <form action="login.php" method="POST">
            <label>Usuario</label>
            <input type="text" name="usuario" placeholder="Ingrese su usuario" required>

            <label>Contraseña</label>
            <input type="password" name="clave" placeholder="Ingrese su contraseña" required>

            <button type="submit">Iniciar sesión</button>
        </form>

        <a href="#" class="recuperar">Recuperar contraseña</a>

        <div class="pie-login">
            © 2026 Villeda Systems. Todos los derechos reservados.
        </div>
    </div>

</div>

</body>
</html>