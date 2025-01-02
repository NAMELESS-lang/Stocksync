<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
require_once('../../controller/security/logado.php');
require_once('../../model/item.php'); 
$unidades = ['g','kg','t'];
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
                <input type="text" name="valor" placeholder='Valor'>
            <div class='div_button'>
                <button type="reset">Limpar</button>
                <button type="submit" name = "cadastrar_item" value="cadastrar_item">Cadastrar</button>
            </div>
        </form>
        <div>
        <section>
        <p class='notificacao'><?= (isset($_SESSION['cadastrar_mensagem'])) ? htmlspecialchars($_SESSION['cadastrar_mensagem']) : null; ?></p>
    </section>
    <div class='div_tabelas'>
    <p>Item a cadastrar</p>
    <?php if(!empty($_SESSION['item_cadastrado'])){
            $item = unserialize($_SESSION['item_cadastrado']);?>
            <table>
                <thead>
                    <tr>
                    <?php foreach($item->retorna_array() as $coluna => $campo){ ?>
                            <th><?= ucwords($coluna) ?></th>
                    <?php }?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <?php foreach($item->retorna_array() as $coluna => $campo){ ?>
                            <td><?= $coluna == 'data de validade'? $item->mostrar_data($campo):$campo ?></td>
                    <?php } ?>
                    </tr>
                </tbody>
            </table>
        <? }?>

    <p>Item já cadastrado</p>
    <?php if(!empty($_SESSION['item_igual'])){ 
        $item_igual = unserialize($_SESSION['item_igual'])?>
        <table>
            <thead>
                <tr>
                    <?php foreach($item_igual->retorna_array_buscado_db() as $coluna => $campo){ ?>
                            <th><?=  ucwords($coluna)?></th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <tr>
                <?php foreach($item_igual->retorna_array_buscado_db() as $coluna => $campo){ ?>
                        <td><?= ($coluna == 'Cadastrador') ? $_SESSION['cadastrador']['nome'] : (($coluna == 'data de validade') ? $item->mostrar_data($campo) : $campo) ?></td>
                <?php } ?>
                </tr>
            </tbody>
        </table>
        <?php } ?>
        </div>
        <form class='form_confirm' action="../../controller/item_manipular.php" method="POST">
            <input class='confirma' type="submit" name = 'confirmar_cadastro' value="Confirmar">
            <input class='cancelar'type="submit" name = 'cancelar_cadastro' value="Cancelar">
        </form>
    </div>
</body>
</html>
<!-- <?php } ?> -->