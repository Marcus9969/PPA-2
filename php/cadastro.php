<?php


class cadastrado {
    protected $nome;
    protected $cpf;
    protected $senha;
    protected $numero;

    public function __construct() {
        $this->nome = $_POST["nome"];
        $this->cpf = $_POST["cpf"];
        $this->senha = $_POST["senha"];
        $this->numero = $_POST["tel"];
    }

    public function imprimir() {
        echo '<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilo.css">
    <title>Cadastro</title>
</head>
<body>
<img  class="blue" src="../imgs/Captura de tela de 2025-02-12 00-12-14.png" alt="">

<h1 class="o">Bem-Vindo ao Prato cheio</h1>
    <div class="numsei">
            
        <h1>Cadastrado com sucesso</h1>

        <h2>Bem vindo ' . $this->nome . '</h2>

        <form id="formCadastro" action="../index.html">
            <button type="submit" class="cada">Continuar</button>
        </form>

        <img class="logi" src="../imgs/Prato_Cheio2-removebg-preview.png" alt="">
    </div>

</body>';
    }

    public function EnviarParaBD() {
        $host = 'localhost'; // Host do banco de dados
        $dbname = 'prato_cheio'; // Nome do banco de dados
        $username = 'root'; // Nome de usuário do banco de dados
        $password = ''; // Senha do banco de dados

        try {
            // Conexão com o banco de dados usando PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query para inserir os dados na tabela
            $sql = "INSERT INTO usuarios (nome, cpf, senha, numero) VALUES (:nome, :cpf, :senha, :numero)";
            $stmt = $pdo->prepare($sql);

            // Bind dos parâmetros
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':cpf', $this->cpf);
            $stmt->bindParam(':senha', $this->senha);
            $stmt->bindParam(':numero', $this->numero);

            // Executa a query
            $stmt->execute();

            echo "Dados enviados para o banco de dados com sucesso!";
        } catch (PDOException $e) {
            echo "Erro ao enviar dados para o banco de dados: " . $e->getMessage();
        }
    }
}

$newuser = new cadastrado();
$newuser->EnviarParaBD();
$newuser->imprimir();
