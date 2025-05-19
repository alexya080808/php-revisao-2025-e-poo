<?php
/**
 * View para confirmar exclusão de item
 */
function renderizarConfirmacaoExclusao($item) {
    exibirHeader('Confirmar Exclusão');
    
    echo "<h1>Confirmar Exclusão</h1>
    
    <p><strong>Atenção!</strong> Você está prestes a excluir este item. Esta ação não poderá ser desfeita.</p>
    
    <p><strong>ID:</strong> {$item['id']}</p>
    <p><strong>Título:</strong> " . htmlspecialchars($item['titulo']) . "</p>
    <p><strong>Conteúdo:</strong> " . nl2br(htmlspecialchars($item['conteudo'])) . "</p>
    
    <p>
        <a href='index.php?pagina=lista'>Cancelar</a> |
        <a href='index.php?pagina=excluir_confirmar&id={$item['id']}'>Sim, Excluir</a>
    </p>";
    
    exibirFooter();
}