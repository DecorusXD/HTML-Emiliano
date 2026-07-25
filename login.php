<?php
include("config/conexion.php");
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = trim($_POST['correo']);
    $contrasena = $_POST['contrasena'];

    if (!empty($correo) && !empty($contrasena)) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios_hotel WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($usuario = $resultado->fetch_assoc()) {
            if (password_verify($contrasena, $usuario['contrasena'])) {
               
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];

                header("Location: menu.php");
                exit();
            } else {
                $mensaje = "<p style='color:red; text-align:center; font-weight:bold;'>Contraseña incorrecta.</p>";
            }
        } else {
            $mensaje = "<p style='color:red; text-align:center; font-weight:bold;'>El usuario no existe.</p>";
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
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante">👁️ Modo Daltonismo</button>
    <a href="index.php" class="btn btn-rojo btn-salir">SALIR</a>

    <div style="height: 60px;"></div>

    <div class="header-img-container">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">INICIAR SESION</div>
    </div>

    <div class="content">
        <?php echo $mensaje; ?>

        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="correo">USUARIO</label>
                <input type="email" id="correo" name="correo" class="input-gradient" required>
            </div>

            <div class="form-group">
                <label for="contrasena">CONTRASEÑA</label>
                <input type="password" id="contrasena" name="contrasena" class="input-gradient" required>
            </div>

            <button type="submit" class="btn btn-cafe">INGRESAR</button>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>



