<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../CSS/estilos.css" />
    <title>Menú y Contenido</title>
	<h2>Menú</h2>
    <div id="menu">
        <?php
        // Incluye el archivo de funciones y llama a la función para consultar el menú
        include 'PeticionSQL.php';
		ini_set('display_errors', 1);
		error_reporting(E_ALL);
        echo consultarMenu();
		$url="";
		if (isset($_GET['url'])) {
			$url = $_GET['url'];
		}else{
			$url="";
		}
        ?>
    </div>
</head>
<body>
    <section class="contenido wrapper" id="contenido">
		<div class="dcontenido" id="dcontenido">
			<!-- Aquí se cargará el contenido de la página -->
		</div>
	</section>	
    <script>
		document.addEventListener("DOMContentLoaded", () => {
			// Obtener la URL de la página a cargar desde la URL actual
			var urlAEnviar = obtenerParametroURL('url');
			// Llamar a cargarPagina con la URL obtenida
			if (urlAEnviar) {
				cargarContenido(urlAEnviar);
			}
			return true;
		});
		// Función para obtener parámetros de la URL
        function obtenerParametroURL(nombre) {
            const parametros = new URLSearchParams(window.location.search);
            return parametros.get(nombre);
        }
		         
		       
		// Manejador de eventos para los clics en los enlaces del menú
        document.querySelectorAll('#menu a').forEach(function(element) {
            element.addEventListener('click', function(event) {
                event.preventDefault(); // Evita el comportamiento predeterminado del enlace

                // Obtiene la URL de la página correspondiente al enlace
                var dataurl = this.getAttribute('data-url');
				var url = this.getAttribute('href');
				
                // Carga el contenido de la página en la sección de contenido
				if (dataurl!="#"){
					cargarContenido(dataurl);
				}else{
					window.location.href = url;
				}
				//return true;
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
			//return true;
        }

		function EliminarRol(id,url){
			if (confirm("¿Estás seguro de que deseas eliminar este rol?")) {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // Recargar la página después de eliminar el rol
							alert('El Rol eliminado correctamente.');
							window.location.href=url;
                            //window.history.back();
							//location.reload();
                        } else {
                            alert('Error al eliminar el rol.');
							//window.history.back();
							//location.reload();
                        }
                    }
                };
                xhr.open('GET', 'peticionSQL.php?EliminarRol=1&id=' + id + '&url=' + url, true);
                xhr.send();
				
            }
			//return true;
		}
		function getVariableGetByName() {
		   var variables = {};
		   var arreglos = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
			  variables[key] = value;
		   });
		   return variables;
		}
		var checkboxinactivo = document.getElementById('inactivo');
		checkboxinactivo.addEventListener('click', function() {
			if(this.checked) {
			  this.value=1;
			} else {
			  this.value=0;
			}
			//return true;
		});
    </script>
</body>
</html>