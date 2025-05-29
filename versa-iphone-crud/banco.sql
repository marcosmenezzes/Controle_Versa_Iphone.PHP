CREATE DATABASE versa_iphone;
USE versa_iphone;

CREATE TABLE aparelhos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_aparelho VARCHAR(50) NOT NULL,
    modelo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    local VARCHAR(50) NOT NULL,
    situacao VARCHAR(50) NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
