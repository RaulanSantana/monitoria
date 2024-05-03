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
        if ($result_monitor && $result_monitor->num_rows > 0) {
            // Obtém o id_monitor da consulta
            $row = mysqli_fetch_assoc($result_monitor);
            $id_monitor = $row['id_monitor'];

            // Atualiza o id_monitor na coluna monitoria_monitor da tabela monitoria para a monitoria atual
            $query_update = "UPDATE monitoria SET monitoria_monitor = ? WHERE id_monitoria = ?";
            $stmt_update = mysqli_prepare($conexao, $query_update);
            mysqli_stmt_bind_param($stmt_update, "ii", $id_monitor, $id_monitoria);
            $success = mysqli_stmt_execute($stmt_update);

            // Verifica se a atualização foi bem-sucedida
            if ($success) {
                // Consulta para obter as datas de início e fim da monitoria atualizada
                $query_monitoria = "SELECT id_monitoria, data_inicio, data_fim, monitoria_dia FROM monitoria WHERE monitoria_monitor = ? ORDER BY id_monitoria DESC LIMIT 1";
                $stmt = $conexao->prepare($query_monitoria);
                $stmt->bind_param('i', $id_monitor);
                $stmt->execute();
                $resultado = $stmt->get_result();

                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();

                    $id_monitoria = $row["id_monitoria"]; // Obter o id da monitoria
                    $data_inicio = new DateTime($row["data_inicio"]); // Data de início
                    $data_fim = new DateTime($row["data_fim"]); // Data final
                    
                    // Obter o dia da semana desejado da tabela 'dias'
                    $query_dias = "SELECT dia FROM dias WHERE id_dias = ?";
                    $stmt_dias = $conexao->prepare($query_dias);
                    $stmt_dias->bind_param('i', $row['monitoria_dia']);
                    $stmt_dias->execute();
                    $resultado_dias = $stmt_dias->get_result();

                    if ($resultado_dias->num_rows > 0) {
                        $dia_row = $resultado_dias->fetch_assoc();
                        $dia_semana = $dia_row['dia']; // Dia da semana como string

                        // Mapa para converter o dia da semana para número
                        $dias_semana = [
                            'Segunda-feira' => 1,
                            'Terça-feira' => 2,
                            'Quarta-feira' => 3,
                            'Quinta-feira' => 4,
                            'Sexta-feira' => 5,
                            'Sábado' => 6,
                            'Domingo' => 7
                        ];

                        $dia_num = $dias_semana[$dia_semana]; // Obter o número do dia da semana
                        
                        // Definir a data inicial para começar a partir dela
                        if (new DateTime() > $data_inicio) {
                            $data_inicio = new DateTime(); // Use a data atual se for maior que a data de início
                        }

                        // Loop para inserir aulas até alcançar a data final
                        while ($data_inicio <= $data_fim) {
                            if ($data_inicio->format('N') == $dia_num) {
                                // Formatar a data para inserir no banco de dados
                                $data_formatada = $data_inicio->format('Y-m-d');

                                // Inserir na tabela 'aula'
                                $query_aula = "INSERT INTO aula (aula_monitoria, aula_data) VALUES (?, ?)";
                                $stmt_aula = $conexao->prepare($query_aula);
                                $stmt_aula->bind_param('is', $id_monitoria, $data_formatada);
                                $stmt_aula->execute(); // Inserir o registro

                                $stmt_aula->close(); // Fechar para evitar vazamentos de recursos
                            }

                            // Adicionar 1 dia à data de início para a próxima iteração
                            $data_inicio->modify('+1 day');
                        }
                    }

                    $stmt_dias->close();
                }

                header("Location: monitorias.php"); // Redirecionar após a operação
                exit;
            } else {
                echo "Erro ao salvar a monitoria no banco de dados.";
            }

            $stmt_update->close(); // Fechar para evitar vazamento de recursos
        } else {
            echo "Erro ao recuperar o ID do monitor.";
        }
    } else {
        header("Location: monitorias.php"); // Redirecionar se os parâmetros não estiverem presentes
        exit;
    }
} else {
    header("Location: monitorias.php"); // Redirecionar se a solicitação não for POST
    exit;
}
?>
