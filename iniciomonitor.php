<?php
// Inclua o arquivo de configuração para obter a conexão com o banco de dados
include_once('config.php');

// Inicie a sessão
session_start();

// Verifique se as informações de nome e matrícula estão na sessão
if(isset($_SESSION['nome_pessoa']) && isset($_SESSION['matricula'])) {
    $nome_pessoa = $_SESSION['nome_pessoa'];
    $matricula = $_SESSION['matricula'];
} else {
    // Se as informações não estiverem na sessão, redirecione para a página de login
    header("Location: login.php");
    exit; 
}

// Suponha que a monitoria não esteja preenchida inicialmente
$monitoria_preenchida = false;

// Recupere o ID da pessoa (monitor) a partir da sessão
$id_pessoa = $_SESSION['id_pessoa'];

// Consulta ao banco de dados para verificar se existem registros na tabela monitorias associados ao monitor atual
$query = "SELECT * FROM monitoria WHERE monitoria_monitor = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "i", $id_pessoa);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Array para armazenar os dados das monitorias
$monitorias = array();



if($result) {
    while($row = mysqli_fetch_assoc($result)) {
        // Adicione os dados da monitoria ao array
        $monitorias[] = $row;
    }
}

// Verifique se há pelo menos uma monitoria cadastrada para o monitor atual
if(count($monitorias) > 0) {
    $monitoria_preenchida = true;
}

// Feche a conexão com o banco de dados
mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Monitor</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>

<div class="header" id="header">
    <p id="nomePessoa"><?php echo ucwords($nome_pessoa); ?></p>
    <p id="matricula">Matricula: <?php echo $matricula; ?></p>
</div>

<aside id="menuLateral" class="menuLateral">
    <div class="logo_header">
        <img src="images/logo.png" width="160" height="80">
    </div>
    <div id="listaMenu" class="listaMenu">
        <a href="javascript:void(0)" id="btnFechar" class="btnFechar" onclick="fecharNav()">&times;</a>
        <a href="#">Inicio</a>
        <a href="#">Perfil</a>
        <a href="#">Monitorias</a>
        <a href="#" id="logoutLink">Sair</a>
        <script type="text/javascript" src="js/logout.js"></script>
    </div>
</aside>

<section id="principal">
    <span style="font-size: 45px; cursor: pointer" onclick="abrirNav()">&#9776;</span>
</section>

<div class="container" id="daysContainer">
    <script type="text/javascript" src="js/calendario.js"></script>
</div>

<div class="test">
    <fieldset>
    <legend>Monitorias Cadastradas</legend>
    <?php if($monitoria_preenchida): ?>
        <?php foreach($monitorias as $monitoria): ?>
            <p>Nome da disciplina: <?php echo $monitoria['disciplina']; ?></p>
            <p>Curso: <?php echo $monitoria['curso']; ?></p>
            <p>Professor: <?php echo $monitoria['professor']; ?></p>
            <p>Sala: <?php echo $monitoria['sala']; ?></p>
            <p>Turma: <?php echo $monitoria['turma']; ?></p>
            <hr> <!-- Linha horizontal para separar as monitorias -->
        <?php endforeach; ?>
    <?php else: ?>
        <p>Você não tem monitorias cadastradas.</p>
    <?php endif; ?>
    </fieldset>
</div>

<script type="text/javascript" src="js/menulateral.js"></script>

</body>
</html>
