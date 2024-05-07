<?php

class Crianca {
    private $nomeCompleto;
    private $turma;
    private $numeroMatricula;
    private $pessoaResponsavel;
    private $cpf;

    
    public function __construct($nomeCompleto, $turma, $numeroMatricula, $pessoaResponsavel, $cpf) {
        $this->nomeCompleto = $nomeCompleto;
        $this->turma = $turma;
        $this->numeroMatricula = $numeroMatricula;
        $this->pessoaResponsavel = $pessoaResponsavel;
        $this->cpf = $cpf;
    }

    
    public function exibirInformacoes() {
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h5 class='card-title'>Nome Completo: " . $this->nomeCompleto . "</h5>";
        echo "<p class='card-text'>Turma: " . $this->turma . "</p>";
        echo "<p class='card-text'>Número de Matrícula: " . $this->numeroMatricula . "</p>";
        echo "<p class='card-text'>Pessoa Responsável: " . $this->pessoaResponsavel . "</p>";
        echo "<p class='card-text'>CPF: " . $this->cpf . "</p>";
        echo "</div>";
        echo "</div>";
    }
}


$crianca1 = new Crianca("Maria Silva", "Infantil I", "123456", "João Silva", "123.456.789-00");
$crianca2 = new Crianca("Pedro Souza", "Infantil II", "789012", "Ana Souza", "987.654.321-00");


echo "<div class='container'>";
echo "<div class='row'>";
echo "<div class='col'>";
echo "<h2>Informações da Criança 1:</h2>";
$crianca1->exibirInformacoes();
echo "</div>";
echo "<div class='col'>";
echo "<h2>Informações da Criança 2:</h2>";
$crianca2->exibirInformacoes();
echo "</div>";
echo "</div>";
echo "</div>";

?>
