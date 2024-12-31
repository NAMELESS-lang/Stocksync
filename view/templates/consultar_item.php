<?php 

session_start();


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar item</title>
    <link rel="stylesheet" href="../style/consultar_item.css">
</head>
<body>
    <header>
        <a href="inicio.php"><img src="../images/voltar.png"></a>
        <h2>Consultar item</h2>
    </header>

    <form action="../../controller/item_manipular.php" method ='POST'>
        <label for="nome_item">Nome do item: </label>
        <input type="text" name ='nome_item'>

        <button type='submit'>Consultar</button>
    </form>

</body>
</html>