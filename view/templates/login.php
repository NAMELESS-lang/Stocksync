<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../style/login.css">
</head>
<body>
    <?php if(isset($_SESSION['login'])) { ?>
        <h3> <?= $_SESSION['login'] ?> </h3>
    <?php } ?>
    <div>
        <img src="../images/logo_sistema.png">
        <form action="/stocksync/controller/login_cadastro.php" method="POST">
            <h1>Login</h1>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" placeholder="Digite aqui seu cpf">
            <label for="senha">Senha:</label>
            <input type="text" name="senha" placeholder="Digite aqui sua senha">
            <button type="submit" name="logar" value="logar">Entrar</button>
        </form>
    </div>
    <a href="cadastro.php">Cadastrar-se</a>
    </body>
</html>