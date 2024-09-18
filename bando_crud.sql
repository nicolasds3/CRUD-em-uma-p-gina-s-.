CREATE DATABASE sistema_pedidos_nicolas;

USE sistema_pedidos_nicolas;

CREATE TABLE pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_cliente VARCHAR(255) NOT NULL,
    nome_produto VARCHAR(255) NOT NULL,
    quantidade INT NOT NULL,
    data_pedido DATE NOT NULL
);

SELECT * FROM pedidos;