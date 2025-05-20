<!-- 6ª Digitação (Aqui) Parte
Este arquivo será o responsável por: (Página de listagem dos itens) -->

<!-- /**
 * Controlar para itens - Parte 1 (Listagem)
 */

 class ItemController {
    /**
     * Lista todos os itens
     */
    public function listar() {
        require_once 'models/Item.php';
        $itens = Item::buscarTodos();

        require_once 'views/lista.php';
        renderizarLista($itens);
    }
 } -->

 <?php
/**
 * Controlador para itens - Versão final
 */
class ItemController {

    /**
     * Lista todos os itens
     */
    public function listar() {
        require_once 'models/Item.php';
        $itens = Item::buscarTodos();

        require_once 'views/lista.php';
        renderizarLista($itens);
    }

    /**
     * Exibe detalhe de um item
     */
    public function visualizar($id) {
        if (!Auth::temPermissao('visualizar')) {
            $_SESSION['mensagem'] = "Você não tem permissão para visualizar itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'models/Item.php';
        $item = Item::buscarPorId($id);

        if (!$item) {
            $_SESSION['mensagem'] = "Item não encontrado.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/visualizar.php';
        renderizarVisualizar($item);
    }

    /**
     * Exibe formulário para adicionar
     */
    public function adicionar() {
        if (!Auth::temPermissao('adicionar')) {
            $_SESSION['mensagem'] = "Você não tem permissão para adicionar itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/formulario.php';
        renderizarFormulario();
    }

    /**
     * Salva um novo item
     */
    public function salvar() {
        if (!Auth::temPermissao('adicionar')) {
            $_SESSION['mensagem'] = "Você não tem permissão para adicionar itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        $titulo = $_POST['titulo'] ?? '';
        $conteudo = $_POST['conteudo'] ?? '';

        if (empty($titulo) || empty($conteudo)) {
            $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
            header('Location: index.php?pagina=adicionar');
            exit;
        }

        require_once 'models/Item.php';

        if (Item::adicionar($titulo, $conteudo)) {
            $_SESSION['mensagem'] = "Item adicionado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao adicionar item.";
        }

        header('Location: index.php?pagina=lista');
        exit;
    }

    /**
     * Exibe formulário para editar
     */
    public function editar($id) {
        if (!Auth::temPermissao('editar')) {
            $_SESSION['mensagem'] = "Você não tem permissão para editar itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'models/Item.php';
        $item = Item::buscarPorId($id);

        if (!$item) {
            $_SESSION['mensagem'] = "Item não encontrado.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/formulario.php';
        renderizarFormulario($item);
    }

    /**
     * Atualiza um item
     */
    public function atualizar($id) {
        if (!Auth::temPermissao('editar')) {
            $_SESSION['mensagem'] = "Você não tem permissão para editar itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        $titulo = $_POST['titulo'] ?? '';
        $conteudo = $_POST['conteudo'] ?? '';

        if (empty($titulo) || empty($conteudo)) {
            $_SESSION['mensagem'] = "Todos os campos são obrigatórios.";
            header("Location: index.php?pagina=editar&id=$id");
            exit;
        }

        require_once 'models/Item.php';

        if (Item::atualizar($id, $titulo, $conteudo)) {
            $_SESSION['mensagem'] = "Item atualizado com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao atualizar item.";
        }

        header('Location: index.php?pagina=lista');
        exit;
    }

    /**
     * Confirma exclusão
     */
    public function confirmarExclusao($id) {
        if (!Auth::temPermissao('excluir')) {
            $_SESSION['mensagem'] = "Você não tem permissão para excluir itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'models/Item.php';
        $item = Item::buscarPorId($id);

        if (!$item) {
            $_SESSION['mensagem'] = "Item não encontrado.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'views/confirmar_exclusao.php';
        renderizarConfirmacaoExclusao($item);
    }

    /**
     * Exclui o item
     */
    public function excluir($id) {
        if (!Auth::temPermissao('excluir')) {
            $_SESSION['mensagem'] = "Você não tem permissão para excluir itens.";
            header('Location: index.php?pagina=lista');
            exit;
        }

        require_once 'models/Item.php';

        if (Item::excluir($id)) {
            $_SESSION['mensagem'] = "Item excluído com sucesso!";
        } else {
            $_SESSION['mensagem'] = "Erro ao excluir item.";
        }

        header('Location: index.php?pagina=lista');
        exit;
    }
}