-- Creación de la base de datos
CREATE DATABASE vitaldb;
USE vitaldb;

-- Tabla de Usuarios
CREATE TABLE USUARIO (
    idUsuario INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'tecnico', 'cliente') NOT NULL
);

-- Tabla de Clientes
CREATE TABLE CLIENTE (
    idCliente INT AUTO_INCREMENT PRIMARY KEY,
    clues VARCHAR(20) NOT NULL UNIQUE,
    idUsuario INT NOT NULL,
    nombreInstitucion VARCHAR(255) NOT NULL,
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario) ON DELETE CASCADE
);

-- Tabla de Técnicos
CREATE TABLE TECNICO (
    idTecnico INT AUTO_INCREMENT PRIMARY KEY,
    idUsuario INT NOT NULL,
    especialidad VARCHAR(255),
    FOREIGN KEY (idUsuario) REFERENCES USUARIO(idUsuario) ON DELETE CASCADE
);

-- Tabla de Tareas
CREATE TABLE TAREAS (
    id_tarea INT AUTO_INCREMENT PRIMARY KEY,
    frecuencia_dias INT NOT NULL,
    nombre VARCHAR(255) NOT NULL UNIQUE,
    descripcion TEXT
);

-- Tabla de Equipos
CREATE TABLE EQUIPOS (
    idEquipo INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    modelo VARCHAR(100),
    ubicacion VARCHAR(255),
    descripcion TEXT,
    idCliente INT NOT NULL,
    estado VARCHAR(50),
    fechaAdquisicion DATETIME,
    FOREIGN KEY (idCliente) REFERENCES CLIENTE(idCliente) ON DELETE CASCADE
);

-- Tabla de Programación de mantenimientos
CREATE TABLE PROGRAMACION (
    id_programacion INT AUTO_INCREMENT PRIMARY KEY,
    id_tecnico INT NOT NULL,
    id_tarea INT NOT NULL,
    id_equipo INT NOT NULL,
    notas TEXT,
    prioridad ENUM('baja', 'media', 'alta') DEFAULT 'media',
    estado ENUM('pendiente', 'en_proceso', 'realizado') DEFAULT 'pendiente',
    fecha_programacion DATETIME NOT NULL,
    FOREIGN KEY (id_tecnico) REFERENCES TECNICO(idTecnico) ON DELETE CASCADE,
    FOREIGN KEY (id_tarea) REFERENCES TAREAS(id_tarea) ON DELETE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES EQUIPOS(idEquipo) ON DELETE CASCADE
);

-- Inserción de datos de ejemplo
INSERT INTO USUARIO (username, email, password_hash, rol) VALUES
('admin1', 'admin1@mail.com', 'hashed_password_1', 'admin'),
('tecnico1', 'tecnico1@mail.com', 'hashed_password_2', 'tecnico'),
('cliente1', 'cliente1@mail.com', 'hashed_password_3', 'cliente');

INSERT INTO CLIENTE (clues, idUsuario, nombreInstitucion) VALUES
('CL001', 3, 'Hospital Central');

INSERT INTO TECNICO (idUsuario, especialidad) VALUES
(2, 'Electromedicina');

INSERT INTO TAREAS (frecuencia_dias, nombre, descripcion) VALUES
(30, 'Mantenimiento Preventivo', 'Revisión y limpieza de equipos médicos'),
(90, 'Calibración de Equipos', 'Ajuste y certificación de funcionamiento');

INSERT INTO EQUIPOS (nombre, modelo, ubicacion, descripcion, idCliente, estado, fechaAdquisicion) VALUES
('Electrocardiógrafo', 'ECG-2023', 'Piso 2 - Cardiología', 'Equipo para electrocardiogramas', 1, 'operativo', '2023-06-15 10:00:00');

INSERT INTO PROGRAMACION (id_tecnico, id_tarea, id_equipo, fecha_programacion, notas, prioridad, estado) VALUES
(1, 1, 1, '2025-04-01 08:00:00', 'Revisión mensual', 'alta', 'pendiente');
