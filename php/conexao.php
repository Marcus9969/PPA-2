<?php
$host = 'localhost';
$username = 'root'; // Change to your MySQL username
$password = ''; // Change to your MySQL password

try {
    // Connect to MySQL without selecting a database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $dbname = 'doacoes_db';
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Banco de dados '$dbname' criado ou já existente.<br>";

    // Switch to the database
    $pdo->exec("USE $dbname");

    // Create the table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS doacoes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            valor DECIMAL(10, 2) NOT NULL,
            tipo ENUM('individual', 'mensal') NOT NULL,
            nome VARCHAR(100) NOT NULL,
            sobrenome VARCHAR(100) NOT NULL,
            cpf VARCHAR(14) NOT NULL,
            email VARCHAR(100) NOT NULL,
            numero VARCHAR(20) NOT NULL,
            cesta_basica INT DEFAULT 0,
            alimentos INT DEFAULT 0,
            marmitas INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela 'doacoes' criada ou já existente.<br>";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>