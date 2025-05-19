-- Criar banco de dados (se não existir)
CREATE DATABASE IF NOT EXISTS sistema_perfis_pro;
USE sistema_perfis_pro;

-- Criar tabela de usuários (atualizada para incluir perfil)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil ENUM('admin', 'usuario') NOT NULL DEFAULT 'usuario'
);

-- Criar tabela de itens
CREATE TABLE IF NOT EXISTS itens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    conteudo TEXT NOT NULL
);

-- Inserir usuários padrão (senha: admin123 e user123)
INSERT INTO usuarios (nome, usuario, senha, perfil)
VALUES 
('Administrador', 'admin', '$2y$10$PkdHaAI9iqXxsNfWrTM4heKQZGMk5/r8Oi0ShbJAptvKNLQPJZvWC', 'admin'),
('Usuário Normal', 'user', '$2y$10$R6rz.FE5xUr4xKPwdXqe9.iwuYQRhn7qz3TPrZmqyzj8iiC9.LxSS', 'usuario');

-- Inserir itens de exemplo
INSERT INTO itens (titulo, conteudo)
VALUES 
('Primeiro Item', 'Conteúdo do primeiro item de exemplo'),
('Segundo Item', 'Conteúdo do segundo item de exemplo');