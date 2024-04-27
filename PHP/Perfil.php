<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
    <title>Maestro de Perfil</title>
</head>
<body>
    <h1>Maestro de Perfil</h1>
	<?php
		   // Incluye el archivo de funciones y llama a la función para consultar el perfiles-->
		   //include 'PeticionSQL.php';
		   $id = "";
		   $codigo = "";
		   $nombre = "";
		   if ($_SERVER["REQUEST_METHOD"] == "GET") {
			   $id=$_GET["id"];
			   $codigo=$_GET["codigo"];
			   $nombre=$_GET["nombre"];			   
			   $id_rol=$_GET["id_rol"];
			   $codigo_rol=$_GET["codigo_rol"];
			   $nombre_rol=$_GET["nombre_rol"];
			   $inactivo=$_GET["inactivo"];
		   }
	?>	   
    <!--<h2>Insertar Rol</h2>-->
    <form method="post">
        <input type="hidden" name="id" placeholder="Id del perfil" value="<?php echo $id ?>">
		<input type="text" name="codigo" placeholder="Codigo del perfil" value="<?php echo $codigo ?>" required>
		<input type="text" name="nombre" placeholder="Nombre del perfil" value="<?php echo $nombre ?>" required>
		<input type="hidden" name="id_rol" placeholder="Id del rol" value="<?php echo $id_rol ?>">
		<input type="hidden" name="codigo_rol" placeholder="Codigo del rol" value="<?php echo $codigo_rol ?>">
		<input type="text" name="Rol" placeholder="Nombre del rol" value="<?php echo $nombre_rol ?>">
		<input type="checkbox" name="inactivo" placeholder="Inactivo del Perfil" <?php echo ($inactivo ? 'checked' : ''); ?>> 
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
				   echo InsertarPerfil();
			   }else{
				   if ($id != 0){
						echo ModificarPerfil();
				   }else{
					   echo InsertarPerfil();
				   }
			   }
		   }
		   
       ?>
    </div>
</body>
</html>