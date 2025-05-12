<?php
// 1ª Digitação (Aqui) -->

class ItemBiblioteca {
    private $titulo;
    private $codigo;
    private $disponivel;

    public function __construct($titulo, $codigo, $disponivel) {
            $this->titulo = $titulo;
            $this->codigo = $codigo;
            $this->disponivel = $disponivel;

    }
    
  //  public function comer () {
  //      $this->comida -= 1;
   // }

    public function alugar () {
        $this->disponivel = false;
    }

    //Getters e Setters (Comuns no PHP)
    public function getTitulo(){
        return $this->titulo;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function getDisponivel(){
        return $this->disponivel;
    }
}