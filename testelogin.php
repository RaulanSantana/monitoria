<?php
session_start(); // Inicia a sessão para poder armazenar os dados do professor ou monitor

if (isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['senha'])) {
    include_once('config.php');
    require_once('hash.class.php');

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Validar se o e-mail está em um formato válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensagem = "E-mail inválido.";
        header("Location: login.php?mensagem=".urlencode($mensagem));
        exit();
    }

    // Verificar se o e-mail e senha correspondem a um registro na tabela pessoa
    $query = "SELECT id_pessoa, nome_pessoa, matricula, senha FROM pessoa WHERE email = ?";
    $stmt = mysqli_prepare($conexao, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $id_pessoa = $row['id_pessoa'];
        $nome_pessoa = $row['nome_pessoa'];
        $matricula = $row['matricula'];
        $senha_hash = $row['senha'];

        // Verificar se a senha está correta usando a classe de hash
        if (hash::check_hash($senha, $senha_hash)) {
            // Buscar o ID do professor associado à pessoa
            $query_professor = "SELECT id_professor FROM professor WHERE professor_pessoa = ?";
            $stmt_professor = mysqli_prepare($conexao, $query_professor);
            mysqli_stmt_bind_param($stmt_professor, "i", $id_pessoa);
            mysqli_stmt_execute($stmt_professor);
            $result_professor = mysqli_stmt_get_result($stmt_professor);

            // Buscar o ID do monitor associado à pessoa
            $query_monitor = "SELECT id_monitor FROM monitor WHERE monitor_pessoa = ?";
            $stmt_monitor = mysqli_prepare($conexao, $query_monitor);
            mysqli_stmt_bind_param($stmt_monitor, "i", $id_pessoa);
            mysqli_stmt_execute($stmt_monitor);
            $result_monitor = mysqli_stmt_get_result($stmt_monitor);

            if ($result_professor && mysqli_num_rows($result_professor) > 0) {
                // O usuário é um professor
                $_SESSION['nome_pessoa'] = $nome_pessoa; // Armazena o nome do professor
                $_SESSION['matricula'] = $matricula; // Armazena a matrícula do professor
                $_SESSION['id_pessoa'] = $id_pessoa;


                // Redirecionar para a página de perfil do professor
                header("Location: inicioprofessor.php");
                exit();
            } elseif ($result_monitor && mysqli_num_rows($result_monitor) > 0) {
                // O usuário é um monitor
                $_SESSION['nome_pessoa'] = $nome_pessoa; // Armazena o nome do monitor
                $_SESSION['matricula'] = $matricula; // Armazena a matrícula do monitor
                $_SESSION['id_pessoa'] = $id_pessoa;

                // Redirecionar para a página de perfil do monitor
                header("Location: iniciomonitor.php");
                exit();
            } else {
                // Não foi encontrado um registro na tabela professor ou monitor para esta pessoa
                $mensagem = "Usuário não é um professor ou monitor.";
                header("Location: login.php?mensagem=".urlencode($mensagem));
                exit();
            }
        } else {
            // Senha incorreta
            $mensagem = "Senha incorreta.";
            header("Location: login.php?mensagem=".urlencode($mensagem));
            exit();
        }
    } else {
        // E-mail não encontrado na tabela pessoa
        $mensagem = "E-mail não cadastrado.";
        header("Location: login.php?mensagem=".urlencode($mensagem));
        exit();
    }
} else {
    // Os campos e-mail e senha não foram enviados
    $mensagem = "Por favor, preencha todos os campos.";
    header("Location: login.php?mensagem=".urlencode($mensagem));
    exit();
}
?>
