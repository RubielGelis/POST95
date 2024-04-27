<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
    <title>Página de inicio</title>
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