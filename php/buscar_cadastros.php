<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prato_cheio";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "SELECT * FROM voluntarios ORDER BY data_cadastro DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($resultados);
    
} catch(PDOException $e) {
    echo json_encode(["error" => $e->getMessage()]);
}

$conn = null;
?> 