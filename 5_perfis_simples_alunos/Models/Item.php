<!-- 4ª Digitação (Aqui)
Este arquivo será o responsável por: (Modelo para gerenciar itens) -->

<?php
/**
 * Modelo para gerenciar itens
 */
class Item {
    /**
     * Busca todos os itens
     */
    public static function buscarTodos() {
        $conn = conectarBD();
        $query = "SELECT * FROM itens ORDER BY id ASC";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Busca um item pelo ID
     */
    public static function buscarPorId($id) {
        $conn = conectarBD();
        $query = "SELECT * FROM itens WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    /**
     * Adiciona um novo item
     */
    public static function adicionar($titulo, $conteudo) {
        $conn = conectarBD();
        $query = "INSERT INTO itens (titulo, conteudo) VALUES (:titulo, :conteudo)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            'titulo' => $titulo,
            'conteudo' => $conteudo
        ]);
    }

    /**
     * Atualiza um item existente
     */
    public static function atualizar($id, $titulo, $conteudo) {
        $conn = conectarBD();
        $query = "UPDATE itens SET titulo = :titulo, conteudo = :conteudo WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute([
            'id' => $id,
            'titulo' => $titulo,
            'conteudo' => $conteudo
        ]);
    }

    /**
     * Exclui um item
     */
    public static function excluir($id) {
        $conn = conectarBD();
        $query = "DELETE FROM itens WHERE id = :id";
        $stmt = $conn->prepare($query);
        return $stmt->execute(['id' => $id]);
    }
}

?>