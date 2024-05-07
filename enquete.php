<?php

// Classe Enquete para gerenciar a enquete
class Enquete {
    private $pergunta;
    private $opcoes;
    private $votos;

    public function __construct($pergunta, $opcoes) {
        $this->pergunta = $pergunta;
        $this->opcoes = $opcoes;
        $this->votos = array_fill_keys($opcoes, 0);
    }

    public function getPergunta() {
        return $this->pergunta;
    }

    public function getOpcoes() {
        return $this->opcoes;
    }

    public function votar($opcao) {
        if (array_key_exists($opcao, $this->votos)) {
            $this->votos[$opcao]++;
        } else {
            throw new Exception("Opção inválida.");
        }
    }

    public function totalVotos() {
        return array_sum($this->votos);
    }

    public function resultadoPercentual() {
        $totalVotos = $this->totalVotos();
        $resultadoPercentual = [];

        foreach ($this->votos as $opcao => $votos) {
            if ($totalVotos > 0) {
                $percentual = ($votos / $totalVotos) * 100;
            } else {
                $percentual = 0;
            }
            $resultadoPercentual[$opcao] = round($percentual, 2);
        }

        return $resultadoPercentual;
    }
}

// Função para gerar o gráfico de barras dos votos em percentagem
function gerarGrafico($dados) {
    echo "<div style='margin-bottom: 20px;'>";
    foreach ($dados as $opcao => $percentual) {
        echo "<div style='display: flex; align-items: center; margin-bottom: 10px;'>";
        echo "<div style='width: 100px; text-align: right;'>$opcao:</div>";
        echo "<div style='flex-grow: 1; background-color: lightblue; height: 20px; margin-left: 10px;'>";
        echo "<div style='background-color: blue; height: 100%; width: {$percentual}%;'></div>";
        echo "</div>";
        echo "<div style='margin-left: 10px;'>{$percentual}%</div>";
        echo "</div>";
    }
    echo "</div>";
}

// Criar uma nova enquete
$enquete = new Enquete("Qual é a sua cor favorita?", ["Vermelho", "Azul", "Verde"]);

// Verificar se há votos submetidos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se a opção selecionada está presente no formulário
    if (isset($_POST['voto']) && in_array($_POST['voto'], $enquete->getOpcoes())) {
        // Registrar o voto
        $enquete->votar($_POST['voto']);
        echo "<p>Voto registrado com sucesso!</p>";
    } else {
        echo "<p>Voto inválido.</p>";
    }
}

// Exibir a pergunta da enquete e opções de resposta
echo "<h2>" . $enquete->getPergunta() . "</h2>";
echo "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";

foreach ($enquete->getOpcoes() as $opcao) {
    echo "<input type='radio' name='voto' value='$opcao'> $opcao<br>";
}

echo "<button type='submit'>Votar</button>";
echo "</form>";

// Exibir resultado da enquete em percentagem
echo "<h3>Resultado:</h3>";
$resultadoPercentual = $enquete->resultadoPercentual();
gerarGrafico($resultadoPercentual);
?>
