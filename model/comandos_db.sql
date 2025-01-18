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
nome_item VARCHAR(40),
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
acao VARCHAR(40),
FOREIGN KEY(usuario_id) REFERENCES users(id),
FOREIGN KEY(codigo_barra_item) REFERENCES item(codigo_barra)
);


INSERT INTO item (codigo_barra, nome_item, data_validade, categoria, marca, quantidade, peso, valor, id_cadastrador) VALUES
('1234567890', 'Arroz 5kg', '2026-12-01', 'Alimentos', 'Tio João', 100, '5kg', '25.50', 1),
('9876543210', 'Feijão Preto', '2025-11-15', 'Alimentos', 'Carioca', 200, '1kg', '8.90', 1),
('4567890123', 'Macarrão Espaguete', '2024-10-30', 'Alimentos', 'Vitarella', 150, '500g', '4.50', 1),
('6789012345', 'Azeite Extra Virgem', '2026-06-20', 'Alimentos', 'Olivio', 50, '500ml', '18.00', 1),
('2345678901', 'Sabão em Pó', '2024-05-15', 'Limpeza', 'Omo', 80, '1kg', '12.99', 1),
('5678901234', 'Detergente Líquido', '2025-02-10', 'Limpeza', 'Ypê', 120, '500ml', '3.80', 1),
('3456789012', 'Papel Higiênico', '2025-09-01', 'Higiene', 'Neve', 60, '12 unidades', '10.00', 1),
('8901234567', 'Shampoo Anti-Resíduos', '2026-07-25', 'Higiene', 'Dove', 45, '400ml', '15.40', 1),
('7890123456', 'Condicionador', '2025-03-15', 'Higiene', 'Pantene', 50, '350ml', '14.80', 1),
('2348901234', 'Creme Dental', '2025-06-01', 'Higiene', 'Colgate', 300, '90g', '2.99', 1),
('1122334455', 'Chocolate Ao Leite', '2024-12-20', 'Alimentos', 'Nestlé', 500, '150g', '5.00', 1),
('6677889900', 'Cerveja Lata', '2026-04-30', 'Bebidas', 'Skol', 200, '350ml', '2.50', 1),
('9988776655', 'Refrigerante Laranja', '2025-08-01', 'Bebidas', 'Fanta', 150, '2L', '7.50', 1),
('8899776644', 'Suco de Uva', '2026-01-10', 'Bebidas', 'Del Valle', 100, '1L', '5.20', 1),
('1233211233', 'Vinho Tinto', '2026-11-05', 'Bebidas', 'Casillero del Diablo', 60, '750ml', '35.00', 1),
('4566544566', 'Bolacha de Maizena', '2024-09-10', 'Alimentos', 'Mabel', 400, '500g', '3.70', 1),
('7899877899', 'Refrigerante Coca-Cola', '2025-04-10', 'Bebidas', 'Coca-Cola', 100, '1.5L', '6.50', 1),
('3214321432', 'Maçã Gala', '2025-01-30', 'Frutas', 'Frutaria do João', 100, '500g', '4.00', 1),
('6547654765', 'Banana Prata', '2025-03-20', 'Frutas', 'Frutaria do João', 200, '1kg', '3.80', 1),
('9879879879', 'Melancia', '2025-06-15', 'Frutas', 'Frutaria do João', 50, '5kg', '9.00', 1);
