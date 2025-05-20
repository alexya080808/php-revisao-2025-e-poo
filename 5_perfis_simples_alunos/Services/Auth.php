<!-- 1ª Digitação (Aqui)
Este arquivo será o responsável por: (Serviços de autenticação e perfis) -->

<?php
/**
 * Serviço de Autenticação e Controle de Acesso
 */
class Auth {

    /**
     * Verifica se um usuário existe e se suas credenciais são válidas
     */
    public static function autenticar($usuario, $senha) {
        $conn = conectarBD();
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $conn->prepare($query);
        $stmt->execute(['usuario' => $usuario]);
        $user = $stmt->fetch();

        if ($user && password_verify($senha, $user['senha'])) {
            return [
                'id' => $user['id'],
                'nome' => $user['nome'],
                'usuario' => $user['usuario'],
                'perfil' => $user['perfil']
            ];
        }

        return false;
    }

    /**
     * Inicia a sessão com os dados do usuário
     */
    public static function iniciarSessao($usuario) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_regenerate_id(true);

        $_SESSION['auth'] = [
            'logado' => true,
            'id' => $usuario['id'],
            'nome' => $usuario['nome'],
            'usuario' => $usuario['usuario'],
            'perfil' => $usuario['perfil']
        ];
    }

    /**
     * Encerra a sessão do usuário
     */
    public static function encerrarSessao() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 42000, '/');
        }

        session_destroy();
    }

    /**
     * Verifica se o usuário está autenticado
     */
    public static function estaLogado() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['auth']) && $_SESSION['auth']['logado'] === true;
    }

    /**
     * Obtém os dados do usuário autenticado
     */
    public static function obterUsuario() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['auth'] ?? null;
    }

    /**
     * Verifica se o usuário tem o perfil especificado
     */
    public static function temPerfil($perfil) {
        $usuario = self::obterUsuario();
        return $usuario && $usuario['perfil'] === $perfil;
    }

    /**
     * Verifica se o usuário é administrador
     */
    public static function isAdmin() {
        return self::temPerfil('admin');
    }

    /**
     * Verifica se o usuário tem permissão para uma ação
     */
    public static function temPermissao($acao) {
        $usuario = self::obterUsuario();

        if (!$usuario) {
            return false;
        }

        $permissoes = [
            'admin' => [
                'visualizar' => true,
                'adicionar' => true,
                'editar' => true,
                'excluir' => true
            ],
            'usuario' => [
                'visualizar' => true,
                'adicionar' => false,
                'editar' => false,
                'excluir' => false
            ]
        ];

        if (!isset($permissoes[$usuario['perfil']]) || !isset($permissoes[$usuario['perfil']][$acao])) {
            return false;
        }

        return $permissoes[$usuario['perfil']][$acao];
    }
}