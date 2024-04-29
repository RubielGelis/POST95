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
		      
		       
		//// Manejador de eventos para los clics en los enlaces del menú
        //document.querySelectorAll('#menu a').forEach(function(element) {
        //    element.addEventListener('click', function(event) {
        //        event.preventDefault(); // Evita el comportamiento predeterminado del enlace
		//
        //        // Obtiene la URL de la página correspondiente al enlace
        //        var dataurl = this.getAttribute('data-url');
		//		var url = this.getAttribute('href');
		//		
        //        // Carga el contenido de la página en la sección de contenido
		//		if (dataurl!="#"){
		//			cargarContenido(dataurl);
		//			//cargarPagina(dataurl, 'dcontenido')
		//		}else{
		//			window.location.href = url;
		//		}
		//		//return true;
        //    });
        //});
		
        // Función para cargar el contenido de la página utilizando AJAX
        function cargarContenido(url) {
			//alert("entro");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("dcontenido").innerHTML = this.responseText;
				}
            };
            xhttp.open("GET", url , true);
            xhttp.send();
			//return true;
        }
		
		function cargarPagina(url, contenedor) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Insertar el contenido en el contenedor
                    document.getElementById(contenedor).innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
		function cargarPagina2(url, contenedor) {
            fetch(url)
                .then(response => response.text())
                .then(data => {
                    // Insertar el contenido en el contenedor
                    parent.document.getElementById(contenedor).innerHTML = data;
                })
                .catch(error => console.error('Error:', error));
        }
		function GuardarRol(id, url) {
			if (confirm("¿Estás seguro de que deseas guardar los datos del rol?")) {
				var codigo = document.getElementById('codigo').value;
				var nombre = document.getElementById('nombre').value;
				var inactivo = document.getElementById('inactivo').value;

				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (xhr.readyState === XMLHttpRequest.DONE) {
						if (xhr.status === 200) {
							alert('Se guardaron los datos del rol correctamente.');
							cargarContenido(url);
							//cargarPagina(url, "dcontenido"); // Cargar contenido después de guardar
						} else {
							alert('Error al guardar los datos del rol.');
						}
					}
				};
				xhr.open('GET', 'peticionSQL.php?GuardarRol=1&id=' + id + '&codigo=' + codigo + '&nombre=' + nombre + '&inactivo=' + inactivo + '&url=' + url, true);
				xhr.send();
			}
		}

		function EliminarRol(id, url) {
			if (confirm("¿Estás seguro de que deseas eliminar este rol?")) {
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (xhr.readyState === XMLHttpRequest.DONE) {
						if (xhr.status === 200) {
							alert('El Rol eliminado correctamente.');
							cargarContenido(url); // Cargar contenido después de eliminar
						} else {
							alert('Error al eliminar el rol.');
						}
					}
				};
				xhr.open('GET', 'peticionSQL.php?EliminarRol=1&id=' + id + '&url=' + url, true);
				xhr.send();
			}
		}
		function inactivoclick(){
			var cinactivo = document.getElementById('inactivo');
			if (cinactivo.checked) {
				cinactivo.value = 1;
			} else {
				cinactivo.value = 0;
			}
		}
    </script>
</body>
</html>