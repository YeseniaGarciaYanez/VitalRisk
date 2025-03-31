CREATE DATABASE vitaldb;

USE vitaldb;

CREATE TABLE TAREAS (
    id_tarea INT AUTO_INCREMENT PRIMARY KEY,
    frecuencia_dias INT NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    UNIQUE (nombre)  
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

--insercion administradores
-- Inserción de 15 administradores
CALL sp_insertar_usuario_custom('carlos.garcia', 'carlos.garcia@vitalrisk.com', 'Carlos García', 'admin', '');
CALL sp_insertar_usuario_custom('ana.martinez', 'ana.martinez@vitalrisk.com', 'Ana Martínez', 'admin', '');
CALL sp_insertar_usuario_custom('luis.rodriguez', 'luis.rodriguez@vitalrisk.com', 'Luis Rodríguez', 'admin', '');
CALL sp_insertar_usuario_custom('sofia.lopez', 'sofia.lopez@vitalrisk.com', 'Sofía López', 'admin', '');
CALL sp_insertar_usuario_custom('jorge.morales', 'jorge.morales@vitalrisk.com', 'Jorge Morales', 'admin', '');
CALL sp_insertar_usuario_custom('mariana.sanchez', 'mariana.sanchez@vitalrisk.com', 'Mariana Sánchez', 'admin', '');
CALL sp_insertar_usuario_custom('daniel.ramirez', 'daniel.ramirez@vitalrisk.com', 'Daniel Ramírez', 'admin', '');
CALL sp_insertar_usuario_custom('isabel.gomez', 'isabel.gomez@vitalrisk.com', 'Isabel Gómez', 'admin', '');
CALL sp_insertar_usuario_custom('eduardo.fernandez', 'eduardo.fernandez@vitalrisk.com', 'Eduardo Fernández', 'admin', '');
CALL sp_insertar_usuario_custom('paula.vega', 'paula.vega@vitalrisk.com', 'Paula Vega', 'admin', '');
CALL sp_insertar_usuario_custom('miguel.rios', 'miguel.rios@vitalrisk.com', 'Miguel Ríos', 'admin', '');
CALL sp_insertar_usuario_custom('veronica.diaz', 'veronica.diaz@vitalrisk.com', 'Verónica Díaz', 'admin', '');
CALL sp_insertar_usuario_custom('sebastian.perez', 'sebastian.perez@vitalrisk.com', 'Sebastián Pérez', 'admin', '');
CALL sp_insertar_usuario_custom('laura.mendez', 'laura.mendez@vitalrisk.com', 'Laura Méndez', 'admin', '');

-- Inserción de 30 técnicos
CALL sp_insertar_usuario_custom('andres.torres', 'andres.torres@vitalrisk.com', 'Andrés Torres', 'tecnico', 'Mantenimiento de equipos de imagenología');
CALL sp_insertar_usuario_custom('beatriz.molina', 'beatriz.molina@vitalrisk.com', 'Beatriz Molina', 'tecnico', 'Mantenimiento de equipos cardiovasculares');
CALL sp_insertar_usuario_custom('jorge.fuentes', 'jorge.fuentes@vitalrisk.com', 'Jorge Fuentes', 'tecnico', 'Mantenimiento de equipos de diagnóstico');
CALL sp_insertar_usuario_custom('carla.nunez', 'carla.nunez@vitalrisk.com', 'Carla Núñez', 'tecnico', 'Mantenimiento de equipos terapéuticos');
CALL sp_insertar_usuario_custom('oscar.castillo', 'oscar.castillo@vitalrisk.com', 'Óscar Castillo', 'tecnico', 'Mantenimiento de equipos de laboratorio');
CALL sp_insertar_usuario_custom('marta.rivera', 'marta.rivera@vitalrisk.com', 'Marta Rivera', 'tecnico', 'Mantenimiento de equipos de radiología');
CALL sp_insertar_usuario_custom('diego.silva', 'diego.silva@vitalrisk.com', 'Diego Silva', 'tecnico', 'Mantenimiento de equipos de ultrasonido');
CALL sp_insertar_usuario_custom('elena.cabrera', 'elena.cabrera@vitalrisk.com', 'Elena Cabrera', 'tecnico', 'Mantenimiento de equipos de tomografía');
CALL sp_insertar_usuario_custom('pablo.soto', 'pablo.soto@vitalrisk.com', 'Pablo Soto', 'tecnico', 'Mantenimiento de equipos de resonancia magnética');
CALL sp_insertar_usuario_custom('soledad.reyes', 'soledad.reyes@vitalrisk.com', 'Soledad Reyes', 'tecnico', 'Mantenimiento de equipos de hemodiálisis');
CALL sp_insertar_usuario_custom('ricardo.flores', 'ricardo.flores@vitalrisk.com', 'Ricardo Flores', 'tecnico', 'Mantenimiento de equipos quirúrgicos');
CALL sp_insertar_usuario_custom('vanesa.martin', 'vanesa.martin@vitalrisk.com', 'Vanesa Martín', 'tecnico', 'Mantenimiento de equipos portátiles');
CALL sp_insertar_usuario_custom('gustavo.ortiz', 'gustavo.ortiz@vitalrisk.com', 'Gustavo Ortiz', 'tecnico', 'Mantenimiento de sistemas de monitoreo');
CALL sp_insertar_usuario_custom('alma.vidal', 'alma.vidal@vitalrisk.com', 'Alma Vidal', 'tecnico', 'Mantenimiento de equipos de soporte vital');
CALL sp_insertar_usuario_custom('felipe.castro', 'felipe.castro@vitalrisk.com', 'Felipe Castro', 'tecnico', 'Mantenimiento de equipos de imagen digital');
CALL sp_insertar_usuario_custom('rosa.delgado', 'rosa.delgado@vitalrisk.com', 'Rosa Delgado', 'tecnico', 'Mantenimiento de sistemas de análisis clínico');
CALL sp_insertar_usuario_custom('martin.luna', 'martin.luna@vitalrisk.com', 'Martín Luna', 'tecnico', 'Mantenimiento de equipos de diagnóstico por imagen');
CALL sp_insertar_usuario_custom('silvia.moreno', 'silvia.moreno@vitalrisk.com', 'Silvia Moreno', 'tecnico', 'Mantenimiento de equipos de emergencia médica');
CALL sp_insertar_usuario_custom('cesar.ramos', 'cesar.ramos@vitalrisk.com', 'César Ramos', 'tecnico', 'Mantenimiento de equipos de terapia intensiva');
CALL sp_insertar_usuario_custom('natalia.leon', 'natalia.leon@vitalrisk.com', 'Natalia León', 'tecnico', 'Mantenimiento de equipos de monitoreo de pacientes');
CALL sp_insertar_usuario_custom('victor.espinoza', 'victor.espinoza@vitalrisk.com', 'Víctor Espinoza', 'tecnico', 'Mantenimiento de equipos de laboratorio clínico');
CALL sp_insertar_usuario_custom('lidia.bernal', 'lidia.bernal@vitalrisk.com', 'Lidia Bernal', 'tecnico', 'Mantenimiento de equipos de electrodiagnóstico');
CALL sp_insertar_usuario_custom('jorge.delvalle', 'jorge.delvalle@vitalrisk.com', 'Jorge del Valle', 'tecnico', 'Mantenimiento de sistemas de control de calidad');
CALL sp_insertar_usuario_custom('monica.salinas', 'monica.salinas@vitalrisk.com', 'Mónica Salinas', 'tecnico', 'Mantenimiento de equipos médicos críticos');
CALL sp_insertar_usuario_custom('oscar.maldonado', 'oscar.maldonado@vitalrisk.com', 'Óscar Maldonado', 'tecnico', 'Mantenimiento de equipos hospitalarios');
CALL sp_insertar_usuario_custom('andrea.paredes', 'andrea.paredes@vitalrisk.com', 'Andrea Paredes', 'tecnico', 'Mantenimiento de sistemas de soporte vital');
CALL sp_insertar_usuario_custom('eduardo.montero', 'eduardo.montero@vitalrisk.com', 'Eduardo Montero', 'tecnico', 'Mantenimiento de equipos de emergencia');
CALL sp_insertar_usuario_custom('claudia.guerrero', 'claudia.guerrero@vitalrisk.com', 'Claudia Guerrero', 'tecnico', 'Mantenimiento de sistemas de control y seguridad');
CALL sp_insertar_usuario_custom('mario.guzman', 'mario.guzman@vitalrisk.com', 'Mario Guzmán', 'tecnico', 'Mantenimiento de equipos de intervención médica');
CALL sp_insertar_usuario_custom('paula.santana', 'paula.santana@vitalrisk.com', 'Paula Santana', 'tecnico', 'Mantenimiento de equipos de monitoreo avanzado');



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

--cliente
INSERT INTO USUARIO (username, email, usuario, rol) 
VALUES 
('maria.lopez', 'maria.lopez@vitalrisk.com', 'Maria López', 'cliente'),
('jose.martinez', 'jose.martinez@vitalrisk.com', 'José Martínez', 'cliente');

SELECT idUsuario, username FROM USUARIO WHERE username IN ('maria.lopez', 'jose.martinez');

INSERT INTO CLIENTE (clues, idUsuario, nombreInstitucion) 
VALUES 
('ASIMS000091', 213, 'Hospital General de Monterrey'),
('ASIMS000144', 214, 'Hospital Regional de Guadalajara');

SELECT * FROM CLIENTE WHERE clues IN ('ASIMS000091', 'ASIMS000144');



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
---Datos Tareas Tecnicos
INSERT INTO TAREA_TECNICO (id_tarea, idTecnico, fecha_asignacion, estado) VALUES
(1, 1, '2025-01-15 10:00:00', 'pendiente'),
(2, 2, '2025-02-10 11:30:00', 'en_proceso'),
(3, 3, '2025-02-25 13:45:00', 'completada'),
(4, 4, '2025-03-01 09:15:00', 'pendiente'),
(5, 5, '2025-03-05 16:00:00', 'pendiente'),
(6, 6, '2025-03-10 17:30:00', 'en_proceso'),
(7, 7, '2025-03-12 14:30:00', 'completada'),
(8, 8, '2025-03-15 15:00:00', 'pendiente'),
(9, 9, '2025-03-18 18:00:00', 'en_proceso'),
(10, 10, '2025-03-22 08:30:00', 'completada'),
(11, 11, '2025-03-25 19:00:00', 'pendiente'),
(12, 12, '2025-04-02 09:00:00', 'completada'),
(13, 13, '2025-04-05 13:30:00', 'en_proceso'),
(14, 14, '2025-04-07 12:00:00', 'pendiente'),
(15, 15, '2025-04-09 11:30:00', 'completada'),
(16, 16, '2025-04-11 14:00:00', 'en_proceso'),
(17, 17, '2025-04-13 10:30:00', 'pendiente'),
(18, 18, '2025-04-15 15:15:00', 'completada'),
(19, 19, '2025-04-17 13:30:00', 'en_proceso'),
(20, 20, '2025-04-19 09:45:00', 'pendiente'),
(21, 21, '2025-04-21 16:30:00', 'en_proceso'),
(22, 22, '2025-04-23 11:00:00', 'completada'),
(23, 23, '2025-04-25 08:30:00', 'pendiente'),
(24, 24, '2025-04-27 12:15:00', 'en_proceso'),
(25, 25, '2025-04-29 18:45:00', 'completada'),
(26, 26, '2025-05-01 14:00:00', 'pendiente'),
(27, 27, '2025-05-03 13:30:00', 'en_proceso'),
(28, 28, '2025-05-05 12:00:00', 'completada'),
(29, 29, '2025-05-07 15:00:00', 'pendiente'),
(30, 30, '2025-05-09 10:30:00', 'en_proceso'),
(31, 31, '2025-05-11 17:15:00', 'completada'),
(32, 32, '2025-05-13 14:30:00', 'pendiente'),
(33, 33, '2025-05-15 09:45:00', 'completada'),
(34, 34, '2025-05-17 08:15:00', 'en_proceso'),
(35, 35, '2025-05-19 18:00:00', 'pendiente'),
(1, 1, '2025-05-21 13:00:00', 'completada'),
(2, 2, '2025-05-23 14:30:00', 'pendiente'),
(3, 3, '2025-05-25 12:45:00', 'en_proceso'),
(4, 4, '2025-05-27 09:15:00', 'completada'),
(5, 5, '2025-05-29 11:00:00', 'pendiente'),
(6, 6, '2025-06-01 16:30:00', 'completada'),
(7, 7, '2025-06-03 15:00:00', 'en_proceso'),
(8, 8, '2025-06-05 13:30:00', 'pendiente'),
(9, 9, '2025-06-07 12:00:00', 'completada'),
(10, 10, '2025-06-09 18:30:00', 'pendiente'),
(11, 11, '2025-06-11 14:15:00', 'completada'),
(12, 12, '2025-06-13 16:00:00', 'en_proceso');



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

----Datos para programacion
INSERT INTO PROGRAMACION (id_tecnico, id_tarea, id_equipo, notas, prioridad, estado, fecha_programacion) VALUES
(1, 1, 1, 'Revisión periódica del equipo', 'Alta', 'pendiente', '2025-03-01 08:30:00'),
(2, 2, 2, 'Mantenimiento preventivo', 'Media', 'en_proceso', '2025-03-02 09:00:00'),
(3, 3, 3, 'Instalación de software', 'Baja', 'realizado', '2025-03-03 10:30:00'),
(4, 4, 4, 'Cambio de piezas defectuosas', 'Alta', 'pendiente', '2025-03-04 11:00:00'),
(5, 5, 5, 'Revisión de sistema de red', 'Media', 'en_proceso', '2025-03-05 14:15:00'),
(6, 6, 6, 'Pruebas de rendimiento', 'Alta', 'realizado', '2025-03-06 15:00:00'),
(7, 7, 7, 'Diagnóstico de fallos', 'Baja', 'pendiente', '2025-03-07 16:30:00'),
(8, 8, 8, 'Configuración de equipo de trabajo', 'Alta', 'en_proceso', '2025-03-08 10:00:00'),
(9, 9, 9, 'Revisión de seguridad', 'Media', 'realizado', '2025-03-09 11:45:00'),
(10, 10, 10, 'Mantenimiento de servidor', 'Alta', 'pendiente', '2025-03-10 12:00:00'),
(11, 11, 11, 'Reemplazo de baterías', 'Baja', 'en_proceso', '2025-03-11 13:00:00'),
(12, 12, 12, 'Actualización de software de servidor', 'Alta', 'realizado', '2025-03-12 14:30:00'),
(13, 13, 13, 'Reparación de pantalla', 'Media', 'pendiente', '2025-03-13 15:30:00'),
(14, 14, 14, 'Optimización de base de datos', 'Alta', 'en_proceso', '2025-03-14 16:00:00'),
(15, 15, 15, 'Revisión de hardware', 'Baja', 'realizado', '2025-03-15 17:00:00'),
(16, 16, 16, 'Cambio de unidad de almacenamiento', 'Alta', 'pendiente', '2025-03-16 18:30:00'),
(17, 17, 17, 'Revisión de red y conexiones', 'Media', 'en_proceso', '2025-03-17 09:45:00'),
(18, 18, 18, 'Desinstalación de programas no deseados', 'Baja', 'realizado', '2025-03-18 11:00:00'),
(19, 19, 19, 'Mantenimiento de equipo de comunicación', 'Alta', 'pendiente', '2025-03-19 12:30:00'),
(20, 20, 20, 'Configuración de red local', 'Media', 'en_proceso', '2025-03-20 13:45:00'),
(21, 21, 21, 'Revisión de cámaras de seguridad', 'Baja', 'realizado', '2025-03-21 14:00:00'),
(22, 22, 22, 'Mantenimiento de impresora', 'Alta', 'pendiente', '2025-03-22 15:30:00'),
(23, 23, 23, 'Reemplazo de memoria RAM', 'Media', 'en_proceso', '2025-03-23 16:30:00'),
(24, 24, 24, 'Reparación de software', 'Alta', 'realizado', '2025-03-24 17:00:00'),
(25, 25, 25, 'Instalación de antivirus', 'Baja', 'pendiente', '2025-03-25 18:30:00'),
(26, 26, 26, 'Actualización de firmware', 'Alta', 'en_proceso', '2025-03-26 09:00:00'),
(27, 27, 27, 'Revisión de sistemas de seguridad', 'Media', 'realizado', '2025-03-27 10:30:00'),
(28, 28, 28, 'Mantenimiento preventivo de sistemas', 'Alta', 'pendiente', '2025-03-28 11:15:00'),
(29, 29, 29, 'Pruebas de compatibilidad de software', 'Baja', 'en_proceso', '2025-03-29 12:00:00'),
(30, 30, 30, 'Revisión de energía y baterías', 'Alta', 'realizado', '2025-03-30 13:45:00'),
(31, 31, 31, 'Reemplazo de disco duro', 'Media', 'pendiente', '2025-03-31 14:30:00'),
(32, 32, 32, 'Optimización de servidor', 'Baja', 'en_proceso', '2025-04-01 16:00:00'),
(33, 33, 33, 'Instalación de sistemas operativos', 'Alta', 'realizado', '2025-04-02 17:15:00'),
(34, 34, 34, 'Revisión de conexiones de red', 'Media', 'pendiente', '2025-04-03 18:30:00'),
(35, 35, 35, 'Mantenimiento de equipo de computo', 'Alta', 'en_proceso', '2025-04-04 09:45:00');



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
---Mantenimientos

INSERT INTO registroMantenimiento (id_Programacion, piezas_Reemplazadas, fecha_Realizacion, tiempo_empleado, observaciones) VALUES
(1, 'Tubo de rayos X, Colimador', '2025-03-15 09:00:00', 120, 'Mantenimiento preventivo realizado sin inconvenientes.'),
(2, 'Detector digital', '2025-03-16 10:30:00', 90, 'Se reemplazaron componentes menores y se calibró el sistema.'),
(3, 'Electrodos de ECG', '2025-03-17 11:45:00', 60, 'Sustitución de electrodos y ajuste en la configuración del equipo.'),
(4, 'Cables de conexión', '2025-03-18 12:00:00', 75, 'Revisión de conexiones; se reemplazaron cables desgastados.'),
(5, 'Papel térmico', '2025-03-19 13:15:00', 45, 'Cambio de papel térmico para garantizar la calidad de impresión.'),
(6, 'Bobinas de RF', '2025-03-20 14:30:00', 110, 'Limpieza y revisión de bobinas; calibración finalizada.'),
(7, 'Sistema de enfriamiento', '2025-03-21 15:45:00', 130, 'Mantenimiento integral del sistema de enfriamiento y verificación de la temperatura.'),
(8, 'Mesa deslizante', '2025-03-22 16:00:00', 80, 'Lubricación y ajuste de la mesa para mejorar el movimiento.'),
(9, 'Imán superconductivo', '2025-03-23 17:30:00', 100, 'Verificación y corrección de desalineación en el imán.'),
(10, 'Colimador', '2025-03-24 18:45:00', 95, 'Reemplazo del colimador y prueba de calidad de imagen.');


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

---Datos certificado
INSERT INTO CERTIFICADO (fecha_emision, fecha_expiracion, tipo_certificado, descripcion, idEquipo, clues) VALUES
('2025-01-01', '2026-01-01', 'Seguridad', 'Certificado que garantiza el cumplimiento de normas de seguridad en el equipo.', 1, 'CL001'),
('2025-02-15', '2026-02-15', 'Calibración', 'Certificado de calibración del equipo para asegurar precisión en mediciones.', 2, 'CL002'),
('2025-03-10', '2026-03-10', 'Mantenimiento', 'Certificado que avala la realización de mantenimiento preventivo del equipo.', 3, 'CL003'),
('2025-04-05', '2026-04-05', 'Conformidad', 'Certificado de conformidad emitido tras exitosas pruebas operativas.', 4, 'CL004'),
('2025-05-01', '2026-05-01', 'Seguridad', 'Certificado que acredita la seguridad y operatividad del equipo luego de la revisión anual.', 5, 'CL005'),
('2025-06-10', '2026-06-10', 'Calibración', 'Certificado que confirma la correcta calibración y desempeño del equipo.', 6, 'CL006'),
('2025-07-15', '2026-07-15', 'Mantenimiento', 'Certificado que garantiza el cumplimiento del plan de mantenimiento preventivo.', 7, 'CL007'),
('2025-08-20', '2026-08-20', 'Conformidad', 'Certificado que avala la conformidad del equipo con las normativas vigentes.', 8, 'CL008'),
('2025-09-25', '2026-09-25', 'Seguridad', 'Certificado de seguridad emitido tras una inspección completa del equipo.', 9, 'CL009'),
('2025-10-30', '2026-10-30', 'Calibración', 'Certificado que acredita la calibración y óptimo funcionamiento del equipo.', 10, 'CL010');



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

---Datos reporte
INSERT INTO REPORTE (fecha_generacion, descripcion, conclusiones, recomendaciones, idEquipo, idTecnico) VALUES
('2025-03-10', 'Revisión general del equipo para evaluar su rendimiento y operatividad.', 'El equipo presenta funcionamiento óptimo con leves signos de desgaste.', 'Continuar con el mantenimiento preventivo y revisar componentes críticos en el siguiente servicio.', 1, 1),
('2025-03-11', 'Inspección detallada de componentes electrónicos y mecánicos.', 'Se detectaron leves inconsistencias en algunos circuitos, sin afectar la operatividad.', 'Ajustar calibración y programar revisión en 6 meses.', 2, 2),
('2025-03-12', 'Chequeo de calibración y precisión en la generación de imágenes.', 'Imágenes obtenidas con buena resolución; calibración en rango aceptable.', 'Revisar nuevamente la calibración en el próximo mantenimiento.', 3, 3),
('2025-03-13', 'Evaluación del sistema de enfriamiento y rendimiento térmico.', 'El sistema de enfriamiento opera correctamente, aunque se observa una eficiencia menor en horas pico.', 'Limpiar filtros y revisar el sistema de refrigeración en la siguiente revisión.', 4, 4),
('2025-03-14', 'Pruebas de seguridad y verificación de alarmas del equipo.', 'Sensores y alarmas responden adecuadamente, con mínimas variaciones en la sensibilidad.', 'Recalibrar sensores y actualizar software de monitoreo para mayor precisión.', 5, 5),
('2025-03-15', 'Mantenimiento preventivo de rutina en el equipo.', 'El equipo se encuentra en excelentes condiciones tras el mantenimiento preventivo.', 'Programar el siguiente mantenimiento en 6 meses y monitorear el desgaste de componentes.', 6, 6),
('2025-03-16', 'Análisis del rendimiento y velocidad de procesamiento del equipo.', 'El rendimiento se mantiene dentro de los parámetros establecidos sin desviaciones significativas.', 'Continuar con pruebas periódicas de rendimiento y optimización de software.', 7, 7),
('2025-03-17', 'Inspección de conexiones eléctricas y estado de cables.', 'Se identificaron algunas conexiones con desgaste moderado, sin afectar el funcionamiento.', 'Reemplazar las conexiones críticas y reforzar las revisiones de seguridad.', 8, 8),
('2025-03-18', 'Verificación de integridad estructural y revisión de carcasas.', 'Pequeñas fisuras fueron detectadas en la carcasa, sin riesgo inmediato para el funcionamiento.', 'Reforzar la estructura y evaluar la posibilidad de reemplazo a mediano plazo.', 9, 9),
('2025-03-19', 'Revisión post-mantenimiento para confirmar la estabilidad operativa del equipo.', 'El equipo opera de manera estable sin errores detectados tras el mantenimiento.', 'Mantener el monitoreo regular y realizar revisiones de rutina conforme al plan de mantenimiento.', 10, 10);



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
---Datos de archivos
INSERT INTO ARCHIVOS (idTecnico, fecha_generacion, tipo, ruta, fecha) VALUES
(1, '2025-03-15 10:00:00', 'Reporte', '/archivos/tecnico1/reporte_20250315.pdf', '2025-03-15 09:00:00'),
(2, '2025-03-16 11:30:00', 'Informe', '/archivos/tecnico2/informe_20250316.pdf', '2025-03-16 10:30:00'),
(3, '2025-03-17 14:45:00', 'Mantenimiento', '/archivos/tecnico3/mantenimiento_20250317.pdf', '2025-03-17 13:45:00'),
(4, '2025-03-18 09:15:00', 'Diagnóstico', '/archivos/tecnico4/diagnostico_20250318.pdf', '2025-03-18 08:15:00'),
(5, '2025-03-19 16:00:00', 'Reporte', '/archivos/tecnico5/reporte_20250319.pdf', '2025-03-19 15:00:00'),
(6, '2025-03-20 12:30:00', 'Informe', '/archivos/tecnico6/informe_20250320.pdf', '2025-03-20 11:30:00'),
(7, '2025-03-21 10:15:00', 'Mantenimiento', '/archivos/tecnico7/mantenimiento_20250321.pdf', '2025-03-21 09:15:00'),
(8, '2025-03-22 14:00:00', 'Diagnóstico', '/archivos/tecnico8/diagnostico_20250322.pdf', '2025-03-22 13:00:00'),
(9, '2025-03-23 08:45:00', 'Reporte', '/archivos/tecnico9/reporte_20250323.pdf', '2025-03-23 07:45:00'),
(10, '2025-03-24 11:00:00', 'Informe', '/archivos/tecnico10/informe_20250324.pdf', '2025-03-24 10:00:00');




CREATE TABLE PIEZAS (
    id_piezas INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT,
    UNIQUE (nombre)
);


---Datos de piezas
INSERT INTO PIEZAS (nombre, descripcion) VALUES
('Tubo de rayos X', 'Elemento fundamental en la generación de imágenes, convierte energía en radiación controlada.'),
('Colimador', 'Dispositivo óptico que delimita y enfoca el haz de rayos X para obtener imágenes precisas.'),
('Detector digital', 'Componente electrónico que captura la radiación y la convierte en imágenes digitales de alta resolución.'),
('Electrodos de ECG', 'Piezas utilizadas en electrocardiogramas para registrar la actividad eléctrica del corazón.'),
('Cable de conexión', 'Cable especializado que asegura la transmisión de señales entre los componentes del equipo.'),
('Papel térmico', 'Material utilizado en la impresión de registros médicos, diseñado para resistir altas temperaturas.'),
('Bobinas de RF', 'Componentes esenciales en resonadores magnéticos para captar y transmitir señales de radiofrecuencia.'),
('Sistema de enfriamiento', 'Conjunto de piezas que mantiene la temperatura adecuada en equipos de alta potencia.'),
('Mesa deslizante', 'Plataforma ajustable que posiciona al paciente durante exámenes de tomografía.'),
('Imán superconductivo', 'Elemento crítico en resonadores magnéticos, responsable de generar campos magnéticos intensos.');








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

--procedimiento para insercion de datos usuario, se utiliza para administradores y tecnicos 
DELIMITER //
CREATE PROCEDURE sp_insertar_usuario_custom (
    IN p_username VARCHAR(100),
    IN p_email VARCHAR(150),
    IN p_nombre VARCHAR(100),
    IN p_rol VARCHAR(50),
    IN p_especialidad VARCHAR(255)
)
BEGIN
    DECLARE v_idUsuario INT;
    START TRANSACTION;
    INSERT INTO USUARIO (username, email, usuario, rol)
    VALUES (p_username, p_email, p_nombre, p_rol);
    SET v_idUsuario = LAST_INSERT_ID();
    -- Insertar en la tabla correspondiente según el rol
    IF p_rol = 'admin' THEN
        INSERT INTO ADMINISTRADOR (idUsuario) VALUES (v_idUsuario);
    ELSEIF p_rol = 'tecnico' THEN
        INSERT INTO TECNICO (idUsuario, especialidad) VALUES (v_idUsuario, p_especialidad);
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Rol no reconocido para inserción manual';
    END IF;
    COMMIT;
    SELECT 
        v_idUsuario AS idUsuario, 
        CONCAT('uservital', LPAD(v_idUsuario, 4, '0')) AS id_formatted;
END//
DELIMITER ;


DELIMITER //
CREATE PROCEDURE sp_asignar_tecnico_a_tarea (
    IN p_id_tarea INT
)
BEGIN
    DECLARE v_especialidad VARCHAR(255);
    DECLARE v_id_tecnico INT;

    SELECT t.nombre INTO v_especialidad
    FROM TAREAS t
    WHERE t.id_tarea = p_id_tarea;

    SELECT idTecnico INTO v_id_tecnico
    FROM TECNICO
    WHERE especialidad = v_especialidad
    LIMIT 1;  -- Limitar a un solo técnico
    IF v_id_tecnico IS NOT NULL THEN
        INSERT INTO TAREA_TECNICO (id_tarea, idTecnico, estado)
        VALUES (p_id_tarea, v_id_tecnico, 'pendiente');
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se encontró un técnico con la especialidad necesaria para esta tarea.';
    END IF;
END//
DELIMITER ;

--Procedimiento para solicitar mantenimiento (para clientes):
DELIMITER //
CREATE PROCEDURE sp_solicitar_mantenimiento(
    IN p_clues VARCHAR(20),
    IN p_id_equipo INT,
    IN p_fecha_programacion DATETIME,
    IN p_notas TEXT,
    IN p_id_tarea INT
)
BEGIN
    -- Declarar todas las variables al inicio
    DECLARE v_cliente_count INT;
    DECLARE v_equipo_clues VARCHAR(20);
    DECLARE v_especialidad VARCHAR(255);
    DECLARE v_id_tecnico INT;

    -- Verificar que el cliente exista
    SELECT COUNT(*) INTO v_cliente_count
    FROM CLIENTE
    WHERE clues = p_clues;
    IF v_cliente_count = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Cliente no autorizado o no existe.';
    END IF;

    -- Verificar que el equipo pertenezca al cliente
    SELECT clues INTO v_equipo_clues
    FROM EQUIPOS
    WHERE idEquipo = p_id_equipo;
    IF v_equipo_clues != p_clues THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El equipo no pertenece al cliente.';
    END IF;
    -- Asignar un técnico especializado según la tarea
    SELECT nombre INTO v_especialidad
    FROM TAREAS
    WHERE id_tarea = p_id_tarea;
    SELECT idTecnico INTO v_id_tecnico
    FROM TECNICO
    WHERE especialidad = v_especialidad
    LIMIT 1;
    IF v_id_tecnico IS NULL THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se encontró un técnico especializado para la tarea.';
    END IF;

    -- Agendar el mantenimiento usando el procedimiento existente
    CALL sp_agendar_mantenimiento(v_id_tecnico, p_id_tarea, p_id_equipo, p_fecha_programacion, p_notas, 'normal');

    -- Mensaje de éxito
    SELECT 'Mantenimiento solicitado exitosamente.' AS mensaje;
END//
DELIMITER ;

-- Procedimiento para consultar reportes de mantenimiento (para clientes)
DELIMITER //
CREATE PROCEDURE sp_consultar_reportes_cliente(
    IN p_clues VARCHAR(20)
)
BEGIN
    SELECT r.idReporte,
           r.fecha_generacion,
           r.descripcion,
           r.conclusiones,
           r.recomendaciones,
           e.nombre AS equipo
    FROM REPORTE r
    JOIN EQUIPOS e ON r.idEquipo = e.idEquipo
    JOIN CLIENTE c ON e.clues = c.clues
    WHERE c.clues = p_clues
    ORDER BY r.fecha_generacion DESC;
END//
DELIMITER ;


ALTER TABLE TAREAS
  ADD CONSTRAINT chk_frecuencia CHECK (frecuencia_dias > 0);

DELIMITER //
CREATE PROCEDURE sp_actualizar_estado_mantenimiento(
    IN p_id_programacion INT,
    IN p_nuevo_estado VARCHAR(50),
    IN p_username VARCHAR(100)  -- Usuario que ejecuta la acción
)
BEGIN
    DECLARE v_rol VARCHAR(50);
    -- Se obtiene el rol del usuario
    SELECT rol INTO v_rol 
    FROM USUARIO 
    WHERE username = p_username;
    -- Solo se permite la operación a administradores o técnicos
    IF v_rol NOT IN ('admin', 'tecnico') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Operación permitida solo para administradores o técnicos.';
    END IF;
    -- Validar que el nuevo estado sea uno permitido
    IF p_nuevo_estado NOT IN ('pendiente', 'en_proceso', 'realizado') THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Estado no permitido.';
    END IF;
    UPDATE PROGRAMACION
    SET estado = p_nuevo_estado
    WHERE id_programacion = p_id_programacion;
    
    SELECT 'Estado actualizado exitosamente.' AS mensaje;
END//
DELIMITER ;

--procedimineto que garantiza que solo los admins puedan generar nuevos usuarios
DELIMITER //
CREATE PROCEDURE sp_registrar_usuario(
    IN p_username VARCHAR(100),
    IN p_email VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_rol VARCHAR(50),
    IN p_solicitante VARCHAR(100)  -- Usuario que intenta registrar a otro usuario
)
BEGIN
    DECLARE v_rol_solicitante VARCHAR(50);
    
    -- Validar que el solicitante sea administrador
    SELECT rol INTO v_rol_solicitante FROM USUARIO WHERE username = p_solicitante;
    
    IF v_rol_solicitante <> 'admin' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Solo los administradores pueden registrar nuevos usuarios.';
    END IF;

    -- Insertar nuevo usuario
    INSERT INTO USUARIO (username, email, password, rol) 
    VALUES (p_username, p_email, SHA2(p_password, 256), p_rol);
    
    SELECT 'Usuario registrado exitosamente.' AS mensaje;
END//
DELIMITER ;

--procedimiento para cancelar una tarea programada
DELIMITER //
CREATE PROCEDURE sp_cancelar_tarea(
    IN p_id_programacion INT,
    IN p_username VARCHAR(100)
)
BEGIN
    DECLARE v_rol VARCHAR(50);
    DECLARE v_id_tecnico INT;
    -- Obtener rol del usuario
    SELECT rol INTO v_rol FROM USUARIO WHERE username = p_username;
    -- Verificar si el usuario es un administrador o técnico
    IF v_rol = 'tecnico' THEN
        -- Obtener el técnico asignado a la tarea
        SELECT id_tecnico INTO v_id_tecnico FROM PROGRAMACION WHERE id_programacion = p_id_programacion;
        -- Verificar que el técnico asignado sea el que intenta cancelar la tarea
        IF (SELECT idTecnico FROM TECNICO WHERE idUsuario = (SELECT idUsuario FROM USUARIO WHERE username = p_username)) <> v_id_tecnico THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No tienes permisos para cancelar esta tarea.';
        END IF;
    ELSEIF v_rol <> 'admin' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Solo administradores o técnicos pueden cancelar tareas.';
    END IF;
    -- Actualizar estado de la tarea a "cancelada"
    UPDATE PROGRAMACION SET estado = 'cancelada' WHERE id_programacion = p_id_programacion;
    SELECT 'Tarea cancelada exitosamente.' AS mensaje;
END//
DELIMITER ;


--procedimiento para notificar a los tecnicos sobre proximos mantenimientos

DELIMITER //
CREATE PROCEDURE sp_notificar_tecnicos()
BEGIN
    SELECT 
        P.id_programacion, 
        E.nombre AS equipo, 
        T.nombre AS tarea, 
        CONCAT(U.nombre, ' ', U.apellido) AS tecnico,
        P.fecha_programacion
    FROM PROGRAMACION P
    INNER JOIN EQUIPOS E ON P.id_equipo = E.idEquipo
    INNER JOIN TAREAS T ON P.id_tarea = T.id_tarea
    INNER JOIN TECNICO TE ON P.id_tecnico = TE.idTecnico
    INNER JOIN USUARIO U ON TE.idUsuario = U.idUsuario
    WHERE P.fecha_programacion BETWEEN NOW() AND DATE_ADD(NOW(), INTERVAL 3 DAY)
    ORDER BY P.fecha_programacion ASC;
END//
DELIMITER ;

--procedimiento para eliminar a usuarios si no tienen tareas activas
DELIMITER //
CREATE PROCEDURE sp_eliminar_usuario(
    IN p_id_usuario INT,
    IN p_admin_username VARCHAR(100)
)
BEGIN
    DECLARE v_rol_admin VARCHAR(50);
    DECLARE v_count INT;
    -- Verificar que sea un administrador
    SELECT rol INTO v_rol_admin FROM USUARIO WHERE username = p_admin_username;
    IF v_rol_admin <> 'admin' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Solo los administradores pueden eliminar usuarios.';
    END IF;
    -- Verificar si el usuario tiene tareas asignadas
    SELECT COUNT(*) INTO v_count FROM PROGRAMACION WHERE id_tecnico = p_id_usuario;
    IF v_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede eliminar el usuario porque tiene tareas activas.';
    END IF;
    -- Eliminar usuario
    DELETE FROM USUARIO WHERE idUsuario = p_id_usuario;
    SELECT 'Usuario eliminado correctamente.' AS mensaje;
END//
DELIMITER ;
--procedimiento para que el admin pueda crear nuevas tareas 
DELIMITER //
CREATE PROCEDURE sp_crear_tarea(
    IN p_nombre VARCHAR(100),
    IN p_descripcion TEXT,
    IN p_frecuencia_dias INT,
    IN p_admin_username VARCHAR(100)
)
BEGIN
    DECLARE v_rol_admin VARCHAR(50);

    -- Verificar que el usuario es administrador
    SELECT rol INTO v_rol_admin FROM USUARIO WHERE username = p_admin_username;
    
    IF v_rol_admin <> 'admin' THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Solo los administradores pueden crear tareas.';
    END IF;

    -- Insertar nueva tarea
    INSERT INTO TAREAS (nombre, descripcion, frecuencia_dias) 
    VALUES (p_nombre, p_descripcion, p_frecuencia_dias);

    SELECT 'Tarea creada exitosamente.' AS mensaje;
END//
DELIMITER ;

--trigger para evitar que el admin elimine tareas si estan activas 
DELIMITER //
CREATE TRIGGER trg_prevenir_eliminacion_tareas
BEFORE DELETE ON TAREAS
FOR EACH ROW
BEGIN
    DECLARE v_count INT;

    -- Verificar si la tarea tiene programaciones activas
    SELECT COUNT(*) INTO v_count FROM PROGRAMACION WHERE id_tarea = OLD.id_tarea;
    
    IF v_count > 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No se puede eliminar esta tarea, tiene mantenimientos en curso.';
    END IF;
END//
DELIMITER ;

