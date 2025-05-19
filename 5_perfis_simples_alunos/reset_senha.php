<?php
// Script para resetar senhas no sistema de perfis mini
// Use apenas em ambiente de desenvolvimento

// Função para conectar ao banco de dados
function conectarBD() {
    $host = 'localhost';
    $dbname = 'sistema_perfis_pro';
    $user = 'root';
    $pass = 'Senai@118';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erro na conexão: " . $e->getMessage() . PHP_EOL);
    }
}

// Usuários e senhas para resetar
$usuarios = [
    [
        'usuario' => 'admin',
        'senha' => 'admin123',
        'perfil' => 'admin'
    ],
    [
        'usuario' => 'user',
        'senha' => 'user123',
        'perfil' => 'usuario'
    ]
];

// Exibe cabeçalho no terminal
echo "=======================================" . PHP_EOL;
echo " Reset de Senhas - Sistema Mini " . PHP_EOL;
echo "=======================================" . PHP_EOL;

try {
    $conn = conectarBD();

    foreach ($usuarios as $usuario) {
        // Gera hash da senha
        $senha_hash = password_hash($usuario['senha'], PASSWORD_DEFAULT);

        // Atualiza a senha no banco
        $query = "UPDATE usuarios SET senha = :senha WHERE usuario = :usuario";
        $stmt = $conn->prepare($query);
        $resultado = $stmt->execute([
            'senha' => $senha_hash,
            'usuario' => $usuario['usuario']
        ]);

        // Exibe resultado
        echo PHP_EOL . "-----------------------------------" . PHP_EOL;
        if ($resultado) {
            echo "✅ Senha atualizada para: {$usuario['usuario']} ({$usuario['perfil']})" . PHP_EOL;
            echo "🔹 Usuário: {$usuario['usuario']}" . PHP_EOL;
            echo "🔹 Nova senha: {$usuario['senha']}" . PHP_EOL;
            echo "🔹 Hash gerado: $senha_hash" . PHP_EOL;

            // Verifica se o hash funciona
            if (password_verify($usuario['senha'], $senha_hash)) {
                echo "🔹 Verificação: OK ✅" . PHP_EOL;
            } else {
                echo "🔹 Verificação: FALHA ❌" . PHP_EOL;
            }
        } else {
            echo "❌ Erro ao atualizar senha para {$usuario['usuario']}" . PHP_EOL;
        }
    }

    echo PHP_EOL . "=======================================" . PHP_EOL;
    echo " Processo finalizado. " . PHP_EOL;
    echo "=======================================" . PHP_EOL;

} catch (Exception $e) {
    echo PHP_EOL . "❌ Erro: " . $e->getMessage() . PHP_EOL;
}
?>
