# Padrão MVC (Model-View-Controller) e Implementação Mini

## O que é o Padrão MVC?

O padrão MVC é uma arquitetura de software que divide uma aplicação em três componentes principais, cada um com responsabilidades específicas:

- **Model (Modelo)**: Gerencia os dados e a lógica de negócios
- **View (Visualização)**: Apresenta os dados ao usuário (interface)
- **Controller (Controlador)**: Coordena o Model e a View, processando as requisições do usuário

## Ilustração Visual do Fluxo MVC

```
┌─────────────────┐    1. Requisição HTTP     ┌─────────────────┐
│                 │ ────────────────────────› │                 │
│     Usuário     │                           │    Controller   │
│   (Navegador)   │ ‹──────────────────────── │                 │
└─────────────────┘    6. Resposta HTML       └────────┬────────┘
                                                       │
                                                       │ 2. Solicita
                                                       │    dados
                                                       ▼
┌─────────────────┐                           ┌─────────────────┐
│                 │    3. Consulta dados      │                 │
│  Banco de Dados │ ‹───────────────────────  │      Model      │
│                 │                           │                 │
│                 │ ────────────────────────› │                 │
└─────────────────┘    4. Retorna dados       └────────┬────────┘
                                                       │
                                                       │ 5. Passa dados
                                                       │    processados
                                                       ▼
                                              ┌─────────────────┐
                                              │                 │
                                              │      View       │
                                              │                 │
                                              └─────────────────┘
```

## Benefícios do MVC

- **Separação de responsabilidades**: Cada componente tem uma função específica
- **Manutenção facilitada**: Mudanças em um componente não afetam os outros
- **Código reutilizável**: Componentes podem ser reaproveitados
- **Desenvolvimento paralelo**: Equipes podem trabalhar em diferentes componentes simultaneamente
- **Testabilidade**: Componentes podem ser testados isoladamente

```

## Estrutura de Arquivos MVC Mini

```
📦 Sistema
 ┣ 📂 config/
 ┃ ┗ 📜 database.php       # Configuração da conexão com o banco de dados
 ┣ 📂 models/
 ┃ ┗ 📜 Item.php           # Modelo para gerenciar itens
 ┣ 📂 views/
 ┃ ┣ 📂 templates/
 ┃ ┃ ┗ 📜 header.php       # Cabeçalho comum das páginas
 ┃ ┣ 📜 login.php          # Página de login
 ┃ ┣ 📜 lista.php          # Página de listagem dos itens
 ┃ ┣ 📜 formulario.php     # Formulário para adicionar/editar
 ┃ ┣ 📜 confirmar_exclusao.php # Confirmação antes de excluir
 ┃ ┗ 📜 visualizar.php     # Página para visualizar detalhes
 ┣ 📂 controllers/
 ┃ ┣ 📜 AuthController.php # Controlador de autenticação
 ┃ ┗ 📜 ItemController.php # Controlador de itens
 ┣ 📂 services/
 ┃ ┗ 📜 Auth.php           # Serviço de autenticação e perfis
 ┗ 📜 index.php            # Arquivo principal de controle
```