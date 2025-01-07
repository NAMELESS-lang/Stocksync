<?php 
// Ativa a exibição de erros
ini_set('display_errors', 1);

// Define o nível de erros a serem reportados (todos os tipos de erros)
error_reporting(E_ALL);

session_start();
require('../../model/item.php');
$pesquisar_por = ['código de barra' => 'codigo_barra','nome do item' => 'nome_item'];
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
        <a href="../../controller/trocar_paginas.php?pagina='inicio'"><img src="../images/voltar.png"></a>
        <h2>Consultar item</h2>
    </header>
    <div>

    <!-- Quando o usuário pesquisa algum item e ele é encontrado, este formulário é impresso a ele, o que muda de um para o outro é o estilo aplicado -->
    <?php if(!empty($_SESSION['consultar_messagem'])) { ?> <p class='notificacao'> <?= $_SESSION['consultar_messagem'] ?> </p>
        <form action="../../controller/item_manipular.php" method ='POST'>
            <select name="pesq_por">
                <?php foreach($pesquisar_por as $coluna => $registro) { ?>
                        <option name="pesq_por"><?= ucwords($coluna) ?></option>
                        <?php } ?>
            </select> 
        <input type="text" name ='item_pesq' required>

        <button type='submit' name='consultar'>Consultar</button>
    </form>


    <!-- Formulário que é apresentado inicialmente para o usuário -->
    <?php }else{?>
    <form class='form_2' action="../../controller/item_manipular.php" method ='POST'>
            <select name="pesq_por">
                <?php foreach($pesquisar_por as $coluna => $registro) { ?>
                        <option name="pesq_por"><?= ucwords($coluna) ?></option>
                        <?php } ?>
            </select> 
        <input type="text" name ='item_pesq' required>

        <button class='button_2'type='submit' name='consultar'>Consultar</button>
    </form>
    <?php }?>


    <!-- Mostra os itens retornados -->
    <?php if(!empty($_SESSION['item_consultado'])){ 
        $contador = 1;?>
    <?php foreach($_SESSION['item_consultado'] as $item){
        implode($item) ?>
        <div class='div_2'>
            <p><?='Item '.$contador ?></p>
            <a class='ancora_atualizar_item' href="../../controller/trocar_paginas.php?
            atualizar_item='atualizar_item'&item=<?php echo urlencode(http_build_query($item))?>">Alterar</a>
        </div>
            <table>
                <thead>
                    <tr>
                        <?php foreach(Item::retorna_titulos_campos() as $coluna){ ?>
                                <th><?= ucwords($coluna)?></th>
                        <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php foreach($item as $coluna => $campo){ ?>
                          <td>  <?php if($coluna == 'data_validade'){
                            ?>
                           <?= Item::mostrar_data($campo); ?>
                                <?php }elseif($coluna == 'valor'){  ?>
                                <?= Item::imprimir_formatado($campo); ?>
                                    <?php } else{ ?>
                                    <?= $campo;?>
                    <?php } ?>
                            </td>
                            <?php }?>
                    </tr>
                </tbody>
            </table>
    <?php
    $contador++;
        }?>                 
    <?php }?>
    </div>
</body>
</html>