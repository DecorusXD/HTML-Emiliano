<?php
include("config/conexion.php");
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $nombre = trim($_POST['nombre']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    if (!empty($correo) && !empty($nombre) && !empty($_POST['contrasena'])) {
        $stmt = $conexion->prepare("INSERT INTO usuarios_hotel (correo, nombre, contrasena) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $correo, $nombre, $contrasena);

        if ($stmt->execute()) {
            $mensaje = "<p style='color:green; text-align:center; font-weight:bold; margin-bottom:15px;'>¡Registro exitoso!</p>";
        } else {
            $mensaje = "<p style='color:red; text-align:center; font-weight:bold; margin-bottom:15px;'>Error: El correo ya está registrado.</p>";
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante">👁️ Modo Daltonismo</button>
    <a href="index.php" class="btn btn-rojo btn-salir">SALIR</a>

    <div style="height: 60px;"></div>

    <div class="header-img-container punteado">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">REGISTRARSE</div>
    </div>

    <div class="content">
        <?php echo $mensaje; ?>

        <form action="registro.php" method="POST">
            <div class="form-group">
                <label for="correo">CORREO ELECTRONICO</label>
                <input type="email" id="correo" name="correo" class="input-gradient" required>
            </div>

            <div class="form-group">
                <label for="nombre">NOMBRE</label>
                <input type="text" id="nombre" name="nombre" class="input-gradient" required>
            </div>

            <div class="form-group">
                <label for="contrasena">CONTRASEÑA</label>
                <input type="password" id="contrasena" name="contrasena" class="input-gradient" required>
            </div>

            <button type="submit" class="btn btn-cafe">REGISTRAR</button>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>

