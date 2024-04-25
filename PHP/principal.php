<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú y Contenido</title>
    <style>
        /* Estilos CSS para el menú */
        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        li {
            display: inline;
            margin-right: 10px;
        }
        li a {
            text-decoration: none;
            color: #333;
            cursor: pointer; /* Cambia el cursor al pasar sobre los enlaces */
        }
        .contenido {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Menú</h2>
    <div id="menu">
        <?php
        // Incluye el archivo de funciones y llama a la función para consultar el menú
        include 'PeticionSQL.php';
        echo consultarMenu();
        ?>
    </div>
    <div class="contenido" id="contenido">
        <!-- Aquí se cargará el contenido de la página -->
    </div>
    <script>
        // Manejador de eventos para los clics en los enlaces del menú
        document.querySelectorAll('#menu a').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el comportamiento predeterminado del enlace

                // Obtiene la URL de la página correspondiente al enlace
                var url = this.getAttribute('data-url');

                // Carga el contenido de la página en la sección de contenido
                cargarContenido(url);
            });
        });

        // Función para cargar el contenido de la página utilizando AJAX
        function cargarContenido(url) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("contenido").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();
        }
    </script>
</body>
</html>