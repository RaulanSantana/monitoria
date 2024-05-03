<?php
// Inclua o arquivo de configuração para obter a conexão com o banco de dados
include_once('config.php');

// Assumir que os IDs relevantes estão disponíveis
$data_atual = date("Y-m-d"); // Data atual no formato padrão

// Verificar o estado atual da presença
$query = "SELECT presenca FROM aula WHERE aula_data = ? AND aula_monitoria = ? AND id_aula = ?";
$stmt = mysqli_prepare($conexao, $query);
mysqli_stmt_bind_param($stmt, "sii", $data_atual, $id_monitoria, $id_aula);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$presenca = 0; // Valor padrão
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $presenca = (int)$row['presenca']; // Interpretar como inteiro
}

$presenca_mensagem = "Confirmar presença"; // Mensagem padrão
$botao_desativado = false; // Estado padrão do botão

if ($presenca === 1) { // Se presença for 1 (confirmada)
    $presenca_mensagem = "Presença confirmada!";
    $botao_desativado = true; // Desativar o botão
}

// Se o formulário POST for enviado para confirmar a presença
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirmarpre']) && !$botao_desativado) {
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
            echo "Erro ao confirmar presença: nenhuma linha afetada.";
        }
    } else {
        echo "Erro ao preparar a consulta: " . mysqli_error($conexao);
    }
}

?>
