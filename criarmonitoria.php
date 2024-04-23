<?php
// Inicia a sessão para garantir que as variáveis de sessão estejam disponíveis
session_start();

// Inclui o arquivo de configuração para a conexão com o banco de dados
include_once('config.php');

// Verifica se o formulário foi enviado
if (isset($_POST['submit'])) {
    // Recupera os valores do formulário
    $id_curso = $_POST['curso'];
    $id_disciplina = $_POST['disciplina'];
    $fase = $_POST['fase'];
    $sala = $_POST['sala'];
    $turno = $_POST['turno'];
    $data_inicio = $_POST['inicio'];
    $data_fim = $_POST['fim'];
    $dia_aula = $_POST['dia_aula'];
    $id_professor = $_SESSION['id_professor'];

    // Atualiza a disciplina para associar o professor
    $sql_update_disciplina = "UPDATE disciplina SET disciplina_professor = '$id_professor' WHERE id_disciplina = '$id_disciplina'";

    if (!$conexao->query($sql_update_disciplina)) {
        echo "Erro ao atualizar a disciplina: " . $conexao->error;
        exit; // Interrompe a execução do script
    }

    // Insere os dados da monitoria
    $sql_insert_monitoria = "INSERT INTO monitoria (monitoria_disciplina, turno, local, monitoria_dia, data_inicio, data_fim) 
                             VALUES ('$id_disciplina', '$turno', '$sala', '$dia_aula', '$data_inicio', '$data_fim')";

    if ($conexao->query($sql_insert_monitoria)) {
        header("Location: monitorias_professor.php");
    } else {
        echo "Erro ao criar monitoria: " . $conexao->error;
    }

    // Fecha a conexão com o banco de dados
    mysqli_close($conexao);

} else {
    echo "Erro: Nenhum formulário enviado.";
    exit; // Interrompe a execução se o formulário não foi enviado
}
