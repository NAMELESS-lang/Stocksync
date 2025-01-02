<?php 
session_start();
require_once('../../controller/security/logado.php');
require_once('../../model/user.php');
require_once('../../model/item.php');

if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="../style/inicio.css">
</head>
<body>
    <header>
        <a class='a_imagem' href="../../controller/logout.php"><img class="sair" src="../images/sair.png"></a>
        <img src="../images/logo_sistema.png" width="150px" height="150px">
        <p class="ola">Bem-vindo <?= $user->get_nome() ?></p>
        <a href="perfil.php">Perfil</a>
        <a href="cadastrar_item.php">Cadastrar Item</a>
        <a href="consultar_item.php">Consultar Item</a>
    </header>
    <div class="container">

            <div class="relatorio_exp_dados">
            <h1>Data validade expirando</h1>
                <p>corsa</p>
            </div>

            <div class="relatorio_aca_dados">
                <h1>Itens acabando</h1>
                <p>celta</p>
            </div>

            <div class="relatorios_rececita">
                <h1 class='h1_2'>Receita total</h1>
                <p>palio</p>
            </div>
            <div class="relatorios_quant">
                <h1 class='h1_2'>Quantidade total em estoque</h1>
                <p>gol</p>
            </div>

    </div>
</body>
</html>