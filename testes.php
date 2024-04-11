
<?php 
include_once('config.php');

$sql = "SELECT 
monitoria.id_monitoria,
curso.curso_nome,
disciplina.disciplina_nome,
disciplina.disciplina_fase,
pessoa.nome_pessoa AS professor,
pessoa_1.nome_pessoa AS monitor
FROM 
monitoria.monitoria
INNER JOIN monitoria.curso ON monitoria.curso = curso.id_curso
INNER JOIN monitoria.disciplina ON monitoria.disciplina = disciplina.id_disciplina
LEFT JOIN monitoria.pessoa ON disciplina.disciplina_professor = pessoa.id_pessoa
LEFT JOIN monitoria.pessoa AS pessoa_1 ON monitoria.monitor = pessoa_1.id_pessoa";

$result = $conexao->query($sql);

// Verificar se a consulta retornou resultados
if ($result->num_rows > 0) {
// Exibir os dados em uma tabela HTML
echo "<table>
<tr>
    <th>ID Monitoria</th>
    <th>Curso</th>
    <th>Disciplina</th>
    <th>Fase</th>
    <th>Professor</th>
    <th>Monitor</th>
</tr>";

// Loop através dos resultados e exibir cada linha
while($row = $result->fetch_assoc()) {
echo "<tr>
    <td>".$row["id_monitoria"]."</td>
    <td>".$row["curso_nome"]."</td>
    <td>".$row["disciplina_nome"]."</td>
    <td>".$row["disciplina_fase"]."</td>
    <td>".$row["professor"]."</td>
    <td>".$row["monitor"]."</td>
</tr>";
}

echo "</table>";
} else {
echo "0 resultados encontrados";
}

?>