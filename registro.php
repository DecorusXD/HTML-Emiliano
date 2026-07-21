<?php
include 'conexion.php';
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = mysqli_real_escape_string($conn, $_POST['usuario']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    if (!empty($usuario) && !empty($email) && !empty($password)) {
        $verificar_email = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $conn->query($verificar_email);
        if ($resultado->num_rows > 0) {
            $mensaje = "<div class='alert error'>Este correo electrónico ya está registrado.</div>";
        } else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO usuarios (usuario, email, password) VALUES ('$usuario', '$email', '$hash')";

            if ($conn->query($sql) === TRUE) {
                $mensaje = "<div class='alert exito'>¡Registro exitoso! Ya puedes iniciar sesión.</div>";
            } else {
                $mensaje = "<div class='alert error'>Error al registrar: " . $conn->error . "</div>";
            }
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
    <title>Registro - Gestión Hotelera</title>
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
        .exito { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
    <div class="form-wrapper">
        <div class="form-card">
            <h2>Crear Cuenta</h2>
            <?php echo $mensaje; ?>
            <form action="registro.php" method="POST">
                <div class="input-group">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" id="usuario" name="usuario" placeholder="Ej. juan123" required>
                </div>
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Crea una contraseña" required>
                </div>
                <button type="submit" class="btn btn-primary btn-submit">REGISTRARME</button>
            </form>
            <div class="form-footer">
                <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
                <p style="margin-top: 10px;"><a href="index.php" style="color: #8a5a36; font-weight: normal;">← Volver al inicio</a></p>
            </div>
        </div>
    </div>
</body>
</html>