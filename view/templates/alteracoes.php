<?php 
require_once('../../model/user.php');
require_once('../../model/item.php');
require_once('../../model/alteracoes.php');
session_start();
$pesquisar_por = ['Código de barras'=>'codigo_barras','Nome do Item'=>'nome_item','Nome do usuário'=>'nome','CPF'=>'cpf'];
?>
<!DOCTYPE html>
<html lang="ptbr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios do alterações</title>
    <link rel="stylesheet" href="../style/relatorio.css">
</head>
<body>
    <header>
        <a href="../../controller/trocar_paginas.php?pagina='inicio'"><img src="../images/voltar.png"></a>
        <h2>Relatórios de alterações</h2>
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

        <button type='submit' name='relatorio'>Consultar</button>
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

        <button class='button_2'type='submit' name='relatorio'>Consultar</button>
    </form>
    <?php }?>


    <!-- Mostra os itens retornados -->
    <?php if(!empty($_SESSION['alteracao'])){
        $alteracao = $_SESSION['alteracao'];
        ?>
            <table>
                <thead>
                    <?php foreach(Alteracoes::colunas_tabela() as $colunas){ ?>
                    <tr>
                        <?= $coluna ?>
                    </tr>
                    <?php } ?>
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
        <?php }?>
    </div>
</body>
</html>