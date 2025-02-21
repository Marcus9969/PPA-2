<?php
// Habilita exibição de erros
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Configuração do banco de dados
$servername = "localhost";
$username = "root";  // seu usuário do MySQL
$password = "";      // sua senha do MySQL
$dbname = "prato_cheio";

try {
    // Tenta conectar ao banco
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Debug dos dados recebidos
    echo "Dados recebidos: \n";
    print_r($_POST);

    // Pega os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $disponibilidade = $_POST['disponibilidade'];
    
    // SQL com debug
    $sql = "INSERT INTO voluntarios (nome, email, telefone, disponibilidade, data_cadastro) 
            VALUES (:nome, :email, :telefone, :disponibilidade, NOW())";
    
    echo "\nSQL: " . $sql;
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':disponibilidade', $disponibilidade);
    
    $stmt->execute();
    echo "\nSucesso! Dados inseridos.";
    
} catch(PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
?> 