<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
// require_once('../../controller/security/logado.php');
require_once('../../model/item.php'); 
$unidades = ['un','g','kg','t'];
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro item</title>
    <link rel="stylesheet" href="../style/cadastrar_item.css">
</head>
<body>
    <header>
        <a href="inicio.php"><img src="../images/voltar.png"></a>
        <h2>Cadastrar item</h2>
    </header>
        <form action="../../controller/item_manipular.php" method="POST">
                <label for="nome_item">Nome do item: </label>
                <input type="text" name="nome_item" placeholder='Nome do item'>

                <label for="data_validade">Data de validade: </label>
                <input type="date" name="data_validade">

                <label for="categoria">Categoria: </label>
                <input type="text" name="categoria" placeholder='Categoria'>

                <label  for="marca">Marca: </label>
                <input  type="text" name="marca" placeholder='Marca'>

                <label for="peso">Peso:</label>
                <div class='div_peso'>
                <select name="peso">
                    <?php foreach($unidades as $un){ ?>
                        <option name="peso"><?= $un ?></option>
                    <?php } ?>
                </select>

                <label class ='peso_label'for="peso_valor"></label>
                <input class='peso_input' type="number" name="peso_valor" min='0' placeholder='Peso'>
                
                </div>
                <label for="quantidade">Quantidade: </label>
                <input type="number" name="quantidade" min="0" placeholder='Quantidade'>

                <label for="valor">Valor: </label>
                <input type="valor" name="valor" placeholder='Valor'>
            <div div_button>
                <button type="reset">Limpar</button>
                <button type="submit" name = "cadastrar_item" value="cadastrar_item">Cadastrar</button>
            </div>
        </form>
        <section>
        <?= (isset($_SESSION['cadastrar_mensagem'])) ? htmlspecialchars($_SESSION['cadastrar_mensagem']) : null; ?>
    </section>
</body>
</html>