<?php
require_once 'conexion.php'; // Incluye el archivo de conexión

function verificarCredenciales($usuario, $contrasena) {
    global $db;
    
    // Escapa los valores del formulario para evitar inyección SQL
    $usuario = pg_escape_string($db, $usuario);
    $contrasena = pg_escape_string($db, $contrasena);

    // Consulta SQL para verificar las credenciales del usuario
    $query = "SELECT * FROM usuarios WHERE login='$usuario' AND password='$contrasena' AND inactivo=0";
    $result = pg_query($db, $query);

    // Verifica si se encontró algún usuario con las credenciales proporcionadas
    if (pg_num_rows($result) == 1) {
        return true; // Credenciales válidas
    } else {
        return false; // Credenciales inválidas
    }
}
function consultarMenu() {
    global $db;
    
    // Consulta SQL para obtener el menú
    $query = "SELECT * FROM menu WHERE inactivo=0";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes
    $menu_html = '<ul>';
    while ($row = pg_fetch_assoc($result)) {
        $menu_html .= '<li><a href="#" data-url="' . $row['ruta'] . '?url='. $row['ruta'] .'">' . $row['nombre'] . '</a></li>';
    }
    $menu_html .= '</ul>';

    // Retorna el HTML del menú
    return $menu_html;
}
function consultarRol() {
    global $db;
    $url = $_GET['url'];
    // Consulta SQL para obtener el menú
    $query = "SELECT * FROM Rol WHERE inactivo=0";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes

    $rol_html = "<table>";
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$rol_html .= "<tr>";
		$rol_html .= "<td>".$row['codigo']."</td>";
		$rol_html .= "<td>".$row['nombre']."</td>";
		$rol_html .= "<td><a href='Rol.php?id=".$row['id']."&codigo=".$row['codigo']."&nombre=".$row['nombre']."'>Consultar</a></td>"; // Enlace para consultar
		$rol_html .= "<td><a href='#' onclick=\"EliminarRol(".$row['id'].",'".$url."');\">Eliminar</a></td>"; // Enlace para eliminar
		$rol_html .= "</tr>";
	}
	$rol_html .= "</table>";
	
    // Retorna el HTML del rol
    return $rol_html;
}
function consultarPerfil() {
    global $db;
    
    // Consulta SQL para obtener el menú
    $query = "SELECT * FROM Perfil WHERE inactivo=0";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes

    $perfil_html = '<table>';
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$perfil_html .= '<tr>';
		$perfil_html .= '<td>'.$row['codigo'].'</td>';
		$perfil_html .= '<td>'.$row['nombre'].'</td>';
		$perfil_html .= '<td><a href="Perfil.php?id='.$row['id'].'">Consultar</a></td>'; // Enlace para consultar
		$perfil_html .= '</tr>';
	}
	$perfil_html .= '</table>';
    // Retorna el HTML del perfil
    return $perfil_html;
}
function consultarUsuarios() {
    global $db;
    
    // Consulta SQL para obtener el menú
    $query = "SELECT * FROM Usuarios WHERE inactivo=0";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes

    $usuario_html = '<table>';
	$usuario_html .= '<tr>';
	$usuario_html .= '<td>Codigo</td>';
	$usuario_html .= '<td>Nombre</td>';
	$usuario_html .= '<td>Accion</td>';
	$usuario_html .= '</tr>';
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$usuario_html .= '<tr>';
		$usuario_html .= '<td>'.$row['codigo'].'</td>';
		$usuario_html .= '<td>'.$row['nombre'].'</td>';
		$usuario_html .= '<td><a href="Usuario.php?id='.$row['id'].'">Consultar</a></td>'; // Enlace para consultar
		$usuario_html .= '</tr>';
	}
	$usuario_html .= '</table>';
    // Retorna el HTML del usuario
    return $usuario_html;
}
function InsertarRol() {
    global $db;
	$resultado_html='';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Obtener el nombre del rol del formulario
		$codigo = $_POST["codigo"];
		$nombre = $_POST["nombre"];

		// Insertar rol en la base de datos
		$query = "INSERT INTO Rol (codigo,nombre) VALUES ('$codigo','$nombre')";
		$result = pg_query($db, $query);
		
		// Verificar si la inserción fue exitosa
		if ($result) {
			$resultado_html = "<script>alert('Rol insertado correctamente.');window.history.back();</script>";
		} else {
			$resultado_html = "<script>alert('Error al insertar el rol.');</script>";
		}

		// Cerrar conexión a la base de datos
		//pg_close($conexion);
	}
	echo $resultado_html;
}
function ModificarRol() {
    global $db;
	$resultado_html='';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Obtener el nombre del rol del formulario
		$id = $_POST["id"];
		$codigo = $_POST["codigo"];
		$nombre = $_POST["nombre"];

		// Insertar rol en la base de datos
		$query = "UPDATE Rol SET codigo='$codigo',nombre='$nombre' WHERE id='$id'";
		$result = pg_query($db, $query);
		
		// Verificar si la inserción fue exitosa
		if ($result) {
			$resultado_html = "<script>alert('Rol modificado correctamente.');window.history.back();</script>";
		} else {
			$resultado_html = "<script>alert('Error al modificar el rol.');</script>";
		}

		// Cerrar conexión a la base de datos
		//pg_close($conexion);
	}
	echo $resultado_html;
}
function EliminarRol($id,$url){
	global $db;
	$resultado_html="<script>alert('Error al eliminar el rol.');</script>";
	
	$query = "DELETE FROM Rol WHERE id='$id'";
    $result = pg_query($db, $query);
	// Verificar si la eliminacion fue exitosa
	if ($result) {
		//$resultado_html = "<script>alert('Rol Eliminado correctamente.'); window.location.assign('principal.php?url=" .$url. "');</script>";
		$resultado_html = "<script>alert('Rol Eliminado correctamente.')</script>";
	} else {
		//$resultado_html = "<script>alert('Error al eliminar el rol.'); window.location.assign('principal.php?url=" .$url. "');</script>";
		$resultado_html="<script>alert('Error al eliminar el rol.');</script>";
	}

	return $resultado_html;
}
if(isset($_GET['EliminarRol'])) {
    $id = $_GET['id'];
	$url = $_GET['url'];
    $resultado_html = EliminarRol($id,$url);
	echo $resultado_html;
	return true;
}
?>
