<?php
 include_once('config.php');

 $id_curso = isset($_GET['id_curso']) ? intval($_GET['id_curso']) : 0;

 if ($id_curso > 0) {
     // Buscar fases do banco de dados com base no ID do curso
     $query = "SELECT DISTINCT disciplina_fase FROM disciplina WHERE disciplina_curso = ?";
     $stmt = $conexao->prepare($query);
     $stmt->bind_param("i", $id_curso);  // Vincular o parâmetro
     $stmt->execute();
     $resultado = $stmt->get_result();
 
     if ($resultado->num_rows > 0) {
         // Retornar opções para preencher um select
         while ($linha = $resultado->fetch_assoc()) {
             echo "<option value=\"{$linha['disciplina_fase']}\">Fase {$linha['disciplina_fase']}</option>";
         }
     } else {
         echo "<option value=\"\">Nenhuma fase encontrada</option>";  // Caso não haja resultados
     }
 
     $stmt->close();  // Fechar o statement
 }
 echo $id_curso;
 $conexao->close();  // Fechar a conexão com o banco de dados
 ?>