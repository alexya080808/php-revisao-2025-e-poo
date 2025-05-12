<?php
// Inicia a sessão PHP para permitir o armazenamento de dados entre páginas através de cookies
session_start();


// 1º Digitação da lógica em PHP (Aqui)
$host = "localhost";
$usuario = "root";
$senha = "Senai@118";
$banco = "sistema_simples";

function conectarBD() {
    global $host, $usuario, $senha, $banco;

    $conexao = new mysqli($host, $usuario, $senha, $banco);

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

return $conexao;
}

// --------------------------------------------------------------
// Validações e inicializações de variáveis
    //Funçaõ que valida se um campo de formulário não está vazio
function validarCampo($campo) {
    //Remove espaços em branco
    $campo = trim($campo);
    //Retorna verdadeiro se o campo não estiver vazio
    return !empty($campo);
}

//
function sanitizar($dado) {
    $dado = trim($dado);

    $dado = stripslashes($dado);

    $dado = htmlspecialchars($dado);

    return $dado;
}

// Inicializa variáveis que serão utilizadas no sistema
$mensagem = "";
$nome = "";
$id_para_editar = 0;
$operacao = "cadastrar";

if($_SERVER["REQUEST_METHOD"] == "GET") {

    if(isset($_GET["logout"])) {
        session_destroy();

        header("Location: ". $_SERVER["PHP_SELF"]);

        exit;
    }

    if (isset($_GET["editar"]) && is_numeric($_GET["editar"]) && isset($_SESSION["logado"])) {
        $id_para_editar = (int)$_GET["editar"];

        $operacao = "editar";

        $conexao = conectarBD();

        $stmt = $conexao->prepare("SELECT nome FROM itens WHERE id = ?");

        $stmt->bind_param("i", $id_para_editar);

        $stmt->execute();

        $resultado = $stmt->get_result();

        if ($registro = $resultado->fetch_assoc()) {
            
            $nome = $registro["nome"];
        }

        $stmt->close();

        $conexao->close();
    }

    // _______________________________________________________________
    // Exclusão (Delete)

    // Verifica se foi solicitada a exclusão de um item e se o usuário está logado
    if (isset($_GET["excluir"]) && is_numeric($_GET["excluir"]) && isset($_SESSION["logado"])) {
        
        $id_para_excluir = (int)$_GET["excluir"];

        $conexao = conectarBD();

        $stmt = $conexao->prepare("DELETE FROM itens WHERE id = ?");

        $stmt->bind_param("i", $id_para_excluir);

        if ($stmt->execute()) {
            $mensagem = "Item excluído com sucesso!";
        } else {
            $mensagem = "Erro ao excluir o item: ". $conexao->error;
        }

        $stmt->close();

        $conexao->close();
    }
}
// ___________________________________________________________________
// Entrada no sistema (Login)

// Verifica se a requisição atual é do tipo POST (envio de formulário)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["acao"]) && $_POST["acao"] == "login") {
        $usuario_login = sanitizar($_POST["usuario"] ?? "");
        $senha_login = sanitizar($_POST["senha"] ?? "");

        if (!validarCampo($usuario_login) || !validarCampo($senha_login)) {
            $mensagem = "Por favor, preencha todos os campos!";
        } else {
            if ($usuario_login == "admin" && $senha_login == "admin") {
                $_SESSION["logado"] = true;

                $_SESSION["usuario"] = $usuario_login;

                $mensagem = "Login realizado com sucesso!";
            } else {
                $mensagem = "Usuário ou senha incorretos!";
            }
        }
    }

    //___________________________________________________________________
    // Verifica se ação é de cadastro ou atualização (Insert/Update)

    // Verifica se a ação é de cadastro ou atualização de item e se o usuário está logado
    if (isset($_POST["acao"]) && ($_POST["acao"] == "cadastrar" || $_POST["acao"] == "atualizar") && isset($_SESSION["logado"])) {

        $nome = sanitizar($_POST["nome"] ?? "");

        if (!validarCampo($nome)) {
            $mensagem = "Por favor, preencha o campo nome!";
        } else {
            $conexao = conectarBD();

    
    //___________________________________________________________
            // Cadastro (Insert)

            // Verifica se a ação é cadastrar novo item
            if ($_POST["acao"] == "cadastrar") {

                $stmt = $conexao->prepare("INSERT INTO itens (nome) VALUES (?)");
                
                $stmt->bind_param("s", $nome);

                if($stmt->execute()) {
                    $mensagem = "Item cadastrado com sucesso!";

                    $nome = "";
                } else {
                    $mensagem = "Erro ao cadastrar item: ". $conexao->error;
                }
            }

            // __________________________________________________________
            // Atualização (Update)

            // Verifica se a ação é atualizar item existente
            else if ($_POST["acao"] == "atualizar") {
                $id = (int)$_POST["id"];

                $stmt = $conexao->prepare("UPDATE itens SET nome = ? WHERE id= ?");

                $stmt->bind_param("si", $nome, $id);

                if ($stmt->execute()) {
                    $mensagem = "Item atualizado com sucesso!";

                    header("Location: ". $_SERVER["PHP_SELF"]);

                    exit;
                } else {
                    $mensagem = "Erro ao atualizar item: ". $conexao->error;
                }
            }

            $stmt->close();

            $conexao->close();
        }
    }
}

// ___________________________________________________________________
// Retorna todos os itens cadastrados no banco de dados (Read)

// Função que consulta e retorna todos os itens cadastrados no banco de dados
function listarItens() {
    $itens = array();

    $conexao = conectarBD();

    $resultado = $conexao->query("SELECT id, nome FROM itens ORDER BY id ASC");

    if ($resultado->num_rows > 0) {
        while ($registro = $resultado->fetch_assoc()) {
            $itens[] = $registro;
        }
    }

    // Fecha a conexão com o banco de dados
    $conexao->close();
    // Retorna o array de itens
    return $itens;
}
?>


<!-- __________________________________________________________________________________
HTML + PHP Para exibição do sistema -->

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema PHP Simplificado</title>
</head>
<body>
    <!-- Cabeçalho com  informações de login -->
    <h1>Sistema PHP Simplificado</h1>
    <?php if (isset($_SESSION["logado"])): ?>
        <!-- Exibe mensagem de boas-vindas e link para logout caso o usuário esteja logado -->
        <div>
            Bem-vindo, <?php echo $_SESSION["usuario"]; ?>! 
            <!-- 🛠 O que significa ?logout=1?
                ? Inicia a query string na URL
                logout=1 Define um parâmetro chamado logout com o valor 1
                Isso é uma forma de passar um comando via URL para o PHP detectar que o usuário quer sair do sistema. -->
            <a href="?logout=1">Sair</a>
        </div>
    <?php endif; ?>
    
    <!-- Mensagens de sistema -->
    <?php if (!empty($mensagem)): ?>
        <!-- Exibe mensagens de erro ou sucesso -->
        <div>
            <?php echo $mensagem; ?>
        </div>
    <?php endif; ?>
    
    <!-- Formulário de Login (exibido apenas quando não estiver logado) -->
    <?php if (!isset($_SESSION["logado"])): ?>
        <h2>Login</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="acao" value="login">
            
            <!-- Campo de entrada para o nome de usuário -->
            <div>
                <label for="usuario">Usuário:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            
            <!-- Campo de entrada para a senha -->
            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            
            <!-- Botão de envio do formulário de login -->
            <div>
                <input type="submit" value="Entrar">
            </div>
        </form>
        
        <p>Dica: Use usuário "admin" e senha "admin" para entrar.</p>
    <?php else: ?>
        <!-- Formulário de Cadastro/Edição de Item -->
        <h2><?php echo ($operacao == "editar" ? "Editar" : "Cadastrar"); ?> Item</h2>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <input type="hidden" name="acao" value="<?php echo ($operacao == "editar" ? "atualizar" : "cadastrar"); ?>">
            
            <!-- Campo oculto para armazenar o ID do item ao editar -->
            <?php if ($operacao == "editar"): ?>
                <input type="hidden" name="id" value="<?php echo $id_para_editar; ?>">
            <?php endif; ?>
            
            <!-- Campo de entrada para o nome do item -->
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $nome; ?>" required>
            </div>
            
            <!-- Botão de envio do formulário -->
            <div>
                <input type="submit" value="<?php echo ($operacao == "editar" ? "Atualizar" : "Cadastrar"); ?>">
                <?php if ($operacao == "editar"): ?>
                    <!-- Link para cancelar a edição e voltar ao modo de cadastro -->
                    <a href="<?php echo $_SERVER["PHP_SELF"]; ?>">Cancelar</a>
                <?php endif; ?>
            </div>
        </form>
        
        <!-- Listagem de Itens -->
        <h2>Itens Cadastrados</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtém a lista de itens cadastrados
                $itens = listarItens();
                if (count($itens) > 0):
                    foreach ($itens as $item):
                ?>
                <tr>
                    <!-- Exibe o ID do item -->
                    <td><?php echo $item["id"]; ?></td>
                    <!-- Exibe o nome do item -->
                    <td><?php echo $item["nome"]; ?></td>
                    <td>
                        <!-- Links para edição e exclusão do item -->
                        <a href="?editar=<?php echo $item["id"]; ?>">Editar</a>
                        <a href="?excluir=<?php echo $item["id"]; ?>" onclick="return confirm('Tem certeza que deseja excluir este item?')">Excluir</a>
                    </td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <!-- Exibe mensagem caso não existam itens cadastrados -->
                <tr>
                    <td colspan="3">Nenhum item cadastrado</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>