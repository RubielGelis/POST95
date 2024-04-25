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
        $menu_html .= '<li><a href="#" data-url="' . $row['ruta'] . '">' . $row['nombre'] . '</a></li>';
    }
    $menu_html .= '</ul>';

    // Retorna el HTML del menú
    return $menu_html;
}
?>