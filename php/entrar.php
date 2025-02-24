<?php
class Login {
    protected $cpf;
    protected $senha;

    public function __construct() {
        $this->cpf = $_POST["cpf"];
        $this->senha = $_POST["senha"];
    }

    public function TryLogin() {
        $host = 'localhost'; // MySQL host
        $dbname = 'prato_cheio'; // Database name
        $username = 'root'; // MySQL username
        $password = ''; // MySQL password

        try {
            // Connect to the database
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query to fetch user data based on CPF
            $sql = "SELECT * FROM usuarios WHERE cpf = :cpf";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->execute();

            // Fetch the user record
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Verify the password
                if (password_verify($this->senha, $user['senha'])) {
                    return true; // Login successful
                }
            }

            return false; // Login failed
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            return false;
        }
    }
}

// Handle login attempt
$trylogin = new Login();
if ($trylogin->TryLogin()) {
    header("Location: ../index.html");
    exit();
} else {
    echo '
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../estilo.css">
        <title>Erro de Login</title>
    </head>
    <body>
        <img class="blue" src="../imgs/Captura de tela de 2025-02-12 00-12-14.png" alt="">
        <h2 class="o">Bem-Vindo de volta ao Prato cheio</h2>

        <div class="numsei">
            <form id="formLogin" method="post" action="../entrar.html">
                <h2>Sua senha ou CPF estão incorretos, tente novamente.</h2>
                <button type="submit" class="cada">Tentar novamente</button>
            </form>
            <img class="logi" src="../imgs/Prato_Cheio2-removebg-preview.png" alt="">
        </div>
    </body>';
}
?>