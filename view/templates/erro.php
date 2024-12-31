<?php 
require_once('../../model/erros.php');
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
if(isset($_SESSION['erro'])){
    $erro = unserialize($_SESSION['erro']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Erro</title>
    <link rel="stylesheet" href="../style/erro.css">
</head>
<body>
    <div>
    <h2>Tipo:</h2>
    <p><?= $erro->getType();?> </p>
    <h2>Mensagem:</h2>
    <p><?= $erro->getNome_erro_mensagem();?> </p>
    <h2>Arquivo com o erro:</h2>
    <p><?= $erro->getNome_arquivo();?> </p>
    <h2>Linha:</h2>
    <p><?= $erro->getLinha();?> </p>
    </div>
</body>
</html>