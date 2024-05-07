<?php
// Classe Usuario
class Usuario {
    private $nomeCompleto;
    private $endereco;
    private $telefone;
    private $email;
    private $tipoResponsavel;
    private $cpfCrianca;

    public function __construct($nomeCompleto, $endereco, $telefone, $email, $tipoResponsavel, $cpfCrianca) {
        $this->nomeCompleto = $nomeCompleto;
        $this->endereco = $endereco;
        $this->telefone = $telefone;
        $this->setEmail($email);
        $this->setTipoResponsavel($tipoResponsavel);
        $this->setCpfCrianca($cpfCrianca);
    }

    public function getNomeCompleto() {
        return $this->nomeCompleto;
    }

    public function setNomeCompleto($nomeCompleto) {
        $this->nomeCompleto = $nomeCompleto;
    }

    public function getEndereco() {
        return $this->endereco;
    }

    public function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    public function getTelefone() {
        return $this->telefone;
    }

    public function setTelefone($telefone) {
        $this->telefone = $telefone;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        if (!$this->emailCadastradoNoBanco($email)) {
            $this->email = $email;
        } else {
            throw new Exception("O email já está cadastrado.");
        }
    }

    public function getTipoResponsavel() {
        return $this->tipoResponsavel;
    }

    public function setTipoResponsavel($tipoResponsavel) {
        $tiposValidos = array('mae', 'pai', 'outro');
        if (in_array($tipoResponsavel, $tiposValidos)) {
            $this->tipoResponsavel = $tipoResponsavel;
        } else {
            throw new Exception("Tipo de responsável inválido.");
        }
    }

    public function getCpfCrianca() {
        return $this->cpfCrianca;
    }

    public function setCpfCrianca($cpfCrianca) {
        if ($cpfCrianca === null || strlen($cpfCrianca) == 11) {
            $this->cpfCrianca = $cpfCrianca;
        } else {
            throw new Exception("CPF da criança deve ter 11 dígitos.");
        }
    }

    private function emailCadastradoNoBanco($email) {
        return false;
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "creche";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nomeCompleto VARCHAR(100) NOT NULL,
        endereco VARCHAR(255) NOT NULL,
        telefone VARCHAR(20) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        tipoResponsavel ENUM('mae', 'pai', 'outro') NOT NULL,
        cpfCrianca VARCHAR(11),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $conn->exec($sql);
    echo "Tabela 'usuarios' criada com sucesso.";

} catch(PDOException $e) {
    echo "Erro ao criar a tabela: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Cadastro de Usuário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function mostrarCPF() {
            var tipoResponsavel = document.getElementById("tipoResponsavel").value;
            var campoCPF = document.getElementById("campoCPF");
            
            if (tipoResponsavel === "pai" || tipoResponsavel === "mae") {
                campoCPF.style.display = "block";
                campoCPF.required = true;
            } else {
                campoCPF.style.display = "none";
                campoCPF.required = false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Formulário de Cadastro de Usuário</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="mb-3">
                <label for="nomeCompleto" class="form-label">Nome Completo:</label>
                <input type="text" class="form-control" id="nomeCompleto" name="nomeCompleto" required>
            </div>
            <div class="mb-3">
                <label for="endereco" class="form-label">Endereço:</label>
                <input type="text" class="form-control" id="endereco" name="endereco" required>
            </div>
            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone:</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="tipoResponsavel" class="form-label">Tipo de Responsável:</label>
                <select id="tipoResponsavel" name="tipoResponsavel" class="form-select" onchange="mostrarCPF()" required>
                    <option value="">Selecione</option>
                    <option value="mae">Mãe</option>
                    <option value="pai">Pai</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
            <div id="campoCPF" style="display: none;">
                <div class="mb-3">
                    <label for="cpfCrianca" class="form-label">CPF da Criança:</label>
                    <input type="text" class="form-control" id="cpfCrianca" name="cpfCrianca">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
    <!-- Bootstrap Bundle JS (Popper included) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nomeCompleto'], $_POST['endereco'], $_POST['telefone'], $_POST['email'], $_POST['tipoResponsavel'])) {
        $nomeCompleto = $_POST['nomeCompleto'];
        $endereco = $_POST['endereco'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $tipoResponsavel = $_POST['tipoResponsavel'];
        $cpfCrianca = isset($_POST['cpfCrianca']) ? $_POST['cpfCrianca'] : null;

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("INSERT INTO usuarios (nomeCompleto, endereco, telefone, email, tipoResponsavel, cpfCrianca) VALUES (:nomeCompleto, :endereco, :telefone, :email, :tipoResponsavel, :cpfCrianca)");

            // Se o tipo de responsável for pai ou mãe, o CPF da criança será inserido
            if ($tipoResponsavel === "pai" || $tipoResponsavel === "mae") {
                // Verifica se o CPF da criança foi fornecido
                if ($cpfCrianca !== null && strlen($cpfCrianca) == 11) {
                    $stmt->bindParam(':cpfCrianca', $cpfCrianca);
                } else {
                    throw new Exception("CPF da criança é obrigatório para pai ou mãe.");
                }
            } else {
                // Se o tipo de responsável for outro, o campo CPF da criança será NULL
                $stmt->bindValue(':cpfCrianca', null, PDO::PARAM_NULL);
            }

            $stmt->bindParam(':nomeCompleto', $nomeCompleto);
            $stmt->bindParam(':endereco', $endereco);
            $stmt->bindParam(':telefone', $telefone);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':tipoResponsavel', $tipoResponsavel);
            $stmt->execute();

            echo "Usuário cadastrado com sucesso!";

            header("location:/creche/formulario_creche.php");
            
        } catch(PDOException $e) {
            echo "Erro ao cadastrar usuário: " . $e->getMessage();
        }
        $conn = null;
    } else {
        echo "Todos os campos do formulário devem ser preenchidos.";
    }
}
?>
