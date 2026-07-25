<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include("config/conexion.php");

if (isset($_GET['cambiar'])) {
    $hab = intval($_GET['cambiar']);
    $estado_actual = $_GET['estado'];
    $nuevo_estado = ($estado_actual == 'Limpio') ? 'Socio/Pendiente' : 'Limpio';

    $stmt = $conexion->prepare("UPDATE habitaciones SET estado_limpieza = ? WHERE numero = ?");
    $stmt->bind_param("si", $nuevo_estado, $hab);
    $stmt->execute();
    $stmt->close();
    header("Location: limpieza.php");
    exit();
}

$resultado = $conexion->query("SELECT * FROM habitaciones ORDER BY numero ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Limpieza</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

    <button id="btn-daltonismo" class="btn-daltonismo-flotante"> Modo Daltonismo</button>
    <a href="entrega.php" class="btn btn-rojo btn-salir">VOLVER</a>

    <div class="header-img-container" style="margin-top: 50px;">
        <img src="img/lobby.jpg" alt="Lobby del Hotel">
        <div class="title-overlay">LIMPIEZA</div>
    </div>

    <div class="content">
        <table class="tabla-reportes">
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $resultado->fetch_assoc()): ?>
                <tr>
                    <td>Habitación <?php echo $row['numero']; ?></td>
                    <td>
                        <span style="color: <?php echo ($row['estado_limpieza'] == 'Limpio') ? '#2e7d32' : '#c62828'; ?>; font-weight: bold;">
                            <?php echo htmlspecialchars($row['estado_limpieza']); ?>
                        </span>
                    </td>
                    <td>
                        <a href="limpieza.php?cambiar=<?php echo $row['numero']; ?>&estado=<?php echo $row['estado_limpieza']; ?>" class="btn btn-cafe" style="padding: 6px 12px; font-size: 0.85rem; width: auto; display: inline-block;">
                            Cambiar Estado
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="js/script.js"></script>
</body>
</html>