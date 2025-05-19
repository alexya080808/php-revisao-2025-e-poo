<?php
/**
 * View para a página de login
 */
function renderizarLogin($erro = '') {
    echo "<!DOCTYPE html>
    <html>
    <head>
        <meta charset='UTF-8'>
        <title>Login</title>
    </head>
    <body>
        <h1>Login</h1>";
    
    if ($erro) {
        echo "<p><strong>$erro</strong></p>";
    }
    
    echo "<form method='post' action='index.php?pagina=autenticar'>
            <div>
                <label>Usuário:</label>
                <input type='text' name='usuario' required>
            </div>
            <div>
                <label>Senha:</label>
                <input type='password' name='senha' required>
            </div>
            <div>
                <button type='submit'>Entrar</button>
            </div>
        </form>
        <p><small>Admin: admin/admin123 | Usuário: user/user123</small></p>
    </body>
    </html>";
}