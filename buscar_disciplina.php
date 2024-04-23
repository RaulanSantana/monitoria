<?php
include_once('config.php');

$id_curso = isset($_GET['id_curso']) ? intval($_GET['id_curso']) : 0;
$fase = isset($_GET['fase']) ? intval($_GET['fase']) : 0;

if ($id_curso > 0 && $fase > 0) {
   
    $query = "SELECT id_disciplina, disciplina_nome FROM disciplina WHERE disciplina_curso = ? AND disciplina_fase = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ii", $id_curso, $fase);  // Vincular os parâmetros
    $stmt->execute();
    $resultado = $stmt->get_result();
   

    if ($resultado->num_rows > 0) {
        // Retornar opções para preencher um select
        while ($linha = $resultado->fetch_assoc()) {
            echo "<option value=\"{$linha['id_disciplina']}\">{$linha['disciplina_nome']}</option>";
        }
    } else {
        echo "<option value=\"\">Nenhuma disciplina encontrada</option>";  // Caso não haja resultados
    }

    $stmt->close();  // Fechar o statement
}

$conexao->close();  // Fechar a conexão com o banco de dados
?>