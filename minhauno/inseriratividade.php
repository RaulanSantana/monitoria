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




$queryy = "SELECT * FROM monitoriateste.monitoria
 inner join aula on aula.aula_data = ?
 where monitoria_monitor= ? ";

$stmtt = mysqli_prepare($conexao, $queryy);

// Verifique se a preparação foi bem-sucedida
if ($stmtt === false) {
    die("Erro ao preparar a consulta: " . mysqli_error($conexao));
}

// Corrigir bind_param para ligar os parâmetros corretos
mysqli_stmt_bind_param($stmtt, "si",$data_atual,  $id_monitor); // "i" para int, "s" para string

mysqli_stmt_execute($stmtt); // Executar a consulta
$resultt = mysqli_stmt_get_result($stmtt); // Obter o resultado

if ($resultt && $resultt->num_rows > 0) { // Verifique se há resultados
    $conteudo_row = $resultt->fetch_assoc(); // Obter o primeiro resultado
    $conteudo = $conteudo_row['conteudo']; // Acessar a coluna 'conteudo'
    $id_aula = $conteudo_row['id_aula'];
    $id_monitoria = $conteudo_row['id_monitoria'];
    $presenca = $conteudo_row['presenca'];
    $atividade = $conteudo_row['atividades'];
} 
if (!isset($conteudo) || $conteudo === null){
    $conteudo = "Indefinido pelo professor";
}

$inseriratividade = 'testeteste';
if(isset($_POST['submit'])){
    include_once('config.php');

    // Obter aula relacionada ao monitoria do dia atual
    $carregar = "SELECT *,
    monitoria.monitoria_monitor
    
    from
    aula
    inner join monitoria on aula.aula_monitoria = monitoria.id_monitoria 
    
    where aula.aula_data = ? and monitoria_monitor = ?";
  
    $stmttt = mysqli_prepare($conexao, $carregar);
    mysqli_stmt_bind_param($stmttt, "si", $data_atual, $id_monitor); 
    mysqli_stmt_execute($stmttt); 
    $resulttt = mysqli_stmt_get_result($stmttt); 
  
    if ($resulttt && $resulttt->num_rows > 0) {
        $mass_row = $resulttt->fetch_assoc();
        $id_aula = $mass_row['id_aula'];
        $id_monitoria = $mass_row['id_monitoria'];  

        $carr = "UPDATE aula SET atividades = ? WHERE aula_monitoria = ? AND aula_data = ? and id_aula = ? ";
        $stmttt = mysqli_prepare($conexao, $carr);
        mysqli_stmt_bind_param($stmttt, "sisi", $inseriratividade, $id_monitoria, $data_atual, $id_aula);
        mysqli_stmt_execute($stmttt);
    } else {
        // Caso contrário, insira uma nova entrada para a aula
        $carr = "INSERT INTO aula (atividades) VALUES ('$inseriratividade') where aula_monitoria = ? AND aula_data = ? and id_aula = ? ";
        $stmttt = mysqli_prepare($conexao, $carr);
        mysqli_stmt_bind_param($stmttt, "sisi", $inseriratividade, $aula_monitoria, $data_atual, $id_aula);
        mysqli_stmt_execute($stmttt);
    }
  }