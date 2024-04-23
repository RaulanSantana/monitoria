<?php
// Inclua o arquivo de configuração para obter a conexão com o banco de dados
include_once('config.php');

// Inicie a sessão
session_start();

// Verifique se as informações de nome e matrícula estão na sessão
if (isset($_SESSION['nome_pessoa']) && isset($_SESSION['matricula'])) {
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

// Consulta ao banco de dados para buscar as monitorias disponíveis
$query = "SELECT 
monitoria.id_monitoria AS id_monitoria,
monitoria.monitoria_disciplina AS monitoria_disciplina,
monitoria.turno AS turno,
monitoria.monitoria_monitor AS monitoria_monitor,
monitoria.local AS local,
monitoria.monitoria_dia AS monitoria_dia,
monitoria.data_inicio AS data_inicio,
monitoria.data_fim AS data_fim,
disciplina.disciplina_nome AS disciplina_nome,
disciplina.disciplina_fase AS disciplina_fase,
curso.curso_nome AS curso_nome,
pessoa.nome_pessoa AS nome_professor,
dias.dia AS nome_dia
FROM 
monitoria
JOIN disciplina ON monitoria.monitoria_disciplina = disciplina.id_disciplina
JOIN curso ON disciplina.disciplina_curso = curso.id_curso
LEFT JOIN professor ON disciplina.disciplina_professor = professor.id_professor
LEFT JOIN pessoa ON professor.professor_pessoa = pessoa.id_pessoa
LEFT JOIN dias ON monitoria.monitoria_dia = dias.id_dias
WHERE 
monitoria.monitoria_monitor IS NULL;
";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Array para armazenar as monitorias disponíveis
$monitorias1 = array();

// Verifique se há monitorias disponíveis
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Adiciona as monitorias disponíveis ao array
        $monitorias1[] = $row;
    }
}

if(isset($_POST['submit'])){
    // Query para inserir a monitoria no banco de dados
    $query_monitoria = "INSERT INTO monitoria(monitoria_monitor) VALUES ('$id_monitor')";
    
    // Executar a query
    if(mysqli_query($conexao, $query_monitoria)) {
        // Exibir a mensagem de sucesso após a inserção
        echo "<script>alert('Monitoria cadastrada com sucesso!'); window.location.replace('monitorias.php');</script>";
        exit;
    } else {
        // Caso ocorra um erro na inserção, exibir mensagem de erro
        echo "Erro ao cadastrar a monitoria: " . mysqli_error($conexao);
    }
}

// Verifica se há monitorias disponíveis ou não
$monitorias_disponiveis = !empty($monitorias1);

mysqli_close($conexao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitorias</title>
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
<div class="listaMonitoriasDisponivel">
    <fieldset>
        <legend>Monitorias disponíveis</legend>
        <?php if(!empty($monitorias1)): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Curso</th>
                        <th>Professor</th>
                        <th>Fase</th>
                        <th>Sala</th>
                        <th>Turno</th>
                        <th>Data do inicio</th>
                        <th>Data do fim</th>
                        <th>Dia da aula</th>
                        <th>Disponivel</th>

                    </tr>
                </thead>
                <tbody>
                <?php foreach($monitorias1 as $monitoria1): ?>
    <tr>
        <td><?php echo $monitoria1['disciplina_nome']; ?></td>
        <td><?php echo $monitoria1['curso_nome']; ?></td>
        <td><?php echo $monitoria1['nome_professor']; ?></td>
        <td><?php echo $monitoria1['disciplina_fase']; ?></td>
        <td><?php echo $monitoria1['local']; ?></td>
        <td><?php echo $monitoria1['turno']; ?></td>
        <td><?php echo $monitoria1['data_inicio']; ?></td>
        <td><?php echo $monitoria1['data_fim']; ?></td>
        <td><?php echo $monitoria1['nome_dia']; ?></td>
        <td>
    <form id="form_<?php echo $monitoria1['id_monitoria']; ?>" action="salvar_monitoria.php" method="post">
        <input type="hidden" name="id_monitoria" value="<?php echo $monitoria1['id_monitoria']; ?>">
        <input type="hidden" name="id_pessoa" value="<?php echo $id_pessoa; ?>">
        <button type="submit" name="submit" onclick="return confirmarSelecao('<?php echo $monitoria1['id_monitoria']; ?>')">SELECIONAR</button>
    </form>
</td>
    </tr>
<?php endforeach; ?>

<script>
    function confirmarSelecao(idMonitoria) {
        if (confirm("Tem certeza que deseja selecionar esta monitoria?")) {
            // Se confirmado, envia o formulário
            document.getElementById('form_' + idMonitoria).submit();
        } else {
            // Caso contrário, não faz nada
            return false;
        }
    }
</script>

                </tbody>
            </table>
        <?php else: ?>
            <p>Não há monitorias disponíveis.</p>
        <?php endif; ?>
    </fieldset>
</div>


<script type="text/javascript" src="js/menulateral.js"></script>

</body>
</html>
