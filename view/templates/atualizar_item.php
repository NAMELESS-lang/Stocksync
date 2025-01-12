<?php
require_once('../../model/item.php');
require_once('../../model/user.php');
session_start();
ini_set('display_errors', 1);

// Define o nível de erros a serem reportados (todos os tipos de erros)
error_reporting(E_ALL);
$unidades = ['g', 'kg', 't'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar item</title>
    <link rel="stylesheet" href="../style/atualizar_item.css">
</head>
<body>
<header>
        <a href="../../controller/trocar_paginas.php?pagina='inicio'"><img src="../images/voltar.png"></a>
        <h2>Atualizar item</h2>
</header>
<!-- Imprime o formulário com os valores já definidos do item a atualizar -->
    <?php if(!empty($_SESSION['item_modificar'])){ 
        $item = $_SESSION['item_modificar'];
        ?>
         <?php if(!empty($_SESSION['cadastrar_mensagem'])){ 
            echo $item = $_SESSION['cadastrar_mensagem'];
         }?>
            
         <form action="../../controller/item_manipular.php" method="POST">
         <label for="nome_item">Nome do item: </label>
         <input type="text" name="nome_item" value='<?= $item['nome_item'] ?>' required>
 
         <label for="data_validade">Data de validade: </label>
         <input type="date" name="data_validade" value='<?= $item['data_validade'] ?>' required>
 
         <label for="categoria">Categoria: </label>
         <input type="text" name="categoria" value='<?= $item['categoria'] ?>' required>
 
         <label for="marca">Marca: </label>
         <input type="text" name="marca"  value='<?= $item['marca'] ?>' required>
 
         <label for="peso">Peso:</label>
         <div class="div_peso">
             <select name="peso" required>
                 <?php foreach($unidades as $un): ?>
                     <option value="<?= htmlspecialchars($un) ?>"><?= htmlspecialchars($un) ?></option>
                 <?php endforeach; ?>
             </select>
 
             <label class="peso_label" for="peso_valor"></label>
             <input class="peso_input" type="text" name="peso_valor" min="0" value='<?= Item::remover_unidade_peso($item['peso']) ?>' required>
         </div>
 
         <label for="quantidade">Quantidade: </label>
         <input type="number" name="quantidade" min="0"  value='<?= $item['quantidade'] ?>' required>
 
         <label for="valor">Valor: </label>
         <input type="text" name="valor"  value='<?= $item['valor'] ?>' required>
 
         <div class="div_button">
             <button type="reset">Limpar</button>
             <button type="submit" name="atualizar_item" value="atualizar_item">Atualizar</button>
         </div>
     </form>
    <?php }?>

    <div class="div_tabelas">
    <!-- Notificação do sucesso na atualização do item -->
    <?php if (isset($_SESSION['sucesso_atualizacao'])): ?>
            <p class="notificacao"><?= htmlspecialchars($_SESSION['sucesso_atualizacao']) ?></p>
        <?php endif; ?>


    <!-- Mostra o item atualizado -->
    <?php if (!empty($_SESSION['item_atualizacao_sucesso'])): 
            $item_atualizado = $_SESSION['item_atualizacao_sucesso'];
            $user_atual = unserialize($_SESSION['user']); ?>
            <p>Item atualizado</p>
            <table>
                <thead>
                    <tr>
                        <?php foreach(Item::retorna_titulos_campos() as $coluna): ?>
                            <th><?= ucwords($coluna) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($item_atualizado as $coluna => $campo): ?>
                            <td>
                                <?= htmlspecialchars(
                                    ($coluna == 'Cadastrador') ? $user_atual->get_nome() : 
                                    (($coluna == 'data de validade') ? Item::mostrar_data($campo) : 
                                    (($coluna == 'valor') ? Item::imprimir_formatado($campo) : $campo))
                                ) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>
            <a class='sair' href="../../controller/trocar_paginas.php?pos_atualizar=pos_atualizar">Sair</a>
        <?php endif; ?>
    </div>
</body>
</html>