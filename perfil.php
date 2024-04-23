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
$id_monitor = $_SESSION['id_monitor'];
$id_professor = $_SESSION['id_professor'];





mysqli_close($conexao);
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="style2.css">
    <style>
        /* Estilo para a prévia da imagem */
        #previa_foto_perfil {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="header" id="header">
    <div class="user-avatar">
        <img id="previa_foto_perfil" src="#" alt="Prévia da Foto de Perfil">
    </div>
    <p id="nomePessoa"><?php echo ucwords($nome_pessoa); ?></p>
    <p id="matricula">Matricula: <?php echo $matricula; ?></p>
</div>

<aside id="menuLateral" class="menuLateral">
    <div class="logo_header">
        <img src="images/logo.png" width="160" height="80">
    </div>
    <div id="listaMenu" class="listaMenu">
        <a href="javascript:void(0)" id="btnFechar" class="btnFechar" onclick="fecharNav()">&times;</a>
        <a href="iniciomonitor.php">Inicio</a>
        <a href="perfil.php">Perfil</a>
        <a href="monitorias.php">Monitorias</a>
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

<div class="perfilStatus">
    <fieldset>
        <legend>Informações do Perfil</legend>
        <form action="salvar_perfil.php" method="post" enctype="multipart/form-data">
            <div class="upload-container">
                <input type="file" id="input-foto" accept="image/*" onchange="exibirPreviewFotoPerfil(event)">
                <div class="preview" id="preview-container">
                    <img id="preview-img" src="#" alt="Prévia da Foto do Perfil">
                </div>
            </div>
            
            <label for="curso">Curso:</label>
            <input type="text" name="curso" id="curso" placeholder="Digite o curso que está fazendo"><br><br>
            
            <label for="bio">Bio:</label><br>
            <textarea name="bio" id="bio" cols="30" rows="5" placeholder="Descreva um pouco sobre você"></textarea><br><br>
            
            <input type="submit" value="Salvar">
        </form>
    </fieldset>
</div>

<script type="text/javascript" src="js/previa_foto_perfil.js"></script>

<script type="text/javascript" src="js/menulateral.js"></script>


</body>
</html>