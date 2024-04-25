<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenido a mi página de inicio</h1>
        </header>
        
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <li><a href="#">Acerca de</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </nav>
        
        <section>
            <h2>Contenido principal</h2>
            <p>Esta es una página de inicio básica en PHP. Puedes agregar más contenido aquí.</p>
        </section>
        
        <footer>
            <p>Derechos de autor &copy; <?php echo date("Y"); ?>. Todos los derechos reservados.</p>
        </footer>
    </div>
</body>
</html>