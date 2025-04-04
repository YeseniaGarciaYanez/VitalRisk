-- Active: 1725028574606@@127.0.0.1@3306@hospitales_db
CREATE DATABASE hospitales_db;

USE hospitales_db;

CREATE TABLE hospitales (
    clues VARCHAR(10) PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    entidad VARCHAR(50) NOT NULL,
    municipio VARCHAR(50) NOT NULL,
    password_hash VARCHAR(255) NOT NULL
);


CREATE TABLE mantenimientos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    equipo VARCHAR(255) NOT NULL,
    problema TEXT NOT NULL,
    fecha DATE NOT NULL
);

ALTER TABLE mantenimientos ADD COLUMN hospital VARCHAR(10) NOT NULL;

ALTER TABLE mantenimientos ADD CONSTRAINT fk_hospital FOREIGN KEY (hospital) REFERENCES hospitales(clues);
