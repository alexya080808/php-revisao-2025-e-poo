<!-- 2ª Digitação (Aqui)
Este arquivo será o responsável por: (Controlar a autenticação) -->

<?php

//controlador de autenticação

class AuthController {
    /**
     * Exibe a página de login 
     */
    public function login($erro = '') {
        require_once 'views/login.php';
        renderizarLogin($erro);
    }

    /**
     * Processa a tentativa de login
     */

     public function autenticar() {
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($usuario) || empty($senha)) {
            $this->login('Preencha todos os campos');
            return;
        }

        $dadosUsuario = Auth::autenticar($usuario, $senha);

        if ($dadosUsuario) {
            Auth::iniciarSessao($dadosUsuario);
            header('Location: idex.php?pagina=lista');
            exit;
        } else {
            $this->login('Usuário ou senha incorretos');
        }
     }

     /**
      * Processa o logout
      */
      public function logout() {
        Auth::encerrarSessao();
        header('Location: index.php?pagina=login');
        exit;
      }
}