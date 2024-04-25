<?php
session_start();
require_once 'peticionSQL.php'; // Incluye el archivo de la consulta SQL

// Verifica si se envió el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si se enviaron los datos de usuario y contraseña
    if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        // Verifica las credenciales del usuario
        if (verificarCredenciales($usuario, $contrasena)) {
            // Las credenciales son correctas, inicia la sesión y redirige al usuario a la página de inicio
            $_SESSION['usuario'] = $usuario;
            header("Location: principal.php");
            exit;
        } else {
            // Si no se encontró ningún usuario, muestra un mensaje de error
            $error = "Usuario o contraseña incorrectos.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/estilos.css">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <?php
    // Muestra un mensaje de error si existe alguno
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="signin-form">
		<div class="form-element">
			<label for="usuario">Usuario:</label>
			<input type="text" id="usuario" name="usuario" pattern="[a-zA-Z0-9]+" required><br><br>
		</div>
		<div class="form-element">
			<label for="contrasena">Contraseña:</label>
			<input type="password" id="contrasena" name="contrasena" required><br><br>
		</div>	
		<input type="submit" value="Iniciar sesión">
    </form>
</body>
</html>