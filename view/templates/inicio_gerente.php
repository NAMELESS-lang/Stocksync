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

// Garante que apenas gerentes possam acessar este página inicial, pois caso usuários do grupo repositores tente acessar pela url está página,
// ele é redirecionado para a página de seu grupo
if($user->get_grupo() == 'repositor'){
    header('Location: inicio.php');
    exit();
}

$relatorios = new Relatorios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="../style/inicio_gerente.css">
</head>
<body>
    <header>
        <a class='a_imagem' href="../../controller/logout.php"><img class="sair" src="../images/sair.png"></a>
        <img src="../images/logo_sistema.png" width="150px" height="150px">
        <p class="ola">Bem-vindo <?= $user->get_nome() ?></p>
        <a href="../../controller/trocar_paginas.php?perfil='perfil'">Perfil</a>
        <a href="../../controller/trocar_paginas.php?cadastrar='cadastrar'">Cadastrar Item</a>
        <a href="../../controller/trocar_paginas.php?consultar='consultar'">Consultar Item</a>
        <a href="../../controller/trocar_paginas.php?relatorios='relatorios'">Relatórios</a>
    </header>
    <div class="container">
            <div class="relatorio_exp_dados">
            <table>
                <thead>
                <tr><th class='titulo_tabelas' colspan = '5'>ITENS VENCENDO</th></tr>
                    <tr>
                        <?php foreach($relatorios->colunas_itens_vencendo() as $coluna):
                            echo  '<th>' .$coluna .'</th>'; 
                        endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                            <?php 
                            if(!empty($relatorios->itens_vencendo())){
                                foreach($relatorios->itens_vencendo() as $item):
                                echo '<tr>';
                                    foreach($item as $coluna => $campo):
                                        echo '<td>';
                                        if ($coluna == 'data_validade') {
                                            echo Item::mostrar_data($campo);
                                        } elseif ($coluna == 'valor') {
                                            echo Item::imprimir_formatado($campo);
                                        } else {
                                            echo $campo;
                                        }
                                        echo '</td>';
                                    endforeach;
                                endforeach;
                                echo '</tr>';
                        }else{
                            echo '<tr> <td colspan = "5">Não há itens para mostrar</td></tr>';
                        }?>
                    </tbody>
                </table>
            </div>
            <div class="relatorio_aca_dados">
            <table>
                <thead>
                <tr><th class='titulo_tabelas' colspan = '5'>ITENS ACABANDO</th></tr>
                    <tr>
                        <?php foreach($relatorios->colunas_itens_acabando() as $coluna):
                            echo  '<th>' .$coluna .'</th>'; 
                        endforeach; ?>
                    </tr>
                    </thead>
                    <tbody>
                            <?php 
                            if(!empty($relatorios->itens_vencendo())){
                                foreach($relatorios->itens_acabando() as $item):
                                echo '<tr>';
                                    foreach($item as $coluna => $campo):
                                        echo '<td>';
                                        if ($coluna == 'data_validade') {
                                            echo Item::mostrar_data($campo);
                                        }elseif ($coluna == 'valor') {
                                            echo Item::imprimir_formatado($campo);
                                        } else{
                                            echo $campo;
                                        }
                                        echo '</td>';
                                        
                                    endforeach;
                                endforeach;
                                echo '</tr>';
                         }else{
                            echo '<tr> <td colspan = "5">Não há itens para mostrar</td></tr>';
                         }?>
                    </tbody>
                </table>
            </div>
            <div class="relatorios_rececita">
                <table class='table2'>
                    <thead>
                        <tr>
                            <th> RECEITA TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr colspan = '4'>
                            <th class = 'receita_celula'> <?= !empty(Item::imprimir_formatado($relatorios->receita_total())) ? Item::imprimir_formatado($relatorios->receita_total())
                            : 'Não há valores para mostrar!'?></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="relatorios_at">
            <?php if (isset($_SESSION['atualizacao_relatorios_menssagem'])): ?>
            <p class="notificacao"><?= htmlspecialchars($_SESSION['atualizacao_relatorios_menssagem']) ?></p>
            <?php endif; ?>
                <a class='button_relatorios' href='../../controller/item_manipular.php?atualizar_relatorios=atualizar_relatorios'>Atualizar relatórios</a>
            </div>
    </div>
</body>
</html>