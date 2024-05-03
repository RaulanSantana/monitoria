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


// Consulta ao banco de dados para buscar informações relevantes das monitorias associadas ao monitor atual
$query = "SELECT monitoria.*, disciplina.disciplina_nome, disciplina.disciplina_fase, curso.curso_nome, pessoa.nome_pessoa, dias.dia
FROM monitoria
INNER JOIN disciplina ON monitoria.monitoria_disciplina = disciplina.id_disciplina
INNER JOIN curso ON disciplina.disciplina_curso = curso.id_curso
LEFT JOIN professor ON disciplina.disciplina_professor = professor.id_professor
LEFT JOIN pessoa ON professor.professor_pessoa = pessoa.id_pessoa
LEFT JOIN dias ON monitoria.monitoria_dia = dias.id_dias
WHERE monitoria.monitoria_monitor = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "i", $id_monitor);
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

$data_atual = date("Y-m-d"); // A data atual no formato correto

$queryy = "SELECT * FROM monitoriateste.monitoria
 inner join aula on aula.aula_data = ?
 where monitoria_monitor= ? ";

$stmtt = mysqli_prepare($conexao, $queryy);

// Verifique se a preparação foi bem-sucedida
if ($stmtt === false) {
    die("Erro ao preparar a consulta: " . mysqli_error($conexao));
}


mysqli_stmt_bind_param($stmtt, "si",$data_atual,  $id_monitor); 
mysqli_stmt_execute($stmtt); // Executar a consulta
$resultt = mysqli_stmt_get_result($stmtt); // Obter o resultado

if ($resultt && $resultt->num_rows > 0) { // Verifique se há resultados
    $conteudo_row = $resultt->fetch_assoc(); // Obter o primeiro resultado
    $conteudo = $conteudo_row['conteudo']; // Acessar a coluna 'conteudo'
    $id_aula = $conteudo_row['id_aula'];
    $id_monitoria = $conteudo_row['id_monitoria'];
    
    $atividade = $conteudo_row['atividades'];
} 
if (!isset($conteudo) || $conteudo === null){
    $conteudo = "Indefinido pelo professor";
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvaratividade'])) {
   
    $inseriratividade = $_POST['atividadearea'];
    // Obter aula relacionada ao monitoria do dia atual
    $carregar = "SELECT *, monitoria.monitoria_monitor 
    from aula
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


// Verificar o estado atual da presença
$query = "SELECT presenca FROM aula WHERE aula_data = ? AND aula_monitoria = ? AND id_aula = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "sii", $data_atual, $id_monitoria, $id_aula);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $presenca = $row['presenca']; // Interpretar como inteiro
}
$presenca = null;
$presenca_mensagem = "Confirmar presença"; // Mensagem padrão
$botao_desativado = false; // Estado padrão do botão

if ($presenca === 1) { // Se presença for 1 (confirmada)
    $presenca_mensagem = "Presença confirmada!";
    
}

// Se o formulário POST for enviado para confirmar a presença
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmarpre'])  && !isset($presenca)) {
    // Atualizar a presença para 1
    $update_query = "UPDATE aula SET presenca = '1' WHERE id_aula = ? AND aula_monitoria = ? AND aula_data = ?";
    
    $stmta_update = mysqli_prepare($conexao, $update_query);
    if ($stmta_update) {
        mysqli_stmt_bind_param($stmta_update, "iis", $id_aula, $id_monitoria, $data_atual);
        mysqli_stmt_execute($stmta_update);

        // Verificar se a atualização foi bem-sucedida
        if (mysqli_stmt_affected_rows($stmta_update) > 0) {
            $presenca_mensagem = "Presença confirmada!";
            $botao_desativado = true;
           


            
        } else {
            $botao_desativado = true; // Desativar o botão
           // header("Location: iniciomonitor.php");
        }
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
    }
}



// Obtendo o dia atual em português
$diaatual = ucfirst(strtolower(date("l"))); // Obtemos o dia em inglês e o convertemos para o formato esperado


// Mapeamento entre dias em inglês e português
$diasmapeado = [
    "Sunday" => "Domingo",
    "Monday" => "Segunda-feira",
    "Tuesday" => "Terça-feira",
    "Wednesday" => "Quarta-feira",
    "Thursday" => "Quinta-feira",
    "Friday" => "Sexta-feira",
    "Saturday" => "Sábado"
];

// Obter o dia da semana em inglês e depois mapear para português
$diasdasemana = date("l");
$diaatual = $diasmapeado[$diasdasemana] ?? null;

// Certifique-se de que o mapeamento é válido
if ($diaatual === null) {
    die("Erro: Dia da semana não reconhecido.");
}

// Agora, pegue o índice do dia atual
$diasdasemana = [
    'Domingo' => 7,
    'Segunda-feira' => 1,
    'Terça-feira' => 2,
    'Quarta-feira' => 3,
    'Quinta-feira' => 4,
    'Sexta-feira' => 5,
    'Sábado' => 6,
];

$diaatualindice = $diasdasemana[$diaatual];

// Separar monitorias do dia atual e outras
$hoje_monitorias = [];
$outra_monitorias = [];

// Separar as monitorias com base no dia atual
foreach ($monitorias as $monitoria) {
    if ($monitoria['dia'] === $diaatual) { // Comparar com o dia em português
        $hoje_monitorias[] = $monitoria;
    } else {
        $outra_monitorias[] = $monitoria;
    }
}

// Reorganizar para que as monitorias do dia atual fiquem no topo
$monitorias = array_merge($hoje_monitorias, $outra_monitorias);


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

<div class="monitoriacadastrada">
<fieldset>
        <legend id="legendTitulo">Monitorias Cadastradas</legend>
        <?php if (!empty($monitorias)): ?>
            <?php foreach ($monitorias as $monitoria): ?>
                <p>Disciplina: <?php echo $monitoria['disciplina_nome']; ?></p>
                <p>Curso: <?php echo $monitoria['curso_nome']; ?></p>
                <p>Professor: <?php echo $monitoria['nome_pessoa']; ?></p>
                <p>Sala: <?php echo $monitoria['local']; ?></p>
                <p>Turno: <?php echo $monitoria['turno']; ?></p>
                <p>Dia: <?php echo $monitoria['dia']; ?></p>
                <script src="js/botaocalendario.js"></script>
                <div class="botaoAcessar" id="botao_<?php echo $monitoria['disciplina_nome']; ?>">
                    <!-- botao para acessar a aula, apenas no dia correto -->
                </div>
                
                <script>
                    exibirBotaoAcesso('<?php echo $monitoria['dia']; ?>', 'botao_<?php echo $monitoria['disciplina_nome']; ?>');
                </script>
                
                <hr> <!-- linha horizontal para separar as monitorias -->
            <?php endforeach; ?>
        <?php else: ?>
            <p>Você não tem monitorias cadastradas.</p>
        <?php endif; ?>
    </fieldset>
</div>

<div id="modalaula-popup" class="modalaula-popup">
  <div class="modalaula-content">
    <span class="closeaula">&times;</span>
    <div class="tituloModel">
    <legend>Aula</legend>
        </div>
        <br>
    <p>Data: <?php echo $monitoria['dia'] ,' ', date('Y-m-d H:i:s');?></p>
    <br>
    <p>Conteúdo: <?php echo $conteudo; ?> </p>
<br>

<div>
<form id="formAtividade" method="post">
        <p>Atividade: </p>
        <textarea name="atividadearea" id="atividadearea" cols="30" rows="4" placeholder="Descreva a atividade">
            <?php echo isset($atividade) ? htmlspecialchars($atividade) : ''; ?>
        </textarea>
        <br>
        <input type="submit" id="submit" name="salvaratividade" value="Salvar">
    </form>
    </div>
<br>
   
          <form action="iniciomonitor.php" method="post">
<div class="botaoCP">


    <input type="submit"  name="confirmarpre"  value="<?php echo $presenca_mensagem; ?>" 
           <?php if ($botao_desativado) echo 'disabled class="presenca-confirmada"'; ?>>
</div>
</form> 
  </div>
  <script type="text/javascript" src="js/modalaula.js"></script>
</div>


<script type="text/javascript" src="js/menulateral.js"></script>
<script type="text/javascript" src="js/modal.js"></script>


</body>
</html>