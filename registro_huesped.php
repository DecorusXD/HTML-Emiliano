<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include("config/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = intval($_POST['habitacion']);
    $nombre = trim($_POST['nombre']);
    $noches = intval($_POST['noches']);

    if (!empty($habitacion) && !empty($nombre) && !empty($noches)) {
        $stmt = $conexion->prepare("INSERT INTO registros_huesped (habitacion, nombre_huesped, noches) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $habitacion, $nombre, $noches);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: menu.php");
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
    <title>Registro de Huésped</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante"> Modo Daltonismo</button>
    <a href="menu.php" class="menu-hamburguesa">☰</a>

    <div class="header-img-container" style="margin-top: 40px;">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">REGISTRO</div>
    </div>

    <div class="content">
        <form action="registro_huesped.php" method="POST">
            <label style="font-weight: bold; font-size: 1.1rem; color: var(--text-color);">HABITACION:</label>
            <div class="habitaciones-selector">
                <?php for($i = 1; $i <= 7; $i++): ?>
                    <input type="radio" id="hab<?php echo $i; ?>" name="habitacion" value="<?php echo $i; ?>" required>
                    <label for="hab<?php echo $i; ?>"><?php echo $i; ?></label>
                <?php endfor; ?>
            </div>

            <div class="form-group">
                <label for="nombre">NOMBRE DEL HUESPED:</label>
                <input type="text" id="nombre" name="nombre" class="input-gradient" required>
            </div>

            <div class="form-group">
                <label for="noches">NOCHES DE ESTANCIA:</label>
                <input type="number" id="noches" name="noches" min="1" class="input-gradient" required>
            </div>

            <div style="display: flex; justify-content: flex-end; margin-top: 25px;">
                <button type="submit" class="btn btn-cafe" style="width: 180px;">REGISTRAR</button>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
