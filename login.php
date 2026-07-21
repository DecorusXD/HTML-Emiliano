<?php
session_start();
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conn->query($sql);
        if ($resultado->num_rows > 0) {
            $usuario_data = $resultado->fetch_assoc();
            if (password_verify($password, $usuario_data['password'])) {
                $_SESSION['id_usuario'] = $usuario_data['id'];
                $_SESSION['nombre_usuario'] = $usuario_data['usuario'];
                header("Location: panel.php");
                exit();
            } else {
                $mensaje = "<div class='alert error'>Contraseña incorrecta. Inténtalo de nuevo.</div>";
            }
        } else {
            $mensaje = "<div class='alert error'>Este correo electrónico no está registrado.</div>";
        }
    } else {
        $mensaje = "<div class='alert error'>Por favor, rellena todos los campos.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Gestión Hotelera</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .form-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
        .form-card {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(138, 90, 54, 0.15);
            width: 100%;
            max-width: 400px;
            text-align: center;
            border: 1px solid #ebdcb9;
        }
        .form-card h2 {
            color: #c93b3b;
            margin-bottom: 25px;
            font-size: 1.8rem;
        }
        .input-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: #8a5a36;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ebdcb9;
            border-radius: 8px;
            background-color: #fbf7ed;
            color: #333;
            font-size: 1rem;
            outline: none;
            transition: border 0.2s;
        }
        .input-group input:focus {
            border-color: #c93b3b;
        }
        .btn-submit {
            width: 100%;
            border: none;
            cursor: pointer;
            margin-top: 10px;
        }
        .form-footer {
            margin-top: 20px;
            font-size: 0.9rem;
        }
        .form-footer a {
            color: #c93b3b;
            text-decoration: none;
            font-weight: bold;
        }
        .alert {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 0.9rem;
            font-weight: bold;
        }
        .error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Iniciar Sesión</h2>
            <?php echo $mensaje; ?>
            <form action="login.php" method="POST">
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-submit">INGRESAR</button>
            </form>
            <div class="form-footer">
                <p>¿Aún no tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
                <p style="margin-top: 10px;"><a href="index.php" style="color: #8a5a36; font-weight: normal;">← Volver al inicio</a></p>
            </div>
        </div>
    </div>
</body>
</html>
