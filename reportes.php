<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include("config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = intval($_POST['habitacion']);
    $descripcion = trim($_POST['descripcion']);

    if (!empty($habitacion) && !empty($descripcion)) {
        $stmt = $conexion->prepare("INSERT INTO reportes (habitacion, descripcion) VALUES (?, ?)");
        $stmt->bind_param("is", $habitacion, $descripcion);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: ver_reportes.php");
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante"> Modo Daltonismo</button>
    <a href="menu.php" class="menu-hamburguesa">☰</a>
    <a href="ver_reportes.php" class="btn btn-cafe btn-superior-derecho" style="width: auto;">VER REPORTES</a>

    <div class="header-img-container" style="margin-top: 40px;">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">REPORTES</div>
    </div>

    <div class="content">
        <form action="reportes.php" method="POST">
            <div class="form-group">
                <label for="habitacion">HABITACION:</label>
                <input type="number" id="habitacion" name="habitacion" class="input-gradient" min="1" max="100" required>
            </div>

            <div class="form-group">
                <label for="descripcion">DESCRIPCION:</label>
                <textarea id="descripcion" name="descripcion" class="input-gradient" style="height: 120px; resize: none;" required></textarea>
            </div>

            <div style="text-align: center; margin-top: 25px;">
                <button type="submit" class="btn btn-cafe" style="width: 180px;">ENVIAR</button>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
