<?php
/**
 * View para visualizar um item
 */
function renderizarVisualizar($item) {
    exibirHeader('Visualizar Item #' . $item['id']);
    
    echo "<h1>Visualizar Item</h1>
    
    <p><strong>ID:</strong> {$item['id']}</p>
    <p><strong>Título:</strong> " . htmlspecialchars($item['titulo']) . "</p>
    <p><strong>Conteúdo:</strong> " . nl2br(htmlspecialchars($item['conteudo'])) . "</p>";
    
    echo "<p>
        <a href='index.php?pagina=lista'>Voltar</a>";
    
    if (Auth::temPermissao('editar')) {
        echo " | <a href='index.php?pagina=editar&id={$item['id']}'>Editar</a>";
    }
    
    if (Auth::temPermissao('excluir')) {
        echo " | <a href='index.php?pagina=excluir&id={$item['id']}'>Excluir</a>";
    }
    
    echo "</p>";
    
    exibirFooter();
}