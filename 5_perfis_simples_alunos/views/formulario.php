<?php
/**
 * View para formulário de adicionar/editar item
 */
function renderizarFormulario($item = null) {
    $acao = $item ? 'editar' : 'adicionar';
    $titulo = $item ? 'Editar Item' : 'Adicionar Item';
    $botao = $item ? 'Atualizar' : 'Salvar';
    
    exibirHeader($titulo);
    
    echo "<h1>$titulo</h1>
    
    <form method='post' action='index.php?pagina=" . ($item ? "atualizar&id={$item['id']}" : "salvar") . "'>
        <div>
            <label>Título:</label>
            <input type='text' name='titulo' value='" . ($item ? htmlspecialchars($item['titulo']) : '') . "' required>
        </div>
        <div>
            <label>Conteúdo:</label>
            <textarea name='conteudo' rows='5' cols='30' required>" . 
                ($item ? htmlspecialchars($item['conteudo']) : '') . 
            "</textarea>
        </div>
        <div>
            <button type='submit'>$botao</button>
            <a href='index.php?pagina=lista'>Cancelar</a>
        </div>
    </form>";
    
    exibirFooter();
}