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

// Recuperei os valores da sessao
$id_pessoa = $_SESSION['id_pessoa'];
$id_professor = $_SESSION['id_professor'];



$query = "SELECT
monitoria.id_monitoria,
curso.curso_nome,
disciplina.disciplina_nome,
nome_monitor.nome_pessoa as nome_monitor,
monitoria.turno,
monitoria.local,
dias.dia,
monitoria.data_inicio,
monitoria.data_fim
from monitoria
inner join disciplina on monitoria.monitoria_disciplina = id_disciplina
inner join curso on disciplina.disciplina_curso = id_curso
INNER JOIN monitor ON monitoria.monitoria_monitor = monitor.id_monitor  
inner join pessoa as nome_monitor on monitor.monitor_pessoa = nome_monitor.id_pessoa
inner join dias on monitoria.monitoria_dia = dias.id_dias
where disciplina.disciplina_professor = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "i", $id_professor);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Array para armazenar os dados das monitorias
$monitorias = array();

// Verifique se há monitorias cadastradas para o monitor atual
if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        // Adicione os dados da monitoria ao array
        $monitorias[] = $row;
    }
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
    <div class="user-avatar"></div> <!-- Div para o avatar do usuário -->
    <p id="nomePessoa"><?php echo ucwords($nome_pessoa); ?></p>
    <p id="matricula">Matricula: <?php echo $matricula; ?></p>
</div>


<aside id="menuLateral" class="menuLateral">
    <div class="logo_header">
        <img src="images/logo.png" width="160" height="80">
    </div>
    <div id="listaMenu" class="listaMenu">
        <a href="javascript:void(0)" id="btnFechar" class="btnFechar" onclick="fecharNav()">&times;</a>
        <a href="inicioprofessor.php">Inicio</a>
        <a href="perfil.php">Perfil</a>
        <a href="monitorias_professor.php">Monitorias</a>
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

<div class="monitoriacadastrada">
    <fieldset>
        <legend id="legendTitulo">Monitorias Cadastradas</legend>
        <?php if(!empty($monitorias)): ?>
            <?php foreach($monitorias as $monitoria): ?>
                <p>Disciplina: <?php echo $monitoria['disciplina_nome']; ?></p>
                <p>Curso: <?php echo $monitoria['curso_nome']; ?></p>
                <p>Monitor: <?php echo ucwords($monitoria['nome_monitor']); ?></p>
                <p>Sala: <?php echo $monitoria['local']; ?></p>
                <p>Turno: <?php echo $monitoria['turno']; ?></p>
                <p>Dia: <?php echo $monitoria['dia']; ?></p>
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
