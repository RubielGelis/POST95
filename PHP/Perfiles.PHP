<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
    <title>Gestión de Perfil</title>
    
</head>
<body>
    <h1>Gestión de Perfil</h1>
	<div id="Crear">
		<h2>Crear Perfil</h2>
		<form method="get" action="Rol.php">
			<!--<input type="text" name="nombre" placeholder="Nombre del rol" required>-->
			<input type="button" name="Crear" value="Crear Perfil" onclick=" window.location = 'principal.php?url=' + encodeURIComponent('Perfil.php?id=&codigo=&nombre=&id_rol=&codigo_rol=&nombre_rol=&inactivo=0')" />
		</form>
	</div>
    
	<div id="roles">
		<h2>Perfiles Existentes</h2>
		<form method="get" action="Perfil.php" >
			<?php
			// Incluye el archivo de funciones y llama a la función para consultar el menú
			include 'PeticionSQL.php';
			echo consultarPerfil();
			?>
		</form>	
    </div>
	
</body>
</html>