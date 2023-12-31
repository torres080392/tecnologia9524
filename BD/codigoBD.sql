USE [Inventario9524]
GO
/****** Object:  Table [dbo].[AREAS]    Script Date: 12/12/2023 21:55:25 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[AREAS](
	[id_area] [int] IDENTITY(1,1) NOT NULL,
	[tipo_area] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_area] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[CARGOS]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[CARGOS](
	[id_cargo] [int] IDENTITY(1,1) NOT NULL,
	[tipo_cargo] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_cargo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[EQUIPOS]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[EQUIPOS](
	[id_equipo] [int] IDENTITY(1,1) NOT NULL,
	[PERSONAS_id_persona] [int] NOT NULL,
	[ESTADO_EQUIPO_id_estado] [int] NOT NULL,
	[TIPO_EQUIPO_id_equipo] [int] NOT NULL,
	[nom_equipo] [varchar](45) NULL,
	[num_equipo] [varchar](20) NULL,
	[fecha_compra] [datetime] NULL,
	[fecha_inicio_garan] [datetime] NULL,
	[fecha_final_garan] [datetime] NULL,
	[imei1] [varchar](45) NULL,
	[imei2] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_equipo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ESTADO_EQUIPO]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ESTADO_EQUIPO](
	[id_estado] [int] IDENTITY(1,1) NOT NULL,
	[estado_equipo] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_estado] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ESTADO_PERSONA]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ESTADO_PERSONA](
	[id_estado] [int] IDENTITY(1,1) NOT NULL,
	[estado_persona] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_estado] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PERMISOS]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PERMISOS](
	[id_permisos] [int] IDENTITY(1,1) NOT NULL,
	[tipo_permiso] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_permisos] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[PERSONAS]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[PERSONAS](
	[id_persona] [int] IDENTITY(1,1) NOT NULL,
	[AREAS_id_area] [int] NOT NULL,
	[CARGOS_id_cargo] [int] NOT NULL,
	[ESTADO_PERSONA_id_estado] [int] NOT NULL,
	[ROLES_id_rol] [int] NOT NULL,
	[doc_persona] [varchar](45) NULL,
	[nom_persona] [varchar](45) NULL,
	[tel_persona] [varchar](45) NULL,
	[corr_persona] [varchar](255) NULL,
	[dir_persona] [varchar](255) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_persona] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ROLES]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ROLES](
	[id_rol] [int] IDENTITY(1,1) NOT NULL,
	[PERMISOS_id_permisos] [int] NOT NULL,
	[username] [varchar](45) NULL,
	[password_2] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_rol] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[TIPO_EQUIPO]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[TIPO_EQUIPO](
	[id_equipo] [int] IDENTITY(1,1) NOT NULL,
	[tipo_equipo] [varchar](45) NULL,
PRIMARY KEY CLUSTERED 
(
	[id_equipo] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
ALTER TABLE [dbo].[EQUIPOS]  WITH NOCHECK ADD FOREIGN KEY([ESTADO_EQUIPO_id_estado])
REFERENCES [dbo].[ESTADO_EQUIPO] ([id_estado])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[EQUIPOS]  WITH NOCHECK ADD FOREIGN KEY([PERSONAS_id_persona])
REFERENCES [dbo].[PERSONAS] ([id_persona])
GO
ALTER TABLE [dbo].[EQUIPOS]  WITH NOCHECK ADD FOREIGN KEY([TIPO_EQUIPO_id_equipo])
REFERENCES [dbo].[TIPO_EQUIPO] ([id_equipo])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[PERSONAS]  WITH NOCHECK ADD FOREIGN KEY([AREAS_id_area])
REFERENCES [dbo].[AREAS] ([id_area])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[PERSONAS]  WITH NOCHECK ADD FOREIGN KEY([CARGOS_id_cargo])
REFERENCES [dbo].[CARGOS] ([id_cargo])
GO
ALTER TABLE [dbo].[PERSONAS]  WITH NOCHECK ADD FOREIGN KEY([ESTADO_PERSONA_id_estado])
REFERENCES [dbo].[ESTADO_PERSONA] ([id_estado])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[PERSONAS]  WITH NOCHECK ADD FOREIGN KEY([ROLES_id_rol])
REFERENCES [dbo].[ROLES] ([id_rol])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [dbo].[ROLES]  WITH CHECK ADD FOREIGN KEY([PERMISOS_id_permisos])
REFERENCES [dbo].[PERMISOS] ([id_permisos])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
/****** Object:  StoredProcedure [dbo].[ActualizarPersona]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create
PROCEDURE [dbo].[ActualizarPersona]
    @idUsuario INT,
    @doc NVARCHAR(45),
	@nom varchar(45),
	@tel varchar(45),
	@corr varchar (45),
	@dir varchar(45)
	
AS
BEGIN
    -- Realizar la actualización
    UPDATE PERSONAS
    SET doc_persona = @doc , nom_persona = @nom,tel_persona =@tel ,corr_persona=@corr,dir_persona=@dir
    WHERE id_persona = @idUsuario;
END;
GO
/****** Object:  StoredProcedure [dbo].[ActualizarUsuario]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


CREATE PROCEDURE [dbo].[ActualizarUsuario]
    @idUsuario INT,
    @nombreUsuario NVARCHAR(255),
	@passwordUsuario varchar(45)

	
AS
BEGIN
    -- Realizar la actualización
    UPDATE ROLES
    SET username = @nombreUsuario , password_2 = @passwordUsuario 
    WHERE id_rol = @idUsuario;
END;
GO
/****** Object:  StoredProcedure [dbo].[crearEquipos]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[crearEquipos]
    @tipo_usuario INT,
    @estado_equipo INT,
    @tipo_equipo INT,
    @nombreEquipo NVARCHAR(255),
    @numeroEquipo NVARCHAR(50),
    @fechaCompra DATETIME,
    @fechaInicio DATETIME,
    @fechaFinal DATETIME,
    @imei1 NVARCHAR(50),
    @imei2 NVARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;

    -- Verificar y asignar valores predeterminados si las fechas son nulas
    SET @fechaCompra = ISNULL(@fechaCompra, '00000000'); -- 1900-01-01 como valor predeterminado
    SET @fechaInicio = ISNULL(@fechaInicio, '00000000');
    SET @fechaFinal = ISNULL(@fechaFinal, '00000000');

    -- Insertar lógica de validación si es necesario

    -- Insertar datos en la tabla Equipos
    INSERT INTO EQUIPOS(PERSONAS_id_persona, ESTADO_EQUIPO_id_estado, TIPO_EQUIPO_id_equipo, nom_equipo, num_equipo, fecha_compra, fecha_inicio_garan, fecha_final_garan, imei1, imei2)
    VALUES (@tipo_usuario, @estado_equipo, @tipo_equipo, @nombreEquipo, @numeroEquipo, @fechaCompra, @fechaInicio, @fechaFinal, @imei1, @imei2);

    -- Puedes agregar más lógica según sea necesario

    -- Fin del procedimiento almacenado
	 SELECT 'Éxito: Datos insertados correctamente' AS Resultado;
END;

GO
/****** Object:  StoredProcedure [dbo].[crearPersonas]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Crear el procedimiento almacenado
CREATE PROCEDURE [dbo].[crearPersonas]
    @tipo_area INT,
	@tipo_cargo INT,
	@tipo_estado INT,
	@tipo_rol INT,
	@documento NVARCHAR(20),
    @nombre NVARCHAR(255),
    @telefono NVARCHAR(20),
    @correo NVARCHAR(255),
    @direccion NVARCHAR(255)
    
AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO PERSONAS(AREAS_id_area, CARGOS_id_cargo, ESTADO_PERSONA_id_estado,ROLES_id_rol, doc_persona, nom_persona,tel_persona, corr_persona,dir_persona)
    VALUES (@tipo_area, @tipo_cargo, @tipo_estado, @tipo_rol, @documento, @nombre,@telefono,@correo,@direccion);
END;
GO
/****** Object:  StoredProcedure [dbo].[crearTipoArea]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create PROCEDURE [dbo].[crearTipoArea]
    @nombreArea VARCHAR(45)
AS
BEGIN
    INSERT INTO AREAS(tipo_area)
    VALUES (@nombreArea);
END;
GO
/****** Object:  StoredProcedure [dbo].[crearTipoEquipo]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
Create PROCEDURE [dbo].[crearTipoEquipo]
    @nombreEquipo NVARCHAR(255)
AS
BEGIN
    INSERT INTO tipo_equipo(tipo_equipo)
    VALUES (@nombreEquipo);
END;

GO
/****** Object:  StoredProcedure [dbo].[crearTipoPersona]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[crearTipoPersona]
    @nombreCargo VARCHAR(45)
AS
BEGIN
    INSERT INTO CARGOS(tipo_cargo)
    VALUES (@nombreCargo);
END;
GO
/****** Object:  StoredProcedure [dbo].[crearUsuarios]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

-- Crear el procedimiento almacenado
create PROCEDURE [dbo].[crearUsuarios]
    @tipo_usuario INT,
    @username NVARCHAR(255),
    @password VARCHAR(20)

AS
BEGIN
    SET NOCOUNT ON;

    INSERT INTO roles (permisos_id_permisos,username,password_2)
    VALUES (@tipo_usuario,@username,@password);
END;
GO
/****** Object:  StoredProcedure [dbo].[EliminarEquipo]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[EliminarEquipo]
    @IdUsuario INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Desactivar la restricción de clave externa temporalmente
    EXEC sp_MSforeachtable 'ALTER TABLE ? NOCHECK CONSTRAINT ALL';

    -- Eliminar el usuario
    DELETE FROM EQUIPOS
    WHERE id_equipo = @IdUsuario;

    -- Activar la restricción de clave externa nuevamente
    EXEC sp_MSforeachtable 'ALTER TABLE ? WITH CHECK CHECK CONSTRAINT ALL';
END;
GO
/****** Object:  StoredProcedure [dbo].[EliminarPersona]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[EliminarPersona]
    @IdUsuario INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Desactivar la restricción de clave externa temporalmente
    EXEC sp_MSforeachtable 'ALTER TABLE ? NOCHECK CONSTRAINT ALL';

    -- Eliminar el usuario
    DELETE FROM PERSONAS
    WHERE id_persona = @IdUsuario;

    -- Activar la restricción de clave externa nuevamente
    EXEC sp_MSforeachtable 'ALTER TABLE ? WITH CHECK CHECK CONSTRAINT ALL';
END;
GO
/****** Object:  StoredProcedure [dbo].[EliminarUsuario]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[EliminarUsuario]
    @IdUsuario INT
AS
BEGIN
    SET NOCOUNT ON;

    -- Desactivar la restricción de clave externa temporalmente
    EXEC sp_MSforeachtable 'ALTER TABLE ? NOCHECK CONSTRAINT ALL';

    -- Eliminar el usuario
    DELETE FROM ROLES
    WHERE id_rol = @IdUsuario;

    -- Activar la restricción de clave externa nuevamente
    EXEC sp_MSforeachtable 'ALTER TABLE ? WITH CHECK CHECK CONSTRAINT ALL';
END;
GO
/****** Object:  StoredProcedure [dbo].[IniciarSesion]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create PROCEDURE [dbo].[IniciarSesion]
 
    @p_userRole int OUTPUT,
    @p_username NVARCHAR(255),
    @p_password NVARCHAR(255)
	

AS
BEGIN
    DECLARE @userCount INT;

    -- Verifica si el usuario existe y coincide con la contraseña
    SELECT @userCount = COUNT(*) FROM ROLES
    WHERE username = @p_username AND password_2 = @p_password;

    IF @userCount = 1
    BEGIN
        -- Obtiene el rol del usuario
        SELECT @p_userRole = permisos_id_permisos FROM ROLES WHERE username = @p_username;
    END
    ELSE
    BEGIN
        SET @p_userRole = 'No válido';
    END
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerActa]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[ObtenerActa]
    @numeroBuscar VARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT
        EQUIPOS.id_equipo,
        EQUIPOS.PERSONAS_id_persona,
        EQUIPOS.ESTADO_EQUIPO_id_estado,
        EQUIPOS.TIPO_EQUIPO_id_equipo,
		EQUIPOS.nom_equipo,
		EQUIPOS.num_equipo,
		EQUIPOS.fecha_compra,
		EQUIPOS.fecha_inicio_garan,
		EQUIPOS.fecha_final_garan,
		EQUIPOS.imei1,
		EQUIPOS.imei2,
		PERSONAS.nom_persona,
		CARGOS.tipo_cargo,
		ESTADO_EQUIPO.estado_equipo,
		TIPO_EQUIPO.tipo_equipo,
		AREAS.tipo_area
  
    FROM
        EQUIPOS
		 INNER JOIN
        PERSONAS ON EQUIPOS.PERSONAS_id_persona = PERSONAS.id_persona
		 INNER JOIN
        ESTADO_EQUIPO ON EQUIPOS.ESTADO_EQUIPO_id_estado= ESTADO_EQUIPO.id_estado
		INNER JOIN
        TIPO_EQUIPO ON EQUIPOS.TIPO_EQUIPO_id_equipo = TIPO_EQUIPO.id_equipo
		INNER JOIN
        CARGOS ON PERSONAS.CARGOS_id_cargo = CARGOS.id_cargo
		INNER JOIN
        AREAS ON PERSONAS.AREAS_id_area = AREAS.id_area
 
 
    WHERE
        EQUIPOS.id_equipo LIKE '%' + @numeroBuscar + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerDatosEquipos]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[ObtenerDatosEquipos]
    @documentoBuscar VARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT
        EQUIPOS.id_equipo,
        EQUIPOS.PERSONAS_id_persona,
        EQUIPOS.ESTADO_EQUIPO_id_estado,
        EQUIPOS.TIPO_EQUIPO_id_equipo,
		EQUIPOS.nom_equipo,
		EQUIPOS.num_equipo,
		EQUIPOS.fecha_compra,
		EQUIPOS.fecha_inicio_garan,
		EQUIPOS.fecha_final_garan,
		EQUIPOS.imei1,
		EQUIPOS.imei2,
		PERSONAS.nom_persona,
		CARGOS.tipo_cargo,
		ESTADO_EQUIPO.estado_equipo,
		TIPO_EQUIPO.tipo_equipo
  
    FROM
        EQUIPOS
		 INNER JOIN
        PERSONAS ON EQUIPOS.PERSONAS_id_persona = PERSONAS.id_persona
		 INNER JOIN
        ESTADO_EQUIPO ON EQUIPOS.ESTADO_EQUIPO_id_estado= ESTADO_EQUIPO.id_estado
		INNER JOIN
        TIPO_EQUIPO ON EQUIPOS.TIPO_EQUIPO_id_equipo = TIPO_EQUIPO.id_equipo
		INNER JOIN
        CARGOS ON PERSONAS.CARGOS_id_cargo = CARGOS.id_cargo
 
    WHERE
        PERSONAS.nom_persona LIKE '%' + @documentoBuscar + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerDatosPersonas]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[ObtenerDatosPersonas]
    @documentoBuscar VARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT
        PERSONAS.id_persona,
        PERSONAS.AREAS_id_area,
        PERSONAS.CARGOS_id_cargo,
        PERSONAS.ESTADO_PERSONA_id_estado,
		PERSONAS.doc_persona,
		PERSONAS.nom_persona,
		PERSONAS.tel_persona,
		PERSONAS.corr_persona,
		PERSONAS.dir_persona,
		CARGOS.tipo_cargo,
		ESTADO_PERSONA.estado_persona,
		AREAS.tipo_area
  
    FROM
        PERSONAS
		 INNER JOIN
        ESTADO_PERSONA ON PERSONAS.ESTADO_PERSONA_id_estado = ESTADO_PERSONA.id_estado
		 INNER JOIN
        CARGOS ON PERSONAS.CARGOS_id_cargo = CARGOS.id_cargo
		 INNER JOIN
        AREAS ON PERSONAS.AREAS_id_area = AREAS.id_area
 
    WHERE
        PERSONAS.nom_persona LIKE '%' + @documentoBuscar + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerDatosRoles]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE PROCEDURE [dbo].[ObtenerDatosRoles]
    @documentoBuscar VARCHAR(255)
AS
BEGIN
    SET NOCOUNT ON;

    SELECT
        ROLES.id_rol,
        ROLES.permisos_id_permisos,
        ROLES.username,
        ROLES.password_2,
        PERMISOS.tipo_permiso
    FROM
        ROLES
    INNER JOIN
        PERMISOS ON ROLES.permisos_id_permisos = PERMISOS.id_permisos
    WHERE
        ROLES.username LIKE '%' + @documentoBuscar + '%';
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerEstadoEquipo]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create PROCEDURE [dbo].[ObtenerEstadoEquipo]
AS
BEGIN
    SELECT id_estado, estado_equipo FROM ESTADO_EQUIPO;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerRoles]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[ObtenerRoles]
    @id_rol INT,
    @permisos_id_permisos INT,
    @username VARCHAR(45),
    @password VARCHAR(45)

AS
BEGIN
    SELECT
        id_rol,
        permisos_id_permisos,
        username,
        password_2
    FROM
        ROLES
    
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoArea]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[ObtenerTipoArea]
AS
BEGIN
    SELECT id_area, tipo_area
    FROM AREAS;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoCargo]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[ObtenerTipoCargo]
AS
BEGIN
    SELECT id_cargo, tipo_cargo
    FROM CARGOS;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoEquipo]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
create PROCEDURE [dbo].[ObtenerTipoEquipo]
AS
BEGIN
    SELECT id_equipo, tipo_equipo FROM TIPO_EQUIPO;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoEstado]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[ObtenerTipoEstado]
AS
BEGIN
    SELECT id_estado, estado_persona
    FROM ESTADO_PERSONA;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoRol]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

create PROCEDURE [dbo].[ObtenerTipoRol]
AS
BEGIN
    SELECT id_permisos, tipo_permiso
    FROM PERMISOS;
END;
GO
/****** Object:  StoredProcedure [dbo].[ObtenerTipoUsuario]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[ObtenerTipoUsuario]
AS
BEGIN
    SELECT id_persona, nom_persona
    FROM PERSONAS;
END;
GO
/****** Object:  StoredProcedure [dbo].[SelecionarTipoPersona]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREATE PROCEDURE [dbo].[SelecionarTipoPersona]
AS
BEGIN
    SELECT id_persona, corr_persona FROM PERSONAS;
END;
GO
/****** Object:  StoredProcedure [dbo].[SelecionarTipoUsuario]    Script Date: 12/12/2023 21:55:26 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO

CREate PROCEDURE [dbo].[SelecionarTipoUsuario]
AS
BEGIN
    SELECT id_permisos, tipo_permiso FROM PERMISOS;
END;
GO
