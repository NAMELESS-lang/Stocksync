CREATE DATABASE projeto;

CREATE table IF NOT EXISTS users(
id INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
nome VARCHAR(60),
cpf VARCHAR(14),
funcao varchar(30),
grupo varchar(30),
senha VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS item(
codigo_barra VARCHAR(10) PRIMARY KEY NOT NULL,
data_validade DATE,
categoria VARCHAR(30),
marca VARCHAR(30),
quantidade INTEGER NOT NULL,
peso VARCHAR(30),
valor VARCHAR(25),
id_cadastrador INTEGER,
FOREIGN KEY (id_cadastrador) REFERENCES users(id)
);


CREATE TABLE IF NOT EXISTS alteracoes(
usuario_id INTEGER NOT NULL, 
codigo_barra_item VARCHAR(10) NOT NULL,
data_acao DATE,
hora_acao TIME,
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(codigo_barra_item) REFERENCES item(codigo_barra)
);