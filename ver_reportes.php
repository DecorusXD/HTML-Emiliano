<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
if (isset($_GET['eliminar'])) {
    $id_eliminar = intval($_GET['eliminar']);
    $conn->query("DELETE FROM reportes WHERE id = $id_eliminar");
    header("Location: ver_reportes.php");
    exit();
}
$resultado = $conn->query("SELECT * FROM reportes ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Reportes - Gestión Hotelera</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .reportes-hero {
            background: url('IMG/lobby.jpg') no-repeat center center/cover;
            height: 35vh;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .top-buttons {
            position: absolute;
            top: 20px;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 30px;
            align-items: center;
        }
        .btn-regreso {
            background-color: #c93b3b;
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            border: 2px dashed #000;
        }
        .btn-volver-red {
            background-color: #c93b3b;
            color: white;
            padding: 12px 35px;
            border-radius: 20px;
            text-decoration: none;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .reportes-hero h1 {
            color: #c93b3b;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .container-lista {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .reporte-item {
            display: flex;
            align-items: center;
            gap: 20px;
            width: 100%;
        }
        .reporte-badge {
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: black;
            font-weight: bold;
            width: 110px;
            height: 90px;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            font-size: 0.9rem;
            flex-shrink: 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .reporte-badge span { font-size: 1.2rem; display: block; }
        .reporte-text-box {
            flex-grow: 1;
            padding: 20px;
            background: linear-gradient(to right, #9e9e9e, #ffffff);
            border-radius: 4px;
            font-size: 1.1rem;
            color: #222;
            min-height: 90px;
            display: flex;
            align-items: center;
        }
        .btn-delete-x {
            background-color: #c93b3b;
            color: white;
            width: 50px;
            height: 70px;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.2rem;
            flex-shrink: 0;
            border: 2px solid rgba(0,0,0,0.1);
            box-shadow: 3px 3px 0px #abc4ff; /* Simula la sombra azulada de tu captura */
        }
    </style>
</head>
<body>
    <header class="reportes-hero">
        <div class="top-buttons">
            <a href="panel.php" class="btn-regreso">REGRESO</a>
            <a href="reportes.php" class="btn-volver-red">VOLVER</a>
        </div>
        <h1>REPORTES</h1>
    </header>
    <main class="container-lista">
        <?php if ($resultado->num_rows > 0): ?>
            <?php $contador = 1; ?>
            <?php while($row = $resultado->fetch_assoc()): ?>
                <div class="reporte-item">
                    <div class="reporte-badge">
                        REPORTE <span><?php echo $contador; ?></span>
                    </div>
                    <div class="reporte-text-box">
                        <strong>Hab. <?php echo $row['habitacion']; ?>:</strong>&nbsp;<?php echo $row['descripcion']; ?>
                    </div>
                    <a href="ver_reportes.php?eliminar=<?php echo $row['id']; ?>" class="btn-delete-x" onclick="return confirm('¿Seguro que deseas eliminar este reporte?')">X</a>
                </div>
                <?php $contador++; ?>
            <?php endwhile; ?>
        <?php else: ?>
            <div style="text-align: center; color: #8a5a36; font-size: 1.2rem; font-weight: bold; margin-top: 30px;">
                No hay reportes activos en este momento.
            </div>
        <?php endif; ?>
    </main>

    <script>
        if (localStorage.getItem('modo-daltonico') === 'activo') { document.body.classList.add('daltonismo'); }
    </script>
</body>
</html>

