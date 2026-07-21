<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn->query("UPDATE limpieza SET limpia = 0");
    if (isset($_POST['habitaciones_limpias']) && is_array($_POST['habitaciones_limpias'])) {
        foreach ($_POST['habitaciones_limpias'] as $hab_id) {
            $hab_id = intval($hab_id);
            $conn->query("UPDATE limpieza SET limpia = 1 WHERE id = $hab_id");
        }
    }
    $mensaje = "<div class='alert exito'>Cambios guardados correctamente de forma acumulada.</div>";
}
$resultado = $conn->query("SELECT * FROM limpieza ORDER BY id ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Limpieza - Gestión Hotelera</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .limpieza-hero {
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
        .limpieza-hero h1 {
            color: #c93b3b;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .container-limpieza {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.05);
            border: 1px solid #ebdcb9;
        }
        .room-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #ebdcb9;
            transition: background-color 0.2s;
        }
        .room-row:hover { background-color: #fbf7ed; }
        .room-info {
            font-size: 1.1rem;
            color: #333;
        }
        .room-info strong { color: #8a5a36; }
        
        /* Estilizado del Checkbox */
        .checkbox-container {
            display: block;
            position: relative;
            padding-left: 35px;
            cursor: pointer;
            font-size: 1rem;
            user-select: none;
            color: #555;
        }
        .checkbox-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }
        .checkmark {
            position: absolute;
            top: -2px;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #fbf7ed;
            border: 2px solid #b88655;
            border-radius: 5px;
        }
        .checkbox-container input:checked ~ .checkmark {
            background-color: #c93b3b;
            border-color: #c93b3b;
        }
        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }
        .checkbox-container input:checked ~ .checkmark:after {
            display: block;
        }
        .checkbox-container .checkmark:after {
            left: 9px;
            top: 5px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
        .btn-guardar {
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: black;
            font-weight: bold;
            padding: 15px 40px;
            border-radius: 30px;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
            display: block;
            margin: 30px auto 10px auto;
            width: 250px;
            text-align: center;
        }
        .alert { padding: 15px; border-radius: 8px; font-weight: bold; text-align: center; margin-bottom: 20px; }
        .exito { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <header class="limpieza-hero">
        <div class="top-buttons">
            <a href="entrega.php" class="btn-regreso">REGRESO</a>
        </div>
        <h1>LIMPIEZA</h1>
    </header>
    <main class="container-limpieza">
        <?php echo $mensaje; ?>
        <form action="limpieza.php" method="POST">
            <?php while($room = $resultado->fetch_assoc()): ?>
                <div class="room-row">
                    <div class="room-info">
                        <strong>Habitación <?php echo $room['id']; ?></strong> — <?php echo $room['suite']; ?>
                    </div>
                    <div>
                        <label class="checkbox-container">
                            ¿Limpia?
                            <input type="checkbox" name="habitaciones_limpias[]" value="<?php echo $room['id']; ?>" <?php echo $room['limpia'] == 1 ? 'checked' : ''; ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>
            <?php endwhile; ?>
            <button type="submit" class="btn-guardar">GUARDAR CAMBIOS</button>
        </form>
    </main>
    <script>
        if (localStorage.getItem('modo-daltonico') === 'activo') {
            document.body.classList.add('daltonismo');
        }
    </script>
</body>
</html>
