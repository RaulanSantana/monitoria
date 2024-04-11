<?php
// Inicie a sessão
session_start();

// Verifica se as informações de nome e matrícula estão na sessão
if(isset($_SESSION['nome_pessoa']) && isset($_SESSION['matricula'])) {
    $nome_pessoa = $_SESSION['nome_pessoa'];
    $matricula = $_SESSION['matricula'];
} else {
    // Se as informações não estiverem na sessão vai redirecionar para o login
    header("Location: login.php");
    exit; 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="topo">
        <header>
            
            <h1>Bem vindo professor</h1>
            <h1><?php echo $nome_pessoa; ?></h1>
            <h1><?php echo $matricula; ?></h1>
        </header>
    </div>
    <main>
        <ul>
            <li>Inicio</li>
            <li>Perfil</li>
            <li><a href="testes.php">Monitorias</a></li>
        </ul>
    </main>
</body>
</html>
