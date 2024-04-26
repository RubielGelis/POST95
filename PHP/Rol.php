<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/estilos.css">
    <title>Maestro de Roles</title>
</head>
<body>
    <h1>Maestro de Roles</h1>
	<?php
		   // Incluye el archivo de funciones y llama a la función para consultar el rol-->
		   //include 'PeticionSQL.php';
		   $id = "";
		   $codigo = "";
		   $nombre = "";
		   if ($_SERVER["REQUEST_METHOD"] == "GET") {
			   $id=$_GET["id"];
			   $codigo=$_GET["codigo"];
			   $nombre=$_GET["nombre"];
		   }
	?>	   
    <!--<h2>Insertar Rol</h2>-->
    <form method="post">
        <input type="hidden" name="id" placeholder="Id del rol" value="<?php echo $id ?>">
		<input type="text" name="codigo" placeholder="Codigo del rol" value="<?php echo $codigo ?>" required>
		<input type="text" name="nombre" placeholder="Nombre del rol" value="<?php echo $nombre ?>" required>
        <input type="submit" name="Guardar" value="Guardar"/>
		<input type="reset"  name="Cancelar" value="Cancelar"/>
    </form>

    
	<div id="roles">
       <?php
		   // Incluye el archivo de funciones y llama a la función para consultar el menú-->
		   include 'PeticionSQL.php';
	
		   if ($_SERVER["REQUEST_METHOD"] == "POST") {
			   $id = $_POST["id"];
			   if(empty($id)){
				   echo InsertarRol();
			   }else{
				   if ($id != 0){
						echo ModificarRol();
				   }else{
					   echo InsertarRol();
				   }
			   }
		   }
		   
       ?>
    </div>
</body>
</html>