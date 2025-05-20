# Sequência de Construção do Sistema MVC Mini com Controle de Perfis

Este guia apresenta a sequência passo a passo para construir um sistema MVC com controle de acesso baseado em perfis, com uma abordagem simples e didática.

## 1. **bd.sql** - Criar o banco de dados e tabelas iniciais

```sql
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
```

**Teste:**
- Execute o script no MySQL para criar o banco e as tabelas
- Verifique se as tabelas e dados de teste foram criados corretamente

## 2. **config/database.php** - Configuração da conexão com o banco de dados

```php
<?php

// Arquivo já completo fornecido pelo Professor
// Obs: Contêm informações importantes de conexão usando PDO com comentários (Analise para aprendizado)

```

**Teste:**
- Crie um arquivo temporário de teste com o seguinte código:
```php
<?php
require_once 'config/database.php';
try {
    $conn = conectarBD();
    echo "Conexão com o banco de dados estabelecida com sucesso!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
```
- Acesse esse arquivo no navegador para verificar se a conexão funciona

## 3. **services/Auth.php** - Serviço de autenticação e controle de acesso

```php
<?php

// 1ª Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Ainda não é possível testar completamente esta classe, pois ela será usada com outras partes do sistema

## 4. **views/templates/header.php** - Cabeçalho comum para todas as páginas

```php
<?php

// Arquivo já completo fornecido pelo Professor

```

**Teste:**
- Este arquivo será testado junto com outras partes do sistema

## 5. **views/login.php** - Página de login

```php

// Arquivo já completo fornecido pelo Professor

```

**Teste:**
- Este arquivo será testado junto com o controlador de autenticação

## 6. **controllers/AuthController.php** - Controlador para ações de autenticação

```php
<?php

// 2ª Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 7. **index.php** (versão inicial) - Para testar o login

```php
<?php

// 3ª Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Acesse o index.php no navegador
- Tente fazer login com os usuários cadastrados
- Verifique se o login, autenticação e logout funcionam corretamente

## 8. **models/Item.php** - Modelo para gerenciar itens

```php

// 4ª Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Crie um arquivo temporário para testar as funções básicas do modelo:
```php
<?php
require_once 'config/database.php';
require_once 'models/Item.php';

// Testar buscar todos os itens
$itens = Item::buscarTodos();
echo "<h2>Todos os itens:</h2>";
print_r($itens);

// Testar buscar um item específico
echo "<h2>Item específico:</h2>";
$item = Item::buscarPorId(1);
print_r($item);
```

## 9. **views/lista.php** - Listagem de itens

```php

// 5 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 10. **controllers/ItemController.php** (parte 1) - Controlador para listar itens

```php

// 6 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 11. **index.php** (atualização 1) - Adicionar rota para listar itens

```php

// 7 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Acesse o sistema novamente
- Faça login e verifique se a lista de itens é exibida
- Teste o link "Voltar à Lista" e "Sair"

## 12. **views/visualizar.php** - Visualização de um item

```php

// Arquivo já completo fornecido pelo Professor

```

## 13. **controllers/ItemController.php** (atualização 1) - Adicionar método para visualizar

```php

// 8 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 14. **index.php** (atualização 2) - Adicionar rota para visualizar item

```php

// 9 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Faça login e acesse a lista de itens
- Clique no link "Ver" para visualizar os detalhes de um item
- Teste o link "Voltar"

## 15. **views/formulario.php** - Formulário para adicionar/editar item

```php

// Arquivo já completo fornecido pelo Professor

```

## 16. **controllers/ItemController.php** (atualização 2) - Adicionar/editar itens

```php

// 10 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 17. **index.php** (atualização 3) - Adicionar rotas para adicionar/editar

```php

// 11 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

**Teste:**
- Faça login como administrador
- Tente adicionar um novo item através do link "Adicionar Novo"
- Teste a edição de um item existente
- Verifique se as permissões de acesso funcionam corretamente (admin pode adicionar/editar, usuário comum não)

## 18. **views/confirmar_exclusao.php** - Confirmação antes de excluir

```php

// Arquivo já completo fornecido pelo Professor

```

## 19. **controllers/ItemController.php** (versão final) - Adicionar métodos para excluir

```php

// 12 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```

## 20. **index.php** (versão final) - Adicionar rotas para excluir

```php

// 13 Digitação (Digitar o código no arquivo correspondente descrito acima)
// Obs: Imagem com o código na pasta Códigos

```


**Teste:**
- Faça login como administrador
- Tente excluir um item
- Verifique se a confirmação é exibida antes da exclusão
- Teste a exclusão completa
- Faça login como usuário comum e verifique se o link de exclusão não está disponível

## Testes Finais do Sistema

### 1. Teste de Autenticação:
- Acesse o sistema e faça login com os dois tipos de usuário:
  - Admin (admin/admin123)
  - Usuário comum (user/user123)
- Verifique se o logout funciona corretamente

### 2. Teste de Permissões:
- Como admin:
  - Verifique se pode visualizar, adicionar, editar e excluir itens
- Como usuário comum:
  - Verifique se pode apenas visualizar itens
  - Tente acessar diretamente URLs de adição/edição/exclusão para confirmar que as verificações de permissão funcionam

### 3. Teste de CRUD:
- Adicione novos itens
- Visualize detalhes de itens
- Edite itens existentes
- Exclua itens (com confirmação)

### 4. Teste de Navegação:
- Verifique se o link "Voltar à Lista" funciona corretamente
- Verifique se o link "Sair" funciona corretamente

### 5. Teste de Mensagens:
- Confirme se as mensagens de sucesso/erro são exibidas corretamente após as operações

## Conclusão

Agora você tem um sistema MVC completo com controle de acesso baseado em perfis, similar ao sistema da Locadora, mas mantendo a estrutura MVC clara e sem estilos complexos. Este sistema implementa:

1. Autenticação de usuários
2. Controle de acesso baseado em perfis
3. CRUD completo de itens
4. Confirmação antes de excluir
5. Estrutura MVC organizada
6. Verificações de permissão em múltiplos níveis

Esta abordagem passo a passo permite que os alunos compreendam cada componente individualmente e como eles se integram para formar um sistema completo.
