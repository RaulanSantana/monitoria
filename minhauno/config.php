<?php

$host = 'Localhost';
$username ='root';
$senha = '';
$banco = 'monitoriateste';



date_default_timezone_set('America/Sao_Paulo');



$conexao = new mysqli($host,$username,$senha,$banco);
//if($conexao->connect_errno)
//{
  //  echo "erro";
//}
//else{
   // echo "funcionando";
//}
?>