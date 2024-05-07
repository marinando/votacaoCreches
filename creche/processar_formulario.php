<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (!empty($_POST['pergunta1']) && !empty($_POST['pergunta2']) && !empty($_POST['pergunta3']) && !empty($_POST['pergunta4']) && !empty($_POST['seguranca']) && !empty($_POST['atendimento'])) {
        
        
        $pergunta1 = $_POST['pergunta1'];
        $creche_anterior = !empty($_POST['creche_anterior']) ? $_POST['creche_anterior'] : "";
        $pergunta2 = $_POST['pergunta2'];
        $alergia = !empty($_POST['alergia']) ? $_POST['alergia'] : "";
        $pergunta3 = $_POST['pergunta3'];
        $necessidade_especial = !empty($_POST['necessidade_especial']) ? $_POST['necessidade_especial'] : "";
        $pergunta4 = $_POST['pergunta4'];
        $seguranca = $_POST['seguranca'];
        $atendimento = $_POST['atendimento'];
        $comentario = !empty($_POST['comentario']) ? $_POST['comentario'] : "";

        

        echo "<h2>Dados Recebidos:</h2>";
        echo "<p>Seu filho(a) já frequentou alguma creche anteriormente? Resposta: $pergunta1</p>";
        if (!empty($creche_anterior)) {
            echo "<p>Nome da creche anterior: $creche_anterior</p>";
        }
        echo "<p>Seu filho(a) possui algum tipo de alergia? Resposta: $pergunta2</p>";
        if (!empty($alergia)) {
            echo "<p>Tipo de alergia: $alergia</p>";
        }
        echo "<p>Seu filho(a) possui alguma necessidade especial? Resposta: $pergunta3</p>";
        if (!empty($necessidade_especial)) {
            echo "<p>Necessidade especial: $necessidade_especial</p>";
        }
        echo "<p>Seu filho(a) está com todas as vacinas em dia? Resposta: $pergunta4</p>";
        echo "<p>Avaliação da segurança: $seguranca</p>";
        echo "<p>Avaliação do atendimento: $atendimento</p>";
        if (!empty($comentario)) {
            echo "<p>Comentário adicional: $comentario</p>";
        }
    } else {
        echo "<p>Por favor, preencha todos os campos obrigatórios.</p>";
    }
}
?>
