<?php
$conn = new mysqli("localhost", "root", "", "prato_cheio");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Função para cadastrar usuário
function cadastrarUsuario($nome, $senha, $cpf, $numero) {
    global $conn;
    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuarios (nome, senha, cpf, numero) 
            VALUES (?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $senha_hash, $cpf, $numero);
    
    return $stmt->execute();
}

// Função para login
function loginUsuario($nome, $senha) {
    global $conn;
    
    $sql = "SELECT * FROM usuarios WHERE nome = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        if (password_verify($senha, $row['senha'])) {
            session_start();
            $_SESSION['usuario_id'] = $row['id'];
            $_SESSION['usuario_nome'] = $row['nome'];
            return true;
        }
    }
    return false;
}

// Função para buscar dados do usuário
function getDadosUsuario($id) {
    global $conn;
    
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    
    return $stmt->get_result()->fetch_assoc();
}
?>
