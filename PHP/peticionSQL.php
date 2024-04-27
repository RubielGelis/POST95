<?php
require_once 'conexion.php'; // Incluye el archivo de conexión
ini_set('display_errors', 1);
error_reporting(E_ALL);
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
	$ruta = "principal.php";
    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes
    $menu_html = '<nav>';
	$menu_html .='<ul>';
    while ($row = pg_fetch_assoc($result)) {
		if ($row['codigo']== 'salir'){
			$menu_html .= '<li><a href="' . $row['ruta'] .'" data-url="#">' . $row['nombre'] . '</a></li>';
		}else{
			$menu_html .= '<li><a href="#" data-url="'. $row['ruta'] .'">' . $row['nombre'] . '</a></li>';
			//$menu_html .= '<li><a href="' . $row['ruta'] .'" data-url="#">' . $row['nombre'] . '</a></li>';			
		}
    }
    $menu_html .= '</ul>';
	$menu_html .= '</nav>';	
    // Retorna el HTML del menú
    return $menu_html;
}
function consultarRol() {
    global $db;
    $url = "principal.php?url=Roles.php";//$_GET['url'];
    // Consulta SQL para obtener el rol
    $query = "SELECT * FROM Rol";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes
	$urlEnviar="";
	$urlCodificada="";
    $rol_html = "<table>";
	$rol_html .= "<tr><th>Codigo</th><th>Nombre</th><th>Inactivo</th><th>Consultar</th><th>Eliminar</th></tr>";
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$rol_html .= "<tr>";
		$rol_html .= "<td>".$row['codigo']."</td>";
		$rol_html .= "<td>".$row['nombre']."</td>";
		$rol_html .= "<td><input type='checkbox' " . ($row['inactivo']==1 ? 'checked' : '') . ' disabled></td>';
		$urlEnviar = "Rol.php?id=".$row['id']."&codigo=".$row['codigo']."&nombre=".$row['nombre']."&inactivo=".$row['inactivo'];;
		$urlCodificada = urlencode($urlEnviar);
		$rol_html .= "<td><a href='principal.php?url=". $urlCodificada ."'>Consultar</a></td>"; // Enlace para consultar
		$rol_html .= "<td><a href='#' onclick=\"EliminarRol(".$row['id'].",'".$url."');\">Eliminar</a></td>"; // Enlace para eliminar
		$rol_html .= "</tr>";
	}
	$rol_html .= "</table>";
	
    // Retorna el HTML del rol
    return $rol_html;
}
function consultarPerfil() {
    global $db;
    $url = "principal.php?url=Perfiles.php";
    // Consulta SQL para obtener el menú
    $query = "select p.id,p.codigo,p.nombre,p.id_rol,r.codigo codigo_rol,r.nombre nombre_rol,p.inactivo from Perfil p inner join Rol r on r.id=p.id_rol";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes
	$urlEnviar="";
	$urlCodificada="";
    $perfil_html = '<table>';
	$perfil_html .= "<tr><th>Codigo</th><th>Nombre</th><th>Rol</th><th>inactivo</th><th>Consultar</th><th>Eliminar</th></tr>";
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$perfil_html .= '<tr>';
		$perfil_html .= '<td>'.$row['codigo'].'</td>';
		$perfil_html .= '<td>'.$row['nombre'].'</td>';
		$perfil_html .= '<td>'.$row['nombre_rol'].'</td>';
		$perfil_html .= "<td><input type='checkbox' " . ($row['inactivo'] ? 'checked' : '') . ' disabled></td>';
		$urlEnviar = "Perfil.php?id=".$row['id']."&codigo=".$row['codigo']."&nombre=".$row['nombre']."&id_rol=".$row['id_rol']."&codigo_rol=".$row['codigo_rol']."&nombre_rol=".$row['nombre_rol']."&inactivo=".$row['inactivo'];
		$urlCodificada = urlencode($urlEnviar);
		$perfil_html .= "<td><a href='principal.php?url=". $urlCodificada ."'>Consultar</a></td>"; // Enlace para consultar			
		$perfil_html .= "<td><a href='#' onclick=\"EliminarPerfil(".$row['id'].",'".$url."');\">Eliminar</a></td>";
		$perfil_html .= '</tr>';
	}
	$perfil_html .= '</table>';
    // Retorna el HTML del perfil
    return $perfil_html;
}
function consultarUsuarios() {
    global $db;
    $url = "principal.php?url=Perfiles.php";
    // Consulta SQL para obtener el menú
    $query = "SELECT u.id,u.codigo,u.nombre,u.id_perfil,p.codigo codigo_perfil,p.nombre nombre_perfil,u.inactivo FROM Usuarios u INNER JOIN Perfil p ON p.id=u.id_perfil ";
    $result = pg_query($db, $query);

    // Verifica si la consulta fue exitosa
    if (!$result) {
        return "Error en la consulta.";
    }

    // Genera el HTML del menú con enlaces a las páginas correspondientes
	$urlEnviar="";
	$urlCodificada="";
    $usuario_html = '<table>';
	$usuario_html .= '<tr>';
	$usuario_html .= '<th>Codigo</th>';
	$usuario_html .= '<th>Nombre</th>';
	$usuario_html .= '<th>Perfil</th>';
	$usuario_html .= '<th>Inactivo</th>';
	$usuario_html .= '<th>Consultar</th>';
	$usuario_html .= '<th>Eliminar</th>';
	$usuario_html .= '</tr>';
	// Mostrar roles existentes
	while ($row = pg_fetch_assoc($result)) {
		$usuario_html .= '<tr>';
		$usuario_html .= '<td>'.$row['codigo'].'</td>';
		$usuario_html .= '<td>'.$row['nombre'].'</td>';
		$usuario_html .= "<td><input type='checkbox' " . ($row['inactivo'] ? 'checked' : '') . ' disabled></td>';
		$urlEnviar = "Usuario.php?id=".$row['id']."&codigo=".$row['codigo']."&nombre=".$row['nombre']."&id_perfil=".$row['id_perfil']."&codigo_perfil=".$row['codigo_perfil']."&nombre_perfil=".$row['nombre_perfil']."&inactivo=".$row['inactivo'];;
		$urlCodificada = urlencode($urlEnviar);
		$usuario_html .= "<td><a href='principal.php?url=". $urlCodificada ."'>Consultar</a></td>"; // Enlace para consultar	
		$usuario_html .= "<td><a href='#' onclick=\"EliminarUsuario(".$row['id'].",'".$url."');\">Eliminar</a></td>";
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
		$inactivo = $_POST['inactivo'];
		//echo "Entro" .$codigo . " " .$nombre. " " . $inactivo;
		// Insertar rol en la base de datos
		$query = "INSERT INTO Rol(codigo,nombre,inactivo) VALUES('$codigo','$nombre','$inactivo')";
		//$query = "INSERT INTO Rol(codigo,nombre) VALUES('$codigo','$nombre')";
		$result = pg_query($db, $query);
		
		// Verificar si la inserción fue exitosa
		if ($result) {
			$resultado_html = "<script>alert('Rol insertado correctamente.');</script>";
		} else {
			$resultado_html = "<script>alert('Error al insertar el rol.');</script>";
		}

		// Cerrar conexión a la base de datos
		//pg_close($conexion);
	}
	return $resultado_html;
}
function ModificarRol() {
    global $db;
	$resultado_html='';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Obtener el nombre del rol del formulario
		$id = $_POST["id"];
		$codigo = $_POST["codigo"];
		$nombre = $_POST["nombre"];
		$inactivo = $_POST['inactivo'];
		//$inactivo = 0;//$_POST['inactivo'];
		
		// Insertar rol en la base de datos
		$query = "UPDATE Rol SET codigo='$codigo',nombre='$nombre',inactivo='$inactivo' WHERE id='$id'";
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
	return $resultado_html;
}
function EliminarRol($id,$url){
	global $db;
	$resultado_html="<script>alert('Error al eliminar el rol.');</script>";
	
	$query = "DELETE FROM Rol WHERE id='$id'";
    $result = pg_query($db, $query);
	// Verificar si la eliminacion fue exitosa
	if ($result) {
		$resultado_html = "<script>alert('Rol Eliminado correctamente.'); window.location..href='" .$url. "';</script>";
		//$resultado_html = "<script>alert('Rol Eliminado correctamente.');</script>";
	} else {
		$resultado_html = "<script>alert('Error al eliminar el rol.'); window.location..href='" .$url. "';</script>";
		//$resultado_html="<script>alert('Error al eliminar el rol.');</script>";
	}

	return $resultado_html;
}
function InsertarPerfil() {
    global $db;
	$resultado_html='';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Obtener el nombre del rol del formulario
		$codigo = $_POST["codigo"];
		$nombre = $_POST["nombre"];
		$id_rol = $_POST["id_rol"];
		$inactivo = 0;//$_POST["inactivo"];

		// Insertar rol en la base de datos
		$query = "INSERT INTO Perfil (codigo,nombre,id_rol,inactivo) VALUES ('$codigo','$nombre','$id_rol','$inactivo')";
		$result = pg_query($db, $query);
		
		// Verificar si la inserción fue exitosa
		if ($result) {
			$resultado_html = "<script>alert('Perfil insertado correctamente.');window.history.back();</script>";
		} else {
			$resultado_html = "<script>alert('Perfil al insertar el rol.');</script>";
		}

		// Cerrar conexión a la base de datos
		//pg_close($conexion);
	}
	return $resultado_html;
}
function ModificarPerfil() {
    global $db;
	$resultado_html='';
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		// Obtener el nombre del rol del formulario
		$id = $_POST["id"];
		$codigo = $_POST["codigo"];
		$nombre = $_POST["nombre"];
		$id_rol = $_POST["id_rol"];
		$inactivo = $_POST["inactivo"];
		//$inactivo = isset($_POST['inactivo']==1) ? 1 : 0;

		// Insertar rol en la base de datos
		$query = "UPDATE Perfil SET codigo='$codigo',nombre='$nombre',id_rol='$id_rol',inactivo='$inactivo' WHERE id='$id'";
		$result = pg_query($db, $query);
		
		// Verificar si la inserción fue exitosa
		if ($result) {
			$resultado_html = "<script>alert('Perfil modificado correctamente.');window.history.back();</script>";
		} else {
			$resultado_html = "<script>alert('Error al modificar el Perfil.');</script>";
		}

		// Cerrar conexión a la base de datos
		//pg_close($conexion);
	}
	return $resultado_html;
}
function EliminarPerfil($id,$url){
	global $db;
	$resultado_html="<script>alert('Error al eliminar el Perfil.');</script>";
	
	$query = "DELETE FROM Perfil WHERE id='$id'";
    $result = pg_query($db, $query);
	// Verificar si la eliminacion fue exitosa
	if ($result) {
		$resultado_html = "<script>alert('Perfil Eliminado correctamente.'); window.location.href='" .$url. "';</script>";
	} else {
		$resultado_html = "<script>alert('Error al eliminar el Perfil.'); window.location.href='" .$url. "';</script>";
	}

	return $resultado_html;
}
if(isset($_GET['EliminarRol'])) {
    $id = $_GET['id'];
	$url = $_GET['url'];
    $resultado_html = EliminarRol($id,$url);
	echo $resultado_html;
}
if(isset($_GET['EliminarPerfil'])) {
    $id = $_GET['id'];
	$url = $_GET['url'];
    $resultado_html = EliminarPerfil($id,$url);
	echo $resultado_html;
}
?>
