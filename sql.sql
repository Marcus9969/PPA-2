-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS prato_cheio;
USE prato_cheio;

-- Cria a tabela de voluntários
CREATE TABLE IF NOT EXISTS voluntarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    disponibilidade VARCHAR(20) NOT NULL,
    data_cadastro DATETIME NOT NULL,
    UNIQUE KEY unique_email (email)
);
