<?php
// Inicia a sessão
session_start();

// Destroi a sessão
session_destroy();

// Redireciona para a página de login (ou para onde você desejar)
header("Location: login.php");
exit;
?>
