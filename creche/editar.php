<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
    <title>Editar Usuário</title>
</head>
<body>
    <div class="container my-5">
        <h2>Editar Usuário</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "creche";

        $connection = new mysqli($servername, $username, $password, $database);

        if ($connection->connect_error) {
            die("Banco não encontrado: " . $connection->connect_error);
        }

        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM usuarios WHERE id = $id";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
               
                echo "
                <form action='/creche/editar.php' method='POST'>
                    <input type='hidden' name='id' value='$row[id]'>
                    <label for='nomeCompleto'>Nome Completo:</label>
                    <input type='text' id='nomeCompleto' name='nomeCompleto' value='$row[nomeCompleto]' required><br><br>
                    <label for='endereco'>Endereço:</label>
                    <input type='text' id='endereco' name='endereco' value='$row[endereco]' required><br><br>
                    <label for='telefone'>Telefone:</label>
                    <input type='text' id='telefone' name='telefone' value='$row[telefone]' required><br><br>
                    <label for='email'>Email:</label>
                    <input type='email' id='email' name='email' value='$row[email]' required><br><br>
                    <label for='tipoResponsavel'>Tipo Responsável:</label>
                    <input type='text' id='tipoResponsavel' name='tipoResponsavel' value='$row[tipoResponsavel]' required><br><br>
                    <label for='cpfCrianca'>CPF Criança:</label>
                    <input type='text' id='cpfCrianca' name='cpfCrianca' value='$row[cpfCrianca]' required><br><br>
                    <input type='submit' value='salvar' class='btn btn-primary'>
                </form>
                ";
            } else {
                echo "Usuário não encontrado.";
            }
        } else {
            header("location: /creche/index.php");
        }

        $connection->close();
        ?>
    </div>
</body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "creche";

$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Banco não encontrado: " . $connection->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nomeCompleto = $_POST['nomeCompleto'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $tipoResponsavel = $_POST['tipoResponsavel'];
    $cpfCrianca = $_POST['cpfCrianca'];

    $sql = "UPDATE usuarios SET 
            nomeCompleto = '$nomeCompleto', 
            endereco = '$endereco', 
            telefone = '$telefone', 
            email = '$email', 
            tipoResponsavel = '$tipoResponsavel', 
            cpfCrianca = '$cpfCrianca' 
            WHERE id = $id";

    if ($connection->query($sql) === TRUE) {
        header("Location: /creche/index.php"); // Redirecionar de volta para a página principal após a atualização
        exit();
    } else {
        echo "Erro ao atualizar usuário: " . $connection->error;
    }
}

$connection->close();
?>
