<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include("config/conexion.php");

$resultado = $conexion->query("SELECT * FROM entregas ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Entrega</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante">👁️ Modo Daltonismo</button>
    <a href="entrega.php" class="btn btn-rojo btn-salir">VOLVER</a>

    <div class="header-img-container" style="margin-top: 50px;">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay" style="font-size: 2.2rem;">REPORTES DE ENTREGA</div>
    </div>

    <div class="content">
        <table class="tabla-reportes">
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Llave Entregada</th>
                    <th>Fecha de Desalojo</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado && $resultado->num_rows > 0): ?>
                    <?php while($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td>Habitación <?php echo htmlspecialchars($row['habitacion']); ?></td>
                        <td><?php echo htmlspecialchars($row['llave_entregada']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_desalojo']); ?></td>
                        <td><?php echo htmlspecialchars($row['fecha_registro']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align: center;">No hay registros de entrega aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
