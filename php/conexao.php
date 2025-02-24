<?php
$host = 'localhost'; // MySQL host
$username = 'root'; // MySQL username
$password = ''; // MySQL password

try {
    // Connect to MySQL without selecting a database
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create the database if it doesn't exist
    $dbname = 'prato_cheio';
    $pdo->exec("CREATE DATABASE IF NOT EXISTS $dbname");
    echo "Banco de dados '$dbname' criado ou já existente.<br>";

    // Switch to the database
    $pdo->exec("USE $dbname");

    // Create the `usuarios` table if it doesn't exist
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            cpf VARCHAR(14) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            numero VARCHAR(20) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    echo "Tabela 'usuarios' criada ou já existente.<br>";

    // Optional: Add sample data (for testing)
    $stmt = $pdo->prepare("
        INSERT INTO usuarios (nome, cpf, senha, numero)
        VALUES (:nome, :cpf, :senha, :numero)
    ");

    // Sample data
    $sampleData = [
        ['nome' => 'João Silva', 'cpf' => '12345678901', 'senha' => password_hash('senha123', PASSWORD_DEFAULT), 'numero' => '11987654321'],
        ['nome' => 'Maria Oliveira', 'cpf' => '98765432109', 'senha' => password_hash('senha456', PASSWORD_DEFAULT), 'numero' => '21987654321']
    ];

    // Insert sample data
    foreach ($sampleData as $data) {
        $stmt->execute($data);
    }
    echo "Dados de exemplo inseridos na tabela 'usuarios'.<br>";

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
