<?php
session_start();

// Inclua o arquivo de configuração para obter a conexão com o banco de dados
include_once('config.php');

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se os IDs da monitoria e da pessoa foram recebidos
    if (isset($_POST["id_monitoria"]) && isset($_SESSION["id_pessoa"])) {
        // Obtém os IDs da monitoria e da pessoa enviados pelo formulário
        $id_monitoria = $_POST["id_monitoria"];
        $id_pessoa = $_SESSION["id_pessoa"];

        // Consulta para obter o id_monitor com base no id_pessoa
        $query_monitor = "SELECT id_monitor FROM monitor WHERE monitor_pessoa = ?";
        $stmt = mysqli_prepare($conexao, $query_monitor);
        mysqli_stmt_bind_param($stmt, "i", $id_pessoa);
        mysqli_stmt_execute($stmt);
        $result_monitor = mysqli_stmt_get_result($stmt);

        // Verifica se a consulta retornou algum resultado
        if ($result_monitor) {
            // Obtém o id_monitor da consulta
            $row = mysqli_fetch_assoc($result_monitor);
            $id_monitor = $row['id_monitor'];

            // Atualiza o id_monitor na coluna monitoria_monitor da tabela monitoria para a monitoria atual
$query_update = "UPDATE monitoria SET monitoria_monitor = ? WHERE id_monitoria = ?";
$stmt_update = mysqli_prepare($conexao, $query_update);
mysqli_stmt_bind_param($stmt_update, "ii", $id_monitor, $id_monitoria);
$success = mysqli_stmt_execute($stmt_update);


            // Verifica se a inserção foi bem-sucedida
            if ($success) {
                // Redireciona de volta para a página de monitorias após salvar
                header("Location: monitorias.php");
                exit;
            } else {
                echo "Erro ao salvar a seleção da monitoria no banco de dados.";
            }
        } else {
            echo "Erro ao recuperar o ID do monitor.";
        }
    } else {
        // Se os IDs da monitoria e da pessoa não foram recebidos, redireciona de volta para a página de monitorias sem fazer nada
        header("Location: monitorias.php");
        exit;
    }
} else {
    // Se o formulário não foi submetido via POST, redireciona de volta para a página de monitorias sem fazer nada
    header("Location: monitorias.php");
    exit;
}
?>
