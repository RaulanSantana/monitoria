<?php

session_start();

include_once('config.php');

if (isset($_SESSION['nome_pessoa']) && isset($_SESSION['matricula'])) {
    $nome_pessoa = $_SESSION['nome_pessoa'];
    $matricula = $_SESSION['matricula'];
    $id_professor = $_SESSION['id_professor'];
} else {
    
    header("Location: login.php");
    exit;
}


$query = "SELECT 
    monitoria.id_monitoria,
    monitoria.turno,
    monitoria.local,
    monitoria.monitoria_dia,
    monitoria.data_inicio,
    monitoria.data_fim,
    disciplina.disciplina_nome,
    disciplina.disciplina_fase,
    curso.curso_nome,
    CASE monitoria.monitoria_dia
        WHEN 1 THEN 'Segunda-feira'
        WHEN 2 THEN 'Terça-feira'
        WHEN 3 THEN 'Quarta-feira'
        WHEN 4 THEN 'Quinta-feira'
        WHEN 5 THEN 'Sexta-feira'
        WHEN 6 THEN 'Sábado'
        WHEN 7 THEN 'Domingo'
    END AS nome_dia
FROM 
    monitoria
JOIN disciplina ON monitoria.monitoria_disciplina = disciplina.id_disciplina
JOIN curso ON disciplina.disciplina_curso = curso.id_curso
WHERE 
    disciplina.disciplina_professor = '$id_professor'";

$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Armazenar as monitorias associadas ao professor
$monitorias = array();

// Verifique se há monitorias disponíveis para o professor
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Adiciona as monitorias ao array
        $monitorias[] = $row;
    }
}



$queryy = "SELECT 
monitoria.id_monitoria,
monitoria.monitoria_monitor,
monitoria.turno,
monitoria.local,
monitoria.monitoria_dia,
monitoria.data_inicio,
monitoria.data_fim,
disciplina.disciplina_nome,
disciplina.disciplina_fase,
curso.curso_nome,
CASE monitoria.monitoria_dia
    WHEN 1 THEN 'Segunda-feira'
    WHEN 2 THEN 'Terça-feira'
    WHEN 3 THEN 'Quarta-feira'
    WHEN 4 THEN 'Quinta-feira'
    WHEN 5 THEN 'Sexta-feira'
    WHEN 6 THEN 'Sábado'
    WHEN 7 THEN 'Domingo'
END AS nome_dia
FROM 
monitoria
JOIN disciplina ON monitoria.monitoria_disciplina = disciplina.id_disciplina
JOIN curso ON disciplina.disciplina_curso = curso.id_curso
WHERE 
disciplina.disciplina_professor = '$id_professor' and monitoria.monitoria_monitor is null";

$stmte = mysqli_prepare($conexao, $queryy);
mysqli_stmt_execute($stmte);
$resulte = mysqli_stmt_get_result($stmte);

// Armazenar as monitorias associadas ao professor
$monitorias3 = array();

// Verifique se há monitorias disponíveis para o professor
if ($resulte) {
    while ($roww = mysqli_fetch_assoc($resulte)) {
        // Adiciona as monitorias ao array
        $monitorias3[] = $roww;
    }
}

$queryyy = "SELECT 
monitoria.id_monitoria,
monitoria.monitoria_monitor,

nome_monitor.nome_pessoa as nome_monitor,
monitoria.turno,
monitoria.local,
monitoria.monitoria_dia,
monitoria.data_inicio,
monitoria.data_fim,
disciplina.disciplina_nome,
disciplina.disciplina_fase,
curso.curso_nome,
CASE monitoria.monitoria_dia
    WHEN 1 THEN 'Segunda-feira'
    WHEN 2 THEN 'Terça-feira'
    WHEN 3 THEN 'Quarta-feira'
    WHEN 4 THEN 'Quinta-feira'
    WHEN 5 THEN 'Sexta-feira'
    WHEN 6 THEN 'Sábado'
    WHEN 7 THEN 'Domingo'
END AS nome_dia
FROM 
monitoria
JOIN disciplina ON monitoria.monitoria_disciplina = disciplina.id_disciplina
JOIN curso ON disciplina.disciplina_curso = curso.id_curso
join monitor on monitoria.monitoria_monitor = monitor.id_monitor
join pessoa as nome_monitor on monitor.monitor_pessoa = nome_monitor.id_pessoa
WHERE 
disciplina.disciplina_professor = '$id_professor' and monitoria.monitoria_monitor is not null";

$stmtee = mysqli_prepare($conexao, $queryyy);
mysqli_stmt_execute($stmtee);
$resultee = mysqli_stmt_get_result($stmtee);

// Armazenar as monitorias associadas ao professor
$monitorias33 = array();

// Verifique se há monitorias disponíveis para o professor
if ($resultee) {
    while ($rowww = mysqli_fetch_assoc($resultee)) {
        // Adiciona as monitorias ao array
        $monitorias33[] = $rowww;
    }
}


$sql = "SELECT id_curso, curso_nome FROM curso";
$resultado = $conexao->query($sql);













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


    <div id="modal" class="modal">
    <div class="modal-content">
    <span onclick="fecharModal()" class="close">&times;</span>
    <div class="tituloModel">


    



            <legend>Criar Monitoria</legend>
            </div>
                <!-- Seu formulário de criação de monitoria aqui -->

                
        <div class="criarMon">
        <form action="criarmonitoria.php" method="post">

        <div class="cursoM">
        <label for="curso">Curso:</label><br>
        <select name="curso" id="curso">
        <option value="">Selecione um curso</option>
    <?php
    // Criar opções dinamicamente com base no resultado da consulta, usando IDs como valores
    while ($linha = $resultado->fetch_assoc()) {
        echo "<option value=\"{$linha['id_curso']}\">{$linha['curso_nome']}</option>";  // Valor é o ID do curso


    }
    ?>
</select>
        </div>
        
        <script type="text/javascript" src="js/seletor.js"></script>
      
        <div class="faseM">
        <label for="fase">Fase:</label><br>
        <select name="fase" id="fase">
            <option value="">Selecione um curso primeiro</option>  <!-- Texto padrão quando não há opções -->
        </select>
        </div>

        <div class="disciplinaM">
        <label for="disciplina">Disciplina:</label><br>
        <select name="disciplina" id="disciplina">
            <option value="">Selecione uma fase primeiro</option>  <!-- Texto padrão quando não há opções -->
        </select>
        </div>

    


        <div class="salaM">
        <label for="sala">Sala:</label><br>
        <input type="text" id="sala" name="sala" required><br><br>
        </div>

        <div class="turnoM">
        <label for="turno">Turno:</label><br>
        <select id="turno" name="turno" required>
            <option value="manhã">Manhã</option>
            <option value="tarde">Tarde</option>
            <option value="noite">Noite</option>
           </select>
           </div>
        

        <div class="inicioM">
        <label for="inicio">Data do Início:</label><br>
        <input type="date" id="inicio" name="inicio" required><br><br>
        </div>

        <div class="fimM">
        <label for="fim">Data do Fim:</label><br>
        <input type="date" id="fim" name="fim" required><br><br>
        </div>

         <div class="dia_aulaM">
        <label for="dia_aula">Dia da Aula:</label><br>
        <select id="dia_aula" name="dia_aula" required>
            <option value="1">Segunda-feira</option>
            <option value="2">Terça-feira</option>
            <option value="3">Quarta-feira</option>
            <option value="4">Quinta-feira</option>
            <option value="5">Sexta-feira</option>
            <option value="6">Sábado</option>
            <option value="7">Domingo</option>
        </select>
        </div>



        <div class="botaoCM">
    <button onclick="fecharModal()">Cancelar</button>
   </div>
    
        <div class="botaoM">
        <input type="submit" name="submit"value="OK">
        </div>

   

            </form>
            </div>    
    </div>
</div>
<div class="botaoCriar" >
<input type="button" value="Criar monitoria" onclick="abrirModal()">
</div>





<div id="modaldel" class="modaldel">
    <div class="modaldel-content">
    <span onclick="fecharModaldel()" class="close">&times;</span>
    <div class="tituloModel"></div></div></div>

<div class="botaoDeletar" >
<input type="button" value="Deletar monitoria" onclick="abrirModaldel()">
</div>

<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/modaldel.js"></script>

<fieldset>
    <legend >Monitorias criadas pelo Professor</legend>
    <?php if (!empty($monitorias)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Disciplina</th>
                    <th>Curso</th>
                    <th>Fase</th>
                    <th>Sala</th>
                    <th>Turno</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Dia da Aula</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monitorias as $monitoria): ?>
                    <tr>
                        <td><?php echo $monitoria['disciplina_nome']; ?></td>
                        <td><?php echo $monitoria['curso_nome']; ?></td>
                        <td><?php echo $monitoria['disciplina_fase']; ?></td>
                        <td><?php echo $monitoria['local']; ?></td>
                        <td><?php echo $monitoria['turno']; ?></td>
                        <td><?php echo $monitoria['data_inicio']; ?></td>
                        <td><?php echo $monitoria['data_fim']; ?></td>
                        <td><?php echo $monitoria['nome_dia']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Não há monitorias criadas por este professor.</p>
    <?php endif; ?>
</fieldset>
<br><br>
<fieldset>
   
    <legend>Monitorias sem monitor</legend>
   
    <?php if (!empty($monitorias)): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Disciplina</th>
                    <th>Curso</th>
                    <th>Fase</th>
                    <th>Sala</th>
                    <th>Turno</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Dia da Aula</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monitorias3 as $monitoriaa): ?>
                    <tr>
                        
                        <td><?php echo $monitoriaa['disciplina_nome']; ?></td>
                        <td><?php echo $monitoriaa['curso_nome']; ?></td>
                        <td><?php echo $monitoriaa['disciplina_fase']; ?></td>
                        <td><?php echo $monitoriaa['local']; ?></td>
                        <td><?php echo $monitoriaa['turno']; ?></td>
                        <td><?php echo $monitoriaa['data_inicio']; ?></td>
                        <td><?php echo $monitoriaa['data_fim']; ?></td>
                        <td><?php echo $monitoriaa['nome_dia']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Todas as monitorias cadastradas tem monitor.</p>
    <?php endif; ?>
</fieldset>
<br><br>
<fieldset>
   
    <legend>Monitorias com monitor</legend>
   
    <?php if (!empty($monitorias)): ?>
        <table class="table">
            <thead>
                <tr>
                <th>Monitor</th>
                    <th>Disciplina</th>
                    <th>Curso</th>
                    <th>Fase</th>
                    <th>Sala</th>
                    <th>Turno</th>
                    <th>Data de Início</th>
                    <th>Data de Fim</th>
                    <th>Dia da Aula</th>
                
                </tr>
            </thead>
            <tbody>
                <?php foreach ($monitorias33 as $monitoriaaa): ?>
                    <tr>
                    <td><?php echo $monitoriaaa['nome_monitor']; ?></td>
                        <td><?php echo $monitoriaaa['disciplina_nome']; ?></td>
                        <td><?php echo $monitoriaaa['curso_nome']; ?></td>
                        <td><?php echo $monitoriaaa['disciplina_fase']; ?></td>
                        <td><?php echo $monitoriaaa['local']; ?></td>
                        <td><?php echo $monitoriaaa['turno']; ?></td>
                        <td><?php echo $monitoriaaa['data_inicio']; ?></td>
                        <td><?php echo $monitoriaaa['data_fim']; ?></td>
                        <td><?php echo $monitoriaaa['nome_dia']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Nenhum monitor foi inscrito.</p>
    <?php endif; ?>
</fieldset>


<script type="text/javascript" src="js/menulateral.js"></script>

</body>
</html>
