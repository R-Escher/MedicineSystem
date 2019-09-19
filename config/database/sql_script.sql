CREATE DATABASE msystem_db1
	CHARACTER SET utf8
	COLLATE utf8_unicode_ci;

use msystem_db1;

CREATE TABLE admin (
    login VARCHAR(30) NOT NULL UNIQUE,
    senha VARCHAR(200) NOT NULL
);

INSERT INTO admin VALUES (
    'admin', 
    '21232f297a57a5a743894a0e4a801fc3' /* admin */
);

CREATE TABLE consultas (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    data TIMESTAMP,
    medico VARCHAR(30) NOT NULL,
    paciente VARCHAR(30) NOT NULL,
    receita VARCHAR(200) NOT NULL,
    observacoes VARCHAR(200) NOT NULL,
    requisicao VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE exames (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    data TIMESTAMP,
    laboratorio VARCHAR(30) NOT NULL,
    paciente VARCHAR(30) NOT NULL,
    tipos_exames VARCHAR(200) NOT NULL,
    resultado VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE medicos (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    crm VARCHAR(30) NOT NULL,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    telefone VARCHAR(30),
    email VARCHAR(30) NOT NULL,
    senha VARCHAR(200) NOT NULL,
    especialidade VARCHAR(200) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE pacientes (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    cpf VARCHAR(30) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    telefone VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    senha VARCHAR(200) NOT NULL,
    idade INT(6) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE laboratorios (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    cnpj VARCHAR(30) NOT NULL,
    nome VARCHAR(200) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    telefone VARCHAR(30) NOT NULL,
    email VARCHAR(30) NOT NULL,
    senha VARCHAR(200) NOT NULL,
    tipos_exames VARCHAR(200) NOT NULL,
    PRIMARY KEY (id)
);