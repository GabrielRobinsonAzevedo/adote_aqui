CREATE DATABASE adote_aqui;
USE adote_aqui;

CREATE TABLE animal (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    sexo VARCHAR(20),
    especie VARCHAR(50),
    idade INT,
    descricao TEXT,
    numero_contato VARCHAR(20),
    foto VARCHAR(255),
    castrado BOOLEAN,
    vacinado BOOLEAN
);