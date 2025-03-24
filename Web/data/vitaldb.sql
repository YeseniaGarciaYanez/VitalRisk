CREATE DATABASE vitaldb;

USE vitaldb;

CREATE TABLE TAREAS (
    id_tarea INT AUTO_INCREMENT PRIMARY KEY,
    frecuencia_dias INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    UNIQUE (nombre)  -- Evita duplicados en el catálogo
);

-- Tabla USUARIO (administrador, tecnico, cliente)
CREATE TABLE USUARIO (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    usuario VARCHAR(100) NOT NULL,
    rol VARCHAR(50) NOT NULL,
    CONSTRAINT chk_rol CHECK (rol IN ('admin', 'tecnico', 'cliente'))
);

-- Tabla administrador (extiende a USUARIO)
CREATE TABLE ADMINISTRADOR (
    idAdmin INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Tabla Técnico (extiende a USUARIO)
CREATE TABLE TECNICO (
    idTecnico INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    especialidad VARCHAR(255),
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Tabla Cliente (extiende a USUARIO)
CREATE TABLE CLIENTE (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    clues VARCHAR(20) NOT NULL UNIQUE,  -- CLUES única en el sector salud
    idUsuario INT NOT NULL,
    nombreInstitucion VARCHAR(255) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario)
        ON DELETE CASCADE
        ON UPDATE CASCADE
);

-- Tabla Equipos Médicos
CREATE TABLE EQUIPOS (
    idEquipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    modelo VARCHAR(100),
    ubicacion VARCHAR(255),
    descripcion TEXT,
    clues VARCHAR(20) NOT NULL,  -- CLUES del establecimiento (se relaciona con CLIENTE)
    estado VARCHAR(50),
    fechaAdquisicion DATETIME,
    INDEX idx_clues (clues)
);

-- Tabla de asignación de Tareas a Técnicos
CREATE TABLE TAREA_TECNICO (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_tarea INT NOT NULL,
    idTecnico INT NOT NULL,
    fecha_asignacion DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado VARCHAR(50) DEFAULT 'pendiente', -- Ej.: pendiente, en_proceso, completada
    FOREIGN KEY (id_tarea) REFERENCES TAREAS(id_tarea)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (idTecnico) REFERENCES TECNICO(idTecnico)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    UNIQUE (id_tarea, idTecnico),
    CONSTRAINT chk_estado_asig CHECK (estado IN ('pendiente', 'en_proceso', 'completada'))
);

-- Tabla Programación (para agendar mantenimientos)
CREATE TABLE PROGRAMACION (
    id_programacion INT AUTO_INCREMENT PRIMARY KEY,
    id_tecnico INT NOT NULL,
    id_tarea INT NOT NULL,    -- Se relaciona con el catálogo de tareas
    id_equipo INT NOT NULL,
    notas TEXT,
    prioridad VARCHAR(50),
    estado VARCHAR(50) DEFAULT 'pendiente',
    fecha_programacion DATETIME NOT NULL,
    FOREIGN KEY (id_tecnico) REFERENCES TECNICO(idTecnico)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_tarea) REFERENCES TAREAS(id_tarea)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES EQUIPOS(idEquipo)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_fecha_programacion (fecha_programacion),
    CONSTRAINT chk_estado_prog CHECK (estado IN ('pendiente', 'en_proceso', 'realizado'))
);

-- Tabla Registro de Mantenimiento
CREATE TABLE registroMantenimiento (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_Programacion INT NOT NULL,  -- Referencia a la programación de mantenimiento
    piezas_Reemplazadas TEXT,      -- Se puede normalizar para detalle por pieza
    fecha_Realizacion DATETIME NOT NULL,
    tiempo_empleado INT,           -- En minutos, por ejemplo
    observaciones TEXT,
    FOREIGN KEY (id_Programacion) REFERENCES PROGRAMACION(id_programacion)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_fechaRealizacion (fecha_Realizacion)
);

-- Tabla Certificado de Equipos
CREATE TABLE CERTIFICADO (
    idCertificado INT AUTO_INCREMENT PRIMARY KEY,
    fecha_emision DATE NOT NULL,
    fecha_expiracion DATE NOT NULL,
    tipo_certificado VARCHAR(100),
    descripcion TEXT,
    idEquipo INT NOT NULL,
    clues VARCHAR(20) NOT NULL,
    FOREIGN KEY (idEquipo) REFERENCES EQUIPOS(idEquipo)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_fecha_expiracion (fecha_expiracion),
    CONSTRAINT chk_certificado CHECK (fecha_expiracion > fecha_emision)
);

-- Tabla Reporte de Mantenimiento
CREATE TABLE REPORTE (
    idReporte INT AUTO_INCREMENT PRIMARY KEY,
    fecha_generacion DATE NOT NULL,
    descripcion TEXT,
    conclusiones TEXT,
    recomendaciones TEXT,
    idEquipo INT NOT NULL,
    idTecnico INT NOT NULL,
    FOREIGN KEY (idEquipo) REFERENCES EQUIPOS(idEquipo)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    FOREIGN KEY (idTecnico) REFERENCES TECNICO(idTecnico)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_fecha_generacion (fecha_generacion)
);

CREATE TABLE ARCHIVOS (
    idArchivo INT AUTO_INCREMENT PRIMARY KEY,
    idTecnico INT NOT NULL,
    fecha_generacion DATETIME NOT NULL,
    tipo VARCHAR(50),
    ruta TEXT,
    fecha DATETIME,
    FOREIGN KEY (idTecnico) REFERENCES TECNICO(idTecnico)
        ON DELETE CASCADE
        ON UPDATE CASCADE,
    INDEX idx_fecha (fecha)
);

CREATE TABLE PIEZAS (
    id_piezas INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    UNIQUE (nombre)
);

--validacion de los certificados donde la fecha de expiracion debe ser mayor a la de emision--

DELIMITER //

CREATE TRIGGER trg_certificado_validacion
BEFORE INSERT ON CERTIFICADO
FOR EACH ROW
BEGIN
    IF NEW.fecha_expiracion <= NEW.fecha_emision THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La fecha de expiración debe ser mayor a la fecha de emisión.';
    END IF;
END;
//

DELIMITER ;

--procedimiento para agendar los mantenimientos 
DELIMITER //

CREATE PROCEDURE sp_agendar_mantenimiento (
    IN p_id_tecnico INT,
    IN p_id_tarea INT,
    IN p_id_equipo INT,
    IN p_fecha_programacion DATETIME,
    IN p_notas TEXT,
    IN p_prioridad VARCHAR(50)
)
BEGIN
    IF EXISTS (
        SELECT 1 FROM PROGRAMACION 
        WHERE id_equipo = p_id_equipo 
          AND DATE(fecha_programacion) = DATE(p_fecha_programacion)
    ) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El equipo ya tiene un mantenimiento agendado para esa fecha.';
    ELSE
        INSERT INTO PROGRAMACION (id_tecnico, id_tarea, id_equipo, fecha_programacion, notas, prioridad)
        VALUES (p_id_tecnico, p_id_tarea, p_id_equipo, p_fecha_programacion, p_notas, p_prioridad);
    END IF;
END;
//

DELIMITER ;

--funcion para obtener la proxima fecha de mantenimiento para un equipo dado
DELIMITER //
CREATE FUNCTION fn_proxima_fecha(p_fecha DATETIME, p_frecuencia INT)
RETURNS DATETIME DETERMINISTIC
BEGIN
    RETURN DATE_ADD(p_fecha, INTERVAL p_frecuencia DAY);
END//
DELIMITER ;

-- actualizacion de fecha del proximo mantenimiento 
DELIMITER //
CREATE TRIGGER trg_actualizar_proximo_mant
AFTER UPDATE ON registroMantenimiento
FOR EACH ROW
BEGIN
    DECLARE v_frecuencia INT;
    DECLARE v_nueva_fecha DATETIME;
    
    SELECT t.frecuencia_dias INTO v_frecuencia
    FROM TAREAS t
    JOIN PROGRAMACION p ON p.id_tarea = t.id_tarea
    WHERE p.id_programacion = NEW.id_Programacion;
    
    SET v_nueva_fecha = fn_proxima_fecha(NEW.fecha_Realizacion, v_frecuencia);
    
    UPDATE PROGRAMACION
    SET fecha_programacion = v_nueva_fecha
    WHERE id_programacion = NEW.id_Programacion;
END//
DELIMITER ;


