
<!-- 3ª Digitação (Aqui)
//Este arquivo será o responsável por: (Arquivo principal de controle) 


session_start();

// Carrega os arquivos necessários
require_once 'config/database.php';
require_once 'services/Auth.php';
require_once 'controllers/AuthController.php';

// Intancia o controlador de autenticação
$authController = new AuthController();

// Define a ação padrão
$pagina = $_GET['pagina'] ?? '';

// Roteamento básico para testar autenticação
switch ($pagina) {
    case 'login':
        $authController->login();
        break;
    case 'autenticar':
        $authController->autenticar();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        if (Auth::estaLogado()) {
            echo "Login bem-sucedido! Bem-vindo, ". Auth::obterUsuario()['nome'];
            echo "<br><a href='index.php?pagina=logout'>Sair</a>";
        } else {
            header('Location: index.php?pagina=login');
            exit;
        }
        break;
}

<?php
/**
 * Arquivo principal do sistema - Versão final
 */
session_start();

// Carrega os arquivos necessários
require_once 'config/database.php';
require_once 'services/Auth.php';
require_once 'views/templates/header.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/ItemController.php';

// Instancia os controladores
$authController = new AuthController();
$itemController = new ItemController();

// Define a ação padrão
$pagina = $_GET['pagina'] ?? '';

// Verifica autenticação
if (!Auth::estaLogado() && !in_array($pagina, ['login', 'autenticar'])) {
    $pagina = 'login';
}

// Roteamento
switch ($pagina) {
    // Ações de autenticação
    case 'login':
        $authController->login();
        break;
    case 'autenticar':
        $authController->autenticar();
        break;
    case 'logout':
        $authController->logout();
        break;

    // Ações de gerenciamento de itens
    case 'lista':
        $itemController->listar();
        break;
    case 'visualizar':
        $itemController->visualizar($_GET['id'] ?? 0);
        break;
    case 'adicionar':
        $itemController->adicionar();
        break;
    case 'salvar':
        $itemController->salvar();
        break;
    case 'editar':
        $itemController->editar($_GET['id'] ?? 0);
        break;
    case 'atualizar':
        $itemController->atualizar($_GET['id'] ?? 0);
        break;
    case 'excluir':
        $itemController->confirmarExclusao($_GET['id'] ?? 0);
        break;
    case 'excluir_confirmar':
        $itemController->excluir($_GET['id'] ?? 0);
        break;

    // Ação padrão
    default:
        header('Location: index.php?pagina=' . (Auth::estaLogado() ? 'lista' : 'login'));
        exit;
}

?>