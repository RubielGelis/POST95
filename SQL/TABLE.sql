do $$
BEGIN
	CREATE TABLE IF NOT EXISTS Rol (
		id int GENERATED ALWAYS AS IDENTITY,
		codigo VARCHAR(50),		
		nombre VARCHAR(100),
		inactivo int NOT NULL DEFAULT 0
	);
	ALTER TABLE Rol DROP CONSTRAINT IF EXISTS PK_Rol;
	ALTER TABLE Rol ADD CONSTRAINT PK_Rol PRIMARY KEY (id);
	ALTER TABLE Rol DROP CONSTRAINT IF EXISTS UQ_Rol_codigo;
	ALTER TABLE Rol ADD CONSTRAINT UQ_Rol_codigo UNIQUE (codigo);
	
	CREATE TABLE IF NOT EXISTS Perfil (
		id int GENERATED ALWAYS AS IDENTITY,
		codigo VARCHAR(50),		
		nombre VARCHAR(100),
		id_rol INT,
		inactivo int NOT NULL DEFAULT 0	
	);
	ALTER TABLE Perfil DROP CONSTRAINT IF EXISTS PK_Perfil;
	ALTER TABLE Perfil ADD CONSTRAINT PK_Perfil PRIMARY KEY (id);
	ALTER TABLE Perfil DROP CONSTRAINT IF EXISTS UQ_Rol_codigo;
	ALTER TABLE Perfil ADD CONSTRAINT UQ_Perfil_codigo UNIQUE (codigo);
	ALTER TABLE Perfil DROP CONSTRAINT IF EXISTS FK_Rol;
	ALTER TABLE Perfil ADD CONSTRAINT FK_Rol FOREIGN KEY (id_rol) REFERENCES Rol (id);
	
	CREATE TABLE IF NOT EXISTS Usuarios(
		id int GENERATED ALWAYS AS IDENTITY,
		login varchar(50),
		password varchar(100),
		nombre varchar(250),
		sexo VARCHAR(50) NULL,
		telefono VARCHAR(50) NULL,
		imagen BYTEA NULL,
		email VARCHAR(100) NULL,
		fechanacimiento TIMESTAMP NULL,
		id_perfil INT,
		fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		inactivo int NOT NULL DEFAULT 0
	);
	ALTER TABLE Usuarios DROP CONSTRAINT IF EXISTS PK_Usuarios;
	ALTER TABLE Usuarios ADD CONSTRAINT PK_Usuarios PRIMARY KEY (id);
	ALTER TABLE Usuarios DROP CONSTRAINT IF EXISTS UQ_Usuarios_Login;
	ALTER TABLE Usuarios ADD CONSTRAINT UQ_Usuarios_Login UNIQUE (login);
	ALTER TABLE Usuarios DROP CONSTRAINT IF EXISTS FK_Perfil_id;
	ALTER TABLE Usuarios ADD CONSTRAINT FK_Perfil_id FOREIGN KEY (id_perfil) REFERENCES Perfil (id);
	
	CREATE TABLE IF NOT EXISTS Menu (
		id int GENERATED ALWAYS AS IDENTITY,
		codigo VARCHAR(50),	
		nombre VARCHAR(100),
		padre VARCHAR(50) NULL,
		ruta  VARCHAR(8000),
		orden int,
		inactivo int NOT NULL DEFAULT 0
	);
	ALTER TABLE Menu DROP CONSTRAINT IF EXISTS PK_menu;
	ALTER TABLE Menu ADD CONSTRAINT PK_menu PRIMARY KEY (id);
	ALTER TABLE Menu DROP CONSTRAINT IF EXISTS UQ_Menu_codigo;
	ALTER TABLE Menu ADD CONSTRAINT UQ_Menu_codigo UNIQUE (codigo);
	ALTER TABLE Menu DROP CONSTRAINT IF EXISTS FK_menu_padre;
	ALTER TABLE Menu ADD CONSTRAINT FK_menu_padre FOREIGN KEY (padre) REFERENCES Menu (codigo);

	CREATE TABLE IF NOT EXISTS RolMenu (
		id int GENERATED ALWAYS AS IDENTITY,
		id_rol INT,
		id_usuario INT,
		inactivo int NOT NULL DEFAULT 0
	);
	ALTER TABLE RolMenu DROP CONSTRAINT IF EXISTS PK_RolMenu;
	ALTER TABLE RolMenu ADD CONSTRAINT PK_RolMenu PRIMARY KEY (id);
	ALTER TABLE RolMenu DROP CONSTRAINT IF EXISTS FK_RolMenu_Rol;
	ALTER TABLE RolMenu ADD CONSTRAINT FK_RolMenu_Rol FOREIGN KEY (id_rol) REFERENCES Rol (id);
	ALTER TABLE RolMenu DROP CONSTRAINT IF EXISTS FK_RolMenu_Usuario;
	ALTER TABLE RolMenu ADD CONSTRAINT FK_RolMenu_Usuario FOREIGN KEY (id_usuario) REFERENCES Usuarios (id);
END	$$   