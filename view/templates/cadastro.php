<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../style/cadastro.css">
</head>
<body>
        <section>
            <p> <?= isset($_SESSION['cadastro'])? htmlspecialchars($_SESSION['cadastro']):null; ?> </p>
        </section>
    <div>
    <h1>Cadastro</h1>
    <form action="/stocksync/controller/login_cadastro.php" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" name = "nome" placeholder="Digite aqui seu nome">
        <label for="CPF">CPF:</label>
        <input type="text" name="CPF" placeholder="Digite aqui seu cpf" required>
        <label for="funcao">Função</label>
        <select name="funcao" required>
            <option value="repositor">Repositor</option>
            <option value="gerente_de_estoque">Gerente de estoque</option>
        </select>
        <label for="senha">Senha:</label>
        <input type="password" placeholder="Digite aqui sua senha" name = "senha" required>
        <button type="submit" name="cadastrar" value="cadastrar">Cadastrar-se</button>
    </form>
    </div>
    <a href="login.php">Login</a>
</body>
</html>