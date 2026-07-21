<?php
session_start();
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal - Gestión Hotelera</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
        .menu-hero {
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
        .btn-salir {
            background-color: #c93b3b;
            color: white;
            padding: 12px 35px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.1rem;
            border: 2px dashed #000; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .menu-hero h1 {
            color: #c93b3b;
            font-size: 3.5rem;
            font-weight: bold;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .vista-container {
            max-width: 1100px;
            margin: 20px auto 0 auto;
            padding: 0 40px;
            text-align: left;
        }
        .btn-vista {
            background-color: #c93b3b;
            color: white;
            padding: 10px 25px;
            border-radius: 50px;
            border: 2px dashed #000;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }
        .main-menu-options {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            min-height: 40vh;
            padding: 20px;
        }
        .menu-box {
            background: linear-gradient(135deg, #b88655, #ddb382);
            color: #000000;
            width: 260px;
            height: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: bold;
            border-radius: 35px;
            box-shadow: 0 8px 15px rgba(138, 90, 54, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: center;
        }
        .menu-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(138, 90, 54, 0.4);
        }
        .row-top { width: 100%; display: flex; justify-content: center; margin-bottom: -10px; }
        .row-bottom { display: flex; gap: 150px; justify-content: center; width: 100%; }
        .menu-footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            font-size: 0.85rem;
            color: #555;
            line-height: 1.6;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>
<body>
    <header class="menu-hero">
        <div class="top-buttons">
            <a href="logout.php" class="btn-salir">SALIR</a>
            <div></div> 
        </div>
        <h1>¿QUE HAREMOS HOY?</h1>
    </header>
    <div class="vista-container">
        <button class="btn-vista" id="toggle-vista">VISTA</button>
    </div>
    <main class="main-menu-options">
        <div class="row-top">
            <a href="registro_habitacion.php" class="menu-box">REGISTRO</a>
        </div>
        <div class="row-bottom">
            <a href="reportes.php" class="menu-box">REPORTES</a>
            <a href="entrega.php" class="menu-box">ENTREGA</a>
        </div>
    </main>
    <footer class="menu-footer">
        Todo el contenido, diseño, imágenes y elementos visuales de este hotel son propiedad exclusiva de la empresa. Queda prohibida su reproducción, distribución o uso autorización previa por escrito.
    </footer>
    <script>
        const btnVista = document.getElementById('toggle-vista');
        if (localStorage.getItem('modo-daltonico') === 'activo') {
            document.body.classList.add('daltonismo');
        }
        btnVista.addEventListener('click', () => {
            document.body.classList.toggle('daltonismo');
            if (document.body.classList.contains('daltonismo')) {
                localStorage.setItem('modo-daltonico', 'activo');
            } else {
                localStorage.setItem('modo-daltonico', 'inactivo');
            }
        });
    </script>
</body>
</html>


