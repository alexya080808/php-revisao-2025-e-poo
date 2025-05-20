<!-- 5ª Digitação (Aqui)
Este arquivo será o responsável por: (Página de listagem dos itens) -->

<?php 
/**
 * View para listar todos os itens
 */

 function renderizarLista($itens) {
    exibirHeader('Lista de Itens');

    echo"<h1>Lista de Itens</h1>";

    if (Auth::temPermissao('adicionar')) {
        echo "<p><a href='index.php?pagina=adicionar'>Adicionar Novo</a></p>";
    }

    if (empty($itens)) {
        echo "<p>Nenhum itens encontrado.</p>";
    } else {
        echo "<table border='1'>
            <tr>
                 <th>ID</th>
                 <th>Título</th>
                 <th>Ações</th>
            <tr>";
        foreach ($itens as $item) {
            echo "<tr>
                <td>{$item['id']}</td>
                <td>" . htmlspecialchars($item['titulo']) . "</td>
            <td>";

            echo "<a href='index.php?pagina=visualizar&id={$item['id']}'>Ver</a>";

            if (Auth::temPermissao('editar')) {
                echo " | <a href= 'index.php?pagina=editar&id={$item['id']}'>Editar</a>";
            }

            if (Auth::temPermissao('excluir')) {
                echo " | <a href= 'index.php?pagina=excluir&id={$item['id']}'>Excluir</a>";
            }

            echo "</td>
                </tr>";
        }
        echo "</table";
    }
    exibirFooter();
 }

 ?>