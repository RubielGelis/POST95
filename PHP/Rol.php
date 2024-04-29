<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
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
		   $inactivo = 0;
		   if ($_SERVER["REQUEST_METHOD"] == "GET") {
			   $id=isset($_GET["id"])? $_GET["id"]: "";
			   $codigo=isset($_GET["codigo"])? $_GET["codigo"]: "";
			   $nombre=isset($_GET["nombre"])? $_GET["nombre"]: "";
			   $inactivo=$_GET["inactivo"];
		   }
	?>	   
    <!--<h2>Insertar Rol</h2>-->
    <form method="post">
        <input type="hidden" id="id" name="id" placeholder="Id del rol" value="<?php echo $id ?>">
		<input type="text" id="codigo" name="codigo" placeholder="Codigo del rol" value="<?php echo $codigo ?>" required>
		<input type="text" id="nombre" name="nombre" placeholder="Nombre del rol" value="<?php echo $nombre ?>" required>
		<input type="checkbox" id="inactivo" name="inactivo" onclick="inactivoclick();" placeholder="Inactivo del Rol" value="<?php echo $inactivo ?>" <?php echo ($inactivo ? 'checked' : ''); ?>> 
        <!--<input type="submit" name="Guardar" value="Guardar"/>-->
		<button id="Guardar" name="Guardar" onclick="GuardarRol('<?php echo $id ?>','Roles.php');" >Guardar</button>
		<input type="reset"  name="Cancelar" value="Cancelar"/>
		
    </form>

	<div id="roles">
		<?php
		   // Incluye el archivo de funciones y llama a la función para consultar el menú-->
		   include 'PeticionSQL.php';
			//ini_set('display_errors', 1);
			//error_reporting(E_ALL);
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