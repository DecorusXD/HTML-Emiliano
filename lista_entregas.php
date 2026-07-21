<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
$sql = "SELECT * FROM entregas ORDER BY id DESC";
$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Entregas - Gestión Hotelera</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .entrega-hero {
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
        .entrega-hero h1 {
            color: #c93b3b;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .table-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            border: 1px solid #ebdcb9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }
        th, td {
            padding: 15px;
            border-bottom: 1px solid #ebdcb9;
        }
        th {
            color: #c93b3b;
            font-size: 1.1rem;
        }
        td {
            color: #555;
        }
        tr:hover { background-color: #fbf7ed; }
    </style>
</head>
<body>
    <header class="entrega-hero">
        <div class="top-buttons">
            <a href="entrega.php" class="btn-regreso">← VOLVER</a>
        </div>
        <h1>HISTORIAL</h1>
    </header>
    <main class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Habitación</th>
                    <th>Llave Entregada</th>
                    <th>Fecha de Desalojo</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while($row = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><strong>Habitación <?php echo $row['habitacion']; ?></strong></td>
                            <td><?php echo $row['llave_entregada']; ?></td>
                            <td><?php echo $row['fecha_desalojo']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" style="text-align: center; color: #8a5a36;">No hay entregas registradas aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>

    <script>
        if (localStorage.getItem('modo-daltonico') === 'activo') {
            document.body.classList.add('daltonismo');
        }
    </script>
</body>
</html>
