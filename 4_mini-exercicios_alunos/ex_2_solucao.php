<?php

 //1ª Digitação (Aqui) -->

abstract class Veiculo {
    protected string $modelo;
    protected string $placa;
    protected string $disponivel;

    public function __construct($modelo, $placa) {
            $this->modelo = $modelo;
            $this->placa = $placa;
            $this->disponivel = true;

    }
    abstract public function calcularAluguel(int $dias) : float;

    public function getModelo(): string {
        return $this->modelo;
    } 

    public function Alugar(): string{
    if ($this->disponivel) {
        $this->disponivel = false;
        return "Item '{$this->modelo}' alugado com sucesso!";
    }
        return "Item '{$this->modelo}' não está disponível!";
    
    }

    public function devolver(): string{
        if ($this->disponivel) {
            $this->disponivel = true;
            return "Item '{$this->modelo}' devolvido com sucesso!";
        }
            return "Item '{$this->modelo}' já está disponível para o aluguel!";
        
        }

    }

      //Classes Concretas 
      class Carro extends Veiculo {
        public function calcularAluguel(int $diasAtraso): float
        {
            return $diasAtraso * 100;
        }
      }

      class Moto extends Veiculo {
        public function calcularAluguel(int $diasAtraso): float
        {
            return $diasAtraso * 50;
        }
      }

    //Classe gerenciadora
      class Locadora {
        private array $itens =[];

        //Métodos para gerenciar (adicionar, emprestar e devoler)

        public function adicionarVeiculo(Veiculo$item): string {
                $this->itens[$item->getModelo()]=$item; 
                return "Item '{$item->getModelo()}' adicionado ao acervo!";
           
      }
       // "?" = Ternário

        public function alugarVeiculo(string $titulo): string {
        return isset($this->itens[$titulo]) ? $this->itens[$titulo]->alugar():"Item não encontrado.";
        }

        public function devolverVeiculo(string $titulo): string {
            return isset($this->itens[$titulo]) ? $this->itens[$titulo]->devolver():"Item não encontrado.";
            }
    }
    
    // Criando um Objeto/ Instância
    $Locadora = new Locadora();
    
    // Criando itens (1 livro e 1 revista)
    $Carro1 = new Carro ("Impala 97", "KAZ-2Y5");
    $Moto1 = new Moto ("Royal enfield", "ELF-8188");

    //Adicionar itens à biblioteca e exibir 
    echo $Locadora->adicionarVeiculo($Carro1) . "<br>";
    echo $Locadora->adicionarVeiculo($Moto1) . "<br><br>";

    //Testando empréstimos 
    echo $Locadora->alugarVeiculo("Impala 97") . "<br>";
    echo $Locadora->alugarVeiculo("Royal enfield") . "<br><br>";

    //Testando devolução
    echo $Locadora->devolverVeiculo("Royal enfield") . "<br><br>";

    //Calcular multa atraso para 5 dias
    echo "Multa da Moto (3 dias): R$" . number_format($Moto1->calcularAluguel(3), 2) . "<br><br>";
    echo "Multa do Carro (10 dias): R$" . number_format($Carro1->calcularAluguel(10), 2) . "<br><br>";


?>    