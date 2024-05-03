<?php 
if(isset($_POST['submit'])){
    include_once('config.php');
    require_once('hash.class.php');

    $nome= $_POST['nome'];
    $matricula= $_POST['matricula'];
    $email= $_POST['email'];
    $senha1= $_POST['senha1'];
    $senha2= $_POST['senha2'];
    $hash = hash::get_hash($senha1); // classe que transforma a senha criptografada SHA1.
    
    function verificarEmailUnochapeco($email) {
        // Verifica se o e-mail contém "@unochapeco.edu.br"
        if (strpos($email, '@unochapeco.edu.br') !== false) {
            return true; // email valido
        } else {
            return false; // email invalido
        }
    }

    function verificarSenha($senha1, $senha2) {
        if ($senha1 === $senha2) {
            return true; // Senhas iguais
        } else {
            return false; // Senhas diferentes
        }
    }

    if (!verificarEmailUnochapeco($email)) {
        $mensagem = "O e-mail informado não é válido ou não pertence à UNOCHAPECÓ.";
    } elseif (!verificarSenha($senha1, $senha2)) {
        $mensagem = "As senhas não coincidem. Por favor, verifique e tente novamente.";
    } else {
        $query_pessoa = "INSERT INTO pessoa(nome_pessoa, matricula, email, senha) VALUES ('$nome', '$matricula', '$email', '$hash')";

        if (mysqli_query($conexao, $query_pessoa)) {
            // Recupera o ID da pessoa recém-cadastrada
            $id_pessoa = mysqli_insert_id($conexao);
        
            // Inserção na tabela professor ou monitor aqui tenho que alterar o codigo.
           // $query_usuario = "INSERT INTO monitor(monitor_pessoa) VALUES ('$id_pessoa')";

          $query_professor = "INSERT INTO professor(professor_pessoa) VALUES ('$id_pessoa')";
            
            if (mysqli_query($conexao, $query_usuario)) {
                $mensagem1 = "Cadastro realizado com sucesso.";
            } else {
                $mensagem = "Erro inesperado.";
            }
        } else {
            $mensagem = "Erro ao cadastrar.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>

   <main>
    <div class="box">
        <form action="cadastrar.php" method="post">
        <img src="images/logo.png" class="Logo" width="220" alt="MinhaUNO">
        <p class="ini">Sua plataforma inteligente.</p>

        <div class="inputBox">
            <input type="text" name="nome" id="nome" class="inputUser" required>
            <label for="nome" class="labelInput">nome completo</label>
           </div>
           <br><br><br>
           <div class="inputBox">
            <input type="text" name="matricula" id="matricula" class="inputUser" required>
            <label for="matricula" class="labelInput">matricula</label>
           </div>
           <br><br><br>
        <div class="inputBox">
            <input type="text" name="email" id="email" class="inputUser" required>
            <label for="email" class="labelInput">email@unochapeco.edu.br</label>
           </div>

           

           <br><br><br>

           <div class="inputBox">
            <input type="password" name="senha1" id="senha1" class="inputUser" required>
            <label for="senha1" class="labelInput">senha</label>
           </div>
           <br><br><br>
           <div class="inputBox">
            <input type="password" name="senha2" id="senha2" class="inputUser" required>
            <label for="senha2" class="labelInput">confirme a senha</label>
           </div>

           <br><br><br>
           <div>
               <input type="submit" name="submit" value="CADASTRAR" id="c1">
           </div>
           <br><br><br>

           <div>
               <a href="login.php">
                   <p class="nc">voltar a página de login</p>
               </a>
           </div>

           <div class="spn">
           <?php if(isset($mensagem)) {
            ?><span><?php echo $mensagem; ?></span>
               <?php } ?>  
           </div>

           <div class="spn1">
           <?php if(isset($mensagem1)) {
            ?><span><?php echo $mensagem1; ?></span>
               <?php } ?>  
           </div>

           
        </form>
    </div>
</main>
        
</body>
</html>
