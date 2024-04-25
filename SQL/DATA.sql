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
	IF NOT EXISTS(select * from menu WHERE codigo='Rol') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Rol','Rol',NULL,'Rol.php',1);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='Perfil') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Perfil','Perfil',NULL,'Perfil.php',2);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='Usuario') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('Usuario','Usuario',NULL,'Usuario.php',2);
	END IF;
	IF NOT EXISTS(select * from menu WHERE codigo='salir') THEN
		INSERT INTO menu(codigo,nombre,padre,ruta,orden)	
		VALUES('salir','salir',NULL,'inicio.php',1);
	END IF;
	
END	$$