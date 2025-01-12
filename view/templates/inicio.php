<?php 

ini_set('display_errors', 1);

// Define o nível de erros a serem reportados (todos os tipos de erros)
error_reporting(E_ALL);
require_once('../../controller/security/logado.php');
require_once('../../model/user.php');
require_once('../../model/item.php');
require_once('../../model/relatorios.php');

if(isset($_SESSION['user'])){
    $user = unserialize($_SESSION['user']);
}

$relatorios = new Relatorios();
if(!isset($_SESSION['lista_vencendo'])){
    $_SESSION['lista_vencendo']=0;
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
        <a href="../../controller/trocar_paginas.php?perfil='perfil'">Perfil</a>
        <a href="../../controller/trocar_paginas.php?cadastrar='cadastrar'">Cadastrar Item</a>
        <a href="../../controller/trocar_paginas.php?consultar='consultar'">Consultar Item</a>
    </header>
    <div class="container">

            <div class="relatorio_exp_dados">
            <table>
                <thead>
                    <tr>
                        <?php foreach($relatorios->colunas_itens_vencendo() as $coluna):
                            echo  '<th>' .$coluna .'</th>'; 
                        endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                        
                            <?php 
                            if(!empty($relatorios->itens_vencendo($_SESSION['lista_vencendo']))){
                            foreach($relatorios->itens_vencendo($_SESSION['lista_vencendo']) as $item):
                            echo '<tr>';
                                foreach($item as $coluna => $campo):
                                    echo '<td>'.$campo.'</td>';
                                endforeach;
                            endforeach;
                            echo '</tr>';
                        }else{
                            echo '<tr> <td>Não há mais itens para mostrar</td></tr>';
                        }?>
                    </tbody>
                </table>
                <?php if($_SESSION['lista_vencendo'] < $relatorios->quantas_linhas_vencendo()[0]){?>
                <a href="../../controller/item_manipular.php?proximo_venc='proximo_venc'">Pŕoximo</a>
                <?php } ?>
                <?php if($_SESSION['lista_vencendo'] > 0){ ?>
                <a href="../../controller/item_manipular.php?anterior_venc='anterior_venc'">Anterior</a>
                    <?php } ?>
            </div>
            <div class="relatorio_aca_dados">
            <table>
                <thead>
                    <tr>
                        <?php foreach($relatorios->colunas_itens_acabando() as $coluna):
                            echo  '<th>' .$coluna .'</th>'; 
                        endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                            <?php foreach($relatorios->itens_acabando(5) as $item):
                            echo '<tr>';
                                foreach($item as $coluna => $campo):
                                    echo '<td>'.$campo.'</td>';
                                endforeach;
                            endforeach;
                            echo '</tr>';
                            ?>
                    </tbody>
                </table>
            </div>
            <div class="relatorios_rececita">
                <table>
                    <thead>
                        <tr>
                            <th> Receita total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th> <?= $relatorios->receita_total()?></th>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="relatorios_quant">
            <table>
                    <tr>
                    <th>
                        Itens acabando
                    </th>
                    </tr>
                    <tr>
                    <td>
                        Item
                    </td>
                    </tr>
            </table>
            </div>
    <a class='button_relatorios' href='../../controller/item_manipular.php?atualizar_relatorios=atualizar_relatorios'>Atualizar relatórios</a>
    </div>
</body>
</html>