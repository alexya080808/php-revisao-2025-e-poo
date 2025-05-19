<?php
/**
 * Cabeçalho comum para todas as páginas
 */
function exibirHeader($titulo) {
    $usuario = Auth::obterUsuario();
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>$titulo</title>
    </head>
    <body>";
    
    if ($usuario) {
        echo "<div>
            Bem-vindo, {$usuario['nome']} [{$usuario['perfil']}] 
            <a href='index.php?pagina=logout'>Sair</a>
        </div>";
        
        if (isset($_GET['pagina']) && $_GET['pagina'] != 'lista') {
            echo "<div>
                <a href='index.php?pagina=lista'>Voltar à Lista</a>
            </div>";
        }
    }
    
    if (isset($_SESSION['mensagem'])) {
        echo "<div>
            <strong>{$_SESSION['mensagem']}</strong>
        </div>";
        unset($_SESSION['mensagem']);
    }

    echo "<hr>";
}

/**
 * Rodapé simples
 */
function exibirFooter() {
    echo "</body></html>";
}