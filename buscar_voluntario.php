<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prato_cheio";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Pega o CPF da query string
    $cpf = isset($_GET['cpf']) ? $_GET['cpf'] : '';
    
    if(empty($cpf)) {
        echo json_encode(["error" => "CPF não fornecido"]);
        exit;
    }
    
    $sql = "SELECT * FROM voluntarios WHERE cpf = :cpf";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();
    
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($resultado) {
        echo json_encode($resultado);
    } else {
        echo json_encode(["error" => "Voluntário não encontrado"]);
    }
    
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$conn = null;
?> 