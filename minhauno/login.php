<?php
// Recupera a mensagem de erro da URL, se existir
$mensagem = isset($_GET['mensagem']) ? $_GET['mensagem'] : '';

// Exibe a mensagem de erro se estiver definida
//if (!empty($mensagem)) {
 //   echo '<div class="spn"><span>' . htmlspecialchars($mensagem) . '</span></div>';
//}
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
        <img src="images/logo.png" class="Logo" width="220" alt="MinhaUNO">
        <p class="ini">Sua plataforma inteligente.</p>
<form action="testelogin.php" method="POST">
        <div class="inputBox">
            <input type="text" name="email" id="email" class="inputUser" required>
            <label for="email" class="labelInput">email@unochape.edu.br</label>
           </div>

           

           <br><br><br>

           <div class="inputBox">
            <input type="password" name="senha" id="senha" class="inputUser" required>
            <label for="senha" class="labelInput">senha do email</label>
           </div>
<br><br><br>
          
           <div class="spn">
    <?php if(isset($mensagem)) { ?>
        <span><?php echo $mensagem; ?></span>
    <?php } ?>  
</div>
           <br>
           <div>
           <input type="submit" name="submit" value="ENTRAR" id="SM">
        </div>
      </form>
<br><br><br>

        <div>
          <br>
               <a href="">
                   <p class="nc">não consegue acessar sua conta?</p>
               </a>
            </div>
          <div>
            <a href="cadastrar.php" id="ANCORA">Criar uma conta na Unochapecó</a>
          </div>
        </main>
        
    </div>
</body>
</html>