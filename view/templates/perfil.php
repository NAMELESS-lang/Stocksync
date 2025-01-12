<?php
session_start();
require_once('../../model/user.php');
require_once('../../controller/security/logado.php');
if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="../style/perfil.css">
</head>
<body>
    <header>
        <a href="../../controller/trocar_paginas.php?pagina='inicio'"><img src="../images/voltar.png"></a>
        <h2>Perfil</h2>
    </header>
    <p class='notificacao'><?= !empty($_SESSION['perfil'])? $_SESSION['perfil']:null ?></p>
    <div class='div_container'>
        <img class='perf_img' src="../images/user.png">
        <div>
        <table>
    <tr>
        <th>Nome</th>
        <td><?= $user->get_nome() ?></td>
    </tr>
    <tr>
        <th>Cpf</th>
        <td><?= $user->get_cpf() ?></td>
    </tr>
    </table>
        </div>

        <div class='div_left'>
        <table>
    <tr>
        <th>Função</th>
        <td><?= ($user->get_funcao() == 'repositor') ? 'Repositor' : (($user->get_grupo() == 'gerente_de_estoque') ? 'Gerente de Estoque':null) ?></td>
    </tr>
    <tr>
        <th>Grupo</th>
        <td>
    <?= ($user->get_grupo() == 'repositor') ? 'Repositores' : (($user->get_grupo() == 'gerente_de_estoque') ? 'Gerentes' : null) ?> </td>

    </tr>
    </table>
        </div>
    </div>
    <fieldset>
    <h2>Atualizar senha</h2>
    <form action="../../controller/login_cadastro.php" method ='POST'>
        <label for="senha_atual">Senha atual:</label>
        <input type="password" name = 'senha_atual'required>

        <label for="nova_senha">Nova senha:</label>
        <input type="password" name = 'nova_senha'required>

        <button type='submit' name = 'atualizar_senha' value = 'atualizar_senha'>Atualizar senha</button>
    </form>
    </fieldset>
</body>
</html>