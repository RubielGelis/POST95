<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
    <title>Gestión de Roles</title>
    
</head>
<body>
    <h1>Gestión de Roles</h1>
	<div id="Crear">
		<h2>Crear Rol</h2>
		<form method="get" action="Rol.php">
			<!--<input type="text" name="nombre" placeholder="Nombre del rol" required>-->
			<!--<input type="button" name="Crear" value="Crear Rol" onclick=" window.location = 'principal.php?url=' + encodeURIComponent('Rol.php?id=&codigo=&nombre=&inactivo=0')" />-->
			<!--<input type="button" name="Crear" value="Crear Rol" onclick=" window.location.href = 'Rol.php?id=&codigo=&nombre=&inactivo=0';" />-->
			<!--<input type="button" name="Crear" value="Crear Rol" onclick=" cargarPagina2('Rol.php?id=&codigo=&nombre=&inactivo=0','dcontenido');">-->
			<input type="button" name="Crear" value="Crear Rol" onclick=" cargarContenido('Rol.php?id=&codigo=&nombre=&inactivo=0');">			
		</form>
	</div>
    
	<div id="roles">
		<h2>Roles Existentes</h2>
		<form method="get" action="Rol.php" >
			<?php
			// Incluye el archivo de funciones y llama a la función para consultar el menú
			include 'PeticionSQL.php';
			echo consultarRol();
			?>
		</form>	
    </div>
</body>
</html>