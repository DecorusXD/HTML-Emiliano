<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $habitacion = isset($_POST['habitacion']) ? mysqli_real_escape_string($conn, $_POST['habitacion']) : '';
    $llave = mysqli_real_escape_string($conn, $_POST['llave_entregada']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha_desalojo']);
    if (!empty($habitacion) && !empty($llave) && !empty($fecha)) {
        $sql = "INSERT INTO entregas (habitacion, llave_entregada, fecha_desalojo) VALUES ('$habitacion', '$llave', '$fecha')";
        if ($conn->query($sql) === TRUE) {
            header("Location: lista_entregas.php");
            exit();
        } else {
            $mensaje = "<div class='alert error'>Error al guardar: " . $conn->error . "</div>";
        }
    } else {
        $mensaje = "<div class='alert error'>Por favor, llene todos los campos y seleccione una habitación.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrega - Gestión Hotelera</title>
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
        .form-entrega {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        .left-side { display: flex; flex-direction: column; gap: 25px; }
        .right-side { display: flex; flex-direction: column; gap: 40px; justify-content: center; align-items: flex-end; }
        .section-title {
            color: #8a5a36;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .radio-group { display: flex; gap: 15px; flex-wrap: wrap; }
        .radio-container { position: relative; }
        .radio-container input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }
        .radio-tile {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: white;
            border-radius: 50%;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        .radio-container input:checked ~ .radio-tile {
            background: #c93b3b;
            transform: scale(1.1);
            border: 2px solid #000;
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
        .btn-side {
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: black;
            font-weight: bold;
            padding: 15px 40px;
            border-radius: 30px;
            text-decoration: none;
            border: none;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
            text-align: center;
            width: 200px;
        }
        .alert { padding: 10px; border-radius: 5px; grid-column: span 2; font-weight: bold; text-align: center; }
        .error { background-color: #f8d7da; color: #721c24; }
    </style>
</head>
<body>
    <header class="entrega-hero">
        <div class="top-buttons">
            <a href="panel.php" class="btn-regreso">REGRESO</a>
        </div>
        <h1>ENTREGA</h1>
    </header>
    <div class="form-wrapper">
        <form action="entrega.php" method="POST" class="form-entrega">
            <?php echo $mensaje; ?>
            <div class="left-side">
                <div>
                    <div class="section-title">HABITACION:</div>
                    <div class="radio-group">
                        <?php for($i=1; $i<=7; $i++): ?>
                            <label class="radio-container">
                                <input type="radio" name="habitacion" value="<?php echo $i; ?>">
                                <div class="radio-tile"><?php echo $i; ?></div>
                            </label>
                        <?php endfor; ?>
                    </div>
                </div>
                <div>
                    <div class="section-title">LLAVE ENTREGADA:</div>
                    <input type="text" name="llave_entregada" class="input-gris" placeholder="Escribe el estado o código de llave" required>
                </div>
                <div>
                    <div class="section-title">FECHA DE DESALOJO:</div>
                    <input type="date" name="fecha_desalojo" class="input-gris" required>
                </div>
            </div>
            <div class="right-side">
                <!-- El botón limpieza redirigirá a limpieza.php -->
                <a href="limpieza.php" class="btn-side">LIMPIEZA</a>
                <button type="submit" class="btn-side" style="background: linear-gradient(135deg, #a67c52, #c9935b);">MARCAR</button>
            </div>
        </form>
    </div>
    <script>
        if (localStorage.getItem('modo-daltonico') === 'activo') {
            document.body.classList.add('daltonismo');
        }
    </script>
</body>
</html>
