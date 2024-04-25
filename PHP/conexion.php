<?php
// Detalles de la conexión a PostgreSQL
$host = 'localhost';
$port = '5432';
$dbname = 'POST';
$user = 'postgres';
$password = '123456789*';

// Intenta conectarte a la base de datos
$db = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Verifica si la conexión fue exitosa
if (!$db) {
    die("Error al conectar a la base de datos.");
}
?>