<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/estilos.css">
    <title>Menú y Contenido</title>
</head>
<body>
    <h2>Menú</h2>
    <div id="menu">
        <?php
        // Incluye el archivo de funciones y llama a la función para consultar el menú
        include 'PeticionSQL.php';
        echo consultarMenu();
		$url="";
		if (isset($_GET['url'])) {
			$url = $_GET['url'];
		}else{
			$url="";
		}
        ?>
    </div>
    <div class="contenido" id="contenido">
        <!-- Aquí se cargará el contenido de la página -->
    </div>
    <script>
		//if (window.performance.navigation.type == 1) {
		//	var url = window.location.href;
		//	//var parametrosGET = url.split('?')[1];
		//	alert(url);
		//}
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
            xhttp.open("GET", url , true);
            xhttp.send();
			return true;
        }

		function EliminarRol(id,url){
			if (confirm("¿Estás seguro de que deseas eliminar este rol?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Recargar la página después de eliminar el rol
                            //window.history.back();
							location.reload();
                        } else {
                            alert('Error al eliminar el rol.');
							//window.history.back();
							location.reload();
                        }
                    }
                };
                xhr.open('GET', 'peticionSQL.php?EliminarRol=1&id=' + id + '&url=' + url, true);
                xhr.send();
				
            }
			return true;
		}
		function getVariableGetByName() {
		   var variables = {};
		   var arreglos = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			  variables[key] = value;
		   });
		   return variables;
		}
    </script>
</body>
</html>