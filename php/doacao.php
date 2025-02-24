<?php
class Doacao {
    private $valor;
    private $tipo;
    private $nome;
    private $sobrenome;
    private $cpf;
    private $email;
    private $numero;
    private $cesta_basica;
    private $alimentos;
    private $marmitas;

    public function __construct($data) {
        $this->valor = $data['valor'] ?? null;
        $this->tipo = $data['tipo'] ?? null;
        $this->nome = $data['nome'] ?? null;
        $this->sobrenome = $data['sobrenome'] ?? null;
        $this->cpf = $data['cpf'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->numero = $data['numero'] ?? null;
        $this->cesta_basica = $data['cesta_basica'] ?? null;
        $this->alimentos = $data['alimentos'] ?? null;
        $this->marmitas = $data['marmitas'] ?? null;
    }

    public function SalvarBD($pdo) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO doacoes (valor, tipo, nome, sobrenome, cpf, email, numero, cesta_basica, alimentos, marmitas)
                VALUES (:valor, :tipo, :nome, :sobrenome, :cpf, :email, :numero, :cesta_basica, :alimentos, :marmitas)
            ");

            $stmt->execute([
                ':valor' => $this->valor,
                ':tipo' => $this->tipo,
                ':nome' => $this->nome,
                ':sobrenome' => $this->sobrenome,
                ':cpf' => $this->cpf,
                ':email' => $this->email,
                ':numero' => $this->numero,
                ':cesta_basica' => $this->cesta_basica,
                ':alimentos' => $this->alimentos,
                ':marmitas' => $this->marmitas
            ]);

            echo "Doação salva com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao salvar doação: " . $e->getMessage();
        }
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Create a Doacao object with the form data
    $doacao = new Doacao($_POST);

    // Database connection
    $host = 'localhost';
    $dbname = 'doacoes_db';
    $username = 'root'; // Change to your MySQL username
    $password = ''; // Change to your MySQL password

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Save the donation to the database
        $doacao->SalvarBD($pdo);
    } catch (PDOException $e) {
        echo "Erro de conexão: " . $e->getMessage();
    }
}
?>