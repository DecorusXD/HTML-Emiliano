<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = mysqli_real_escape_string($conn, $_POST['habitacion']);
    $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

    if (!empty($habitacion) && !empty($descripcion)) {
        $sql = "INSERT INTO reportes (habitacion, descripcion) VALUES ('$habitacion', '$descripcion')";
        if ($conn->query($sql) === TRUE) {
            $mensaje = "<div class='alert exito'>¡Reporte enviado con éxito!</div>";
        } else {
            $mensaje = "<div class='alert error'>Error: " . $conn->error . "</div>";
        }
    } else {
        $mensaje = "<div class='alert error'>Por favor, llena todos los campos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Gestión Hotelera</title>
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
        .btn-top-view {
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: black;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 0.9rem;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .reportes-hero h1 {
            color: #c93b3b;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .container-reportes {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }
        .form-group {
            margin-bottom: 25px;
        }
        .form-group label {
            display: block;
            color: #c93b3b;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.1rem;
        }
        .input-gris {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 4px;
            background: linear-gradient(to right, #9e9e9e, #ffffff);
            font-size: 1.1rem;
            outline: none;
            color: #333;
        }
        textarea.input-gris {
            height: 120px;
            resize: none;
        }
        .btn-enviar {
            background: linear-gradient(135deg, #a67c52, #c9935b);
            color: white;
            font-weight: bold;
            padding: 15px 50px;
            border-radius: 30px;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            display: block;
            margin: 30px auto;
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
        }
        .alert { padding: 15px; border-radius: 8px; font-weight: bold; text-align: center; margin-bottom: 20px; }
        .exito { background-color: #d4edda; color: #155724; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <header class="reportes-hero">
        <div class="top-buttons">
            <a href="panel.php" class="btn-regreso">REGRESO</a>
            <a href="ver_reportes.php" class="btn-top-view">VER REPORTES</a>
        </div>
        <h1>REPORTES</h1>
    </header>
    <main class="container-reportes">
        <?php echo $mensaje; ?>
        <form action="reportes.php" method="POST">
            <div class="form-group">
                <label>HABITACION:</label>
                <input type="text" name="habitacion" class="input-gris" required>
            </div>
            <div class="form-group">
                <label>DESCRIPCION:</label>
                <textarea name="descripcion" class="input-gris" required></textarea>
            </div>
            <button type="submit" class="btn-enviar">ENVIAR</button>
        </form>
    </main>
    <script>
        if (localStorage.getItem('modo-daltonico') === 'activo') { document.body.classList.add('daltonismo'); }
    </script>
</body>
</html>
