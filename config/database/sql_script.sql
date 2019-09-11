CREATE DATABASE msystem_db1
	CHARACTER SET utf8
	COLLATE utf8_unicode_ci;

use msystem_db1;

CREATE TABLE admin (
    login VARCHAR(30) NOT NULL UNIQUE,
    senha VARCHAR(30) NOT NULL
);

INSERT INTO admin VALUES (
    admin, 
    21232f297a57a5a743894a0e4a801fc3 /* admin */
);

CREATE TABLE consultas (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    data TIMESTAMP,
    medico INT(6) NOT NULL,
    paciente INT(6) NOT NULL,
    receita VARCHAR(30) NOT NULL,
    observacoes VARCHAR(30) NOT NULL,
    requisicao VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE exames (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    data TIMESTAMP,
    laboratorio INT(6) NOT NULL,
    paciente INT(6) NOT NULL,
    tipos_exames VARCHAR(30) NOT NULL,
    resultado VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE medicos (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    crm INT(6) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    endereco VARCHAR(30) NOT NULL,
    telefone INT(6),
    email VARCHAR(30) NOT NULL,
    senha VARCHAR(30) NOT NULL,
    especialidade VARCHAR(30) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE pacientes (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    cpf INT(6) NOT NULL,
    nome VARCHAR(30) NOT NULL,
    endereco VARCHAR(30) NOT NULL,
    telefone INT(6) NOT NULL,
    email VARCHAR(30) NOT NULL,
    senha VARCHAR(30) NOT NULL,
    idade INT(6) NOT NULL,
    genero VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE laboratorios (
    id INT(6) UNSIGNED AUTO_INCREMENT,
    cnpj INT(6) NOT NULL,
    nome VARCHAR(30) NOT NULL
    endereco VARCHAR(30) NOT NULL
    telefone INT(6) NOT NULL,
    email VARCHAR(30) NOT NULL
    senha VARCHAR(30) NOT NULL
    tipos_exames VARCHAR(30) NOT NULL,
    PRIMARY KEY (id)
);