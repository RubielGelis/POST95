do $$
BEGIN

	IF NOT EXISTS(select * from Rol WHERE codigo='Administrador') THEN
		INSERT INTO Rol(codigo,nombre)	
		VALUES('Administrador','Administrador');
	END IF;
	IF NOT EXISTS(select * from Rol WHERE codigo='Cajero') THEN
		INSERT INTO Rol(codigo,nombre)	
		VALUES('Cajero','Cajero');
	END IF; 
	IF NOT EXISTS(select * from Perfil WHERE codigo='Administrador') THEN
		INSERT INTO Perfil(codigo,nombre,id_rol)	
		VALUES('Administrador','Administrador',1);
	END IF;
	IF NOT EXISTS(select * from Perfil WHERE codigo='Cajero') THEN
		INSERT INTO Perfil(codigo,nombre,id_rol)	
		VALUES('Cajero','Cajero',2);
	END IF;
	IF NOT EXISTS(select * from usuarios WHERE login='admin') THEN
		INSERT INTO usuarios(login,password,nombre,sexo,telefono,imagen,email,fechanacimiento,id_perfil)	
		VALUES('admin','admin','Administrador','Marculino',NULL,NULL,NULL,NULL,1);
	END IF;
	IF NOT EXISTS(select * from usuarios WHERE login='admin') THEN
		INSERT INTO usuarios(login,password,nombre,sexo,telefono,imagen,email,fechanacimiento,id_perfil)	
		VALUES('Cajero','Cajero','Cajero','Marculino',NULL,NULL,NULL,NULL,2);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='Roles') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Roles','Roles',NULL,'Roles.php',1);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='Perfiles') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Perfiles','Perfiles',NULL,'Perfiles.php',2);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='Usuarios') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Usuarios','Usuarios',NULL,'Usuarios.php',2);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='salir') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('salir','salir',NULL,'inicio.php',10);
	END IF;
	
END	$$