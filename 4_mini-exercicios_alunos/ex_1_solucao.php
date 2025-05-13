<?php
// 1ª Digitação (Aqui) -->

abstract class ItemBiblioteca {
    protected string $titulo;
    protected string $codigo;
    protected string $disponivel;

    public function __construct($titulo, $codigo) {
            $this->titulo = $titulo;
            $this->codigo = $codigo;
            $this->disponivel = true;

    }
    
    abstract public function calcularMulta(int $diasAtraso) : float;

    public function emprestar(): string{
    if ($this->disponivel) {
        $this->disponivel = false;
        return "Item '{$this->titulo}' emprestado com sucesso!";
    }
        return "Item '{$this->titulo}' não está disponível!";
    
    }

    public function devolver(): string{
        if ($this->disponivel) {
            $this->disponivel = true;
            return "Item '{$this->titulo}' devolvido com sucesso!";
        }
            return "Item '{$this->titulo}' já está a biblioteca!";
        
        }

        public function getTitulo(): string {
            return $this->titulo;
        }

    }

      //Classes Concretas 
      class Livro extends ItemBiblioteca {
        public function calcularMulta(int $diasAtraso): float
        {
            return $diasAtraso * 0.50;
        }
      }

      class Revista extends ItemBiblioteca {
        public function calcularMulta(int $diasAtraso): float
        {
            return $diasAtraso * 0.25;
        }
      }

    //Classe gerenciadora
      class Biblioteca {
        private array $itens =[];

        //Métodos para gerenciar (adicionar, emprestar e devoler)

        public function adicionarItem(ItemBiblioteca$item): string {
                $this->itens[$item->getTitulo()]=$item; 
                return "Item '{$item->getTitulo()}' adicionado ao acervo!";
           
      }
       // "?" = Ternário
      public function emprestarItens(string $titulo): string {
        return isset($this->itens[$titulo]) ? $this->itens[$titulo]
        ->emprestar():"Item não encontrado.";
      }
        public function devolverItem(string $titulo): string {
        return isset($this->itens[$titulo]) ? $this->itens[$titulo]->devolver():"Item não encontrado.";
        }
    }
    
    // Criando um Objeto/ Instância
    $biblioteca = new Biblioteca();
    
    // Criando itens (1 livro e 1 revista)
    $livro1 = new Livro ("Python para Iniciantes", "L001");
    $revista1 = new Revista ("TechNews", "R001");

    //Adicionar itens à biblioteca e exibir 
    echo $biblioteca->adicionarItem($livro1) . "<br>";
    echo $biblioteca->adicionarItem($revista1) . "<br><br>";

    //Testando empréstimos 
    echo $biblioteca->emprestarItens("Python para Iniciantes") . "<br>";
    echo $biblioteca->emprestarItens("TechNews") . "<br><br>";

    //Testando devolução
    echo $biblioteca->devolverItem("Python para Iniciantes") . "<br><br>";

    //Calcular multa atraso para 5 dias
    echo "Multa da Revista (5 dias): R$" . number_format($revista1->calcularMulta(5), 2) . "<br><br>";
    echo "Multa da Livro (5 dias): R$" . number_format($livro1->calcularMulta(5), 2) . "<br><br>";


?>