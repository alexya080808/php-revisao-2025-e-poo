<?php
<!-- 1ª Digitação (Aqui) -->

abstract class Veiculo {
    protected string $titulo;
    protected string $codigo;
    protected string $disponivel;

    public function __construct($titulo, $codigo) {
            $this->titulo = $titulo;
            $this->codigo = $codigo;
            $this->disponivel = true;

    }
}
?>    