<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário para Creche</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Formulário para Creche</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <p>1. Seu filho(a) já frequentou alguma creche anteriormente?</p>
                <input type="radio" name="pergunta1" value="sim"> Sim
                <input type="radio" name="pergunta1" value="nao"> Não
            </div>
            <div class="mb-3">
                <p>2. Se sim, qual o nome da creche?</p>
                <input type="text" name="creche_anterior">
            </div>
            <div class="mb-3">
                <p>3. Seu filho(a) possui algum tipo de alergia?</p>
                <input type="radio" name="pergunta2" value="sim"> Sim
                <input type="radio" name="pergunta2" value="nao"> Não
            </div>
            <div class="mb-3">
                <p>4. Se sim, qual?</p>
                <input type="text" name="alergia">
            </div>
            <div class="mb-3">
                <p>5. Seu filho(a) possui alguma necessidade especial?</p>
                <input type="radio" name="pergunta3" value="sim"> Sim
                <input type="radio" name="pergunta3" value="nao"> Não
            </div>
            <div class="mb-3">
                <p>6. Se sim, qual?</p>
                <input type="text" name="necessidade_especial">
            </div>
            <div class="mb-3">
                <p>7. Seu filho(a) está com todas as vacinas em dia?</p>
                <input type="radio" name="pergunta4" value="sim"> Sim
                <input type="radio" name="pergunta4" value="nao"> Não
            </div>
            <div class="mb-3">
                <p>8. Como você avalia a segurança da creche?</p>
                <select name="seguranca">
                    <option value="">Selecione</option>
                    <option value="excelente">Excelente</option>
                    <option value="boa">Boa</option>
                    <option value="regular">Regular</option>
                    <option value="ruim">Ruim</option>
                </select>
            </div>
            <div class="mb-3">
                <p>9. Como você avalia o atendimento na creche?</p>
                <select name="atendimento">
                    <option value="">Selecione</option>
                    <option value="excelente">Excelente</option>
                    <option value="bom">Bom</option>
                    <option value="regular">Regular</option>
                    <option value="ruim">Ruim</option>
                </select>
            </div>
            <div class="mb-3">
                <p>Deixe aqui seus comentários adicionais:</p>
                <textarea name="comentario" rows="4" cols="50"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
    <!-- Bootstrap Bundle JS (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <?php
    // Verifica se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Configurações do banco de dados
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "creche";

        try {
            // Conexão com o banco de dados
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepara a instrução SQL para inserir os dados do formulário
            $stmt = $conn->prepare("INSERT INTO formulario_creche (pergunta1, creche_anterior, pergunta2, alergia, pergunta3, necessidade_especial, pergunta4, seguranca, atendimento, comentario) VALUES (:pergunta1, :creche_anterior, :pergunta2, :alergia, :pergunta3, :necessidade_especial, :pergunta4, :seguranca, :atendimento, :comentario)");

            // Bind dos parâmetros
            $stmt->bindParam(':pergunta1', $_POST['pergunta1']);
            $stmt->bindParam(':creche_anterior', $_POST['creche_anterior']);
            $stmt->bindParam(':pergunta2', $_POST['pergunta2']);
            $stmt->bindParam(':alergia', $_POST['alergia']);
            $stmt->bindParam(':pergunta3', $_POST['pergunta3']);
            $stmt->bindParam(':necessidade_especial', $_POST['necessidade_especial']);
            $stmt->bindParam(':pergunta4', $_POST['pergunta4']);
            $stmt->bindParam(':seguranca', $_POST['seguranca']);
            $stmt->bindParam(':atendimento', $_POST['atendimento']);
            $stmt->bindParam(':comentario', $_POST['comentario']);

            // Executa a instrução SQL
            $stmt->execute();

            echo "<p class='mt-3'>Dados do formulário foram enviados com sucesso!</p>";
        } catch(PDOException $e) {
            echo "<p class='mt-3'>Erro ao enviar dados do formulário: " . $e->getMessage() . "</p>";
        }

        // Fecha a conexão com o banco de dados
        $conn = null;
    }
    ?>
</body>
</html>
