<?php
session_start();
require_once 'conexao.php';

$pontos = 0;
if(isset($_SESSION['usuario_id'])) {
    $stmt = $pdo->prepare("SELECT pontos FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $pontos = $stmt->fetchColumn();
}
?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <!-- ... seus metas e links existentes ... -->
    <link rel="stylesheet" href="animations.css">
</head>
<body>
    <header class="animate-slideDown">
        <img src="Prato_Cheio2-removebg-preview.png" alt="" class="icon2 animate-spin">
        <h2 class="points animate-pulse">
            Total de pontos: <?php echo $pontos; ?>
        </h2>
        <?php if(!isset($_SESSION['usuario_id'])): ?>
            <a href="cadastro.php">
                <button class="cad animate-float">Cadastre-Se</button>
            </a>
            <a href="login.php">
                <button class="entrar animate-float">Entrar</button>
            </a>
        <?php else: ?>
            <a href="logout.php">
                <button class="entrar animate-float">Sair</button>
            </a>
        <?php endif; ?>
    </header>   

    <!-- ... resto do seu HTML ... -->
</body>
</html> 