<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>¿Qué haremos hoy?</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <button id="btn-daltonismo" class="btn-daltonismo-flotante"> Modo Daltonismo</button>
    <a href="logout.php" class="btn btn-rojo btn-salir">SALIR</a>
    <a href="#" class="btn btn-cafe btn-superior-derecho" style="width: auto;">AYUDA</a>

    <div style="height: 60px;"></div>

    <div class="header-img-container">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">¿QUE HAREMOS HOY?</div>
    </div>

    <div class="content" style="text-align: center;">
        <div style="display: flex; flex-direction: column; gap: 20px; align-items: center; margin-top: 20px;">
            <a href="registro_huesped.php" class="btn btn-cafe" style="width: 250px;">REGISTRO</a>
            <div style="display: flex; gap: 30px; justify-content: center; width: 100%;">
                <a href="reportes.php" class="btn btn-cafe" style="width: 200px;">REPORTES</a>
                <a href="entrega.php" class="btn btn-cafe" style="width: 200px;">ENTREGA</a>
            </div>
        </div>

        <p style="margin-top: 60px; font-size: 0.8rem; color: #666;">
            Todo el contenido, diseño, imágenes y elementos visuales de este hotel son propiedad exclusiva de la empresa. Queda prohibida su reproducción, distribución o uso sin autorización previa por escrito. <br>
            CONTACTO: <br>
            emilianoaguilarmora4@gmail.com
        
        </p>
    </div>

    <script src="js/script.js"></script>
</body>
</html>