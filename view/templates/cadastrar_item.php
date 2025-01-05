<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
require_once('../../controller/security/logado.php');
require_once('../../model/item.php'); 
require_once('../../model/user.php');
$unidades = ['g', 'kg', 't'];
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
        <!-- Corrigido a URL do link "Voltar" -->
        <a href="../../controller/trocar_paginas.php?pagina=inicio"><img src="../images/voltar.png" alt="Voltar"></a>
        <h2>Cadastrar item</h2>
    </header>
    <form action="../../controller/item_manipular.php" method="POST">
        <label for="nome_item">Nome do item: </label>
        <input type="text" name="nome_item" placeholder="Nome do item" required>

        <label for="data_validade">Data de validade: </label>
        <input type="date" name="data_validade" required>

        <label for="categoria">Categoria: </label>
        <input type="text" name="categoria" placeholder="Categoria" required>

        <label for="marca">Marca: </label>
        <input type="text" name="marca" placeholder="Marca" required>

        <label for="peso">Peso:</label>
        <div class="div_peso">
            <select name="peso" required>
                <?php foreach($unidades as $un): ?>
                    <option value="<?= htmlspecialchars($un) ?>"><?= htmlspecialchars($un) ?></option>
                <?php endforeach; ?>
            </select>

            <label class="peso_label" for="peso_valor"></label>
            <input class="peso_input" type="number" name="peso_valor" min="0" placeholder="Peso" required>
        </div>

        <label for="quantidade">Quantidade: </label>
        <input type="number" name="quantidade" min="0" placeholder="Quantidade" required>

        <label for="valor">Valor: </label>
        <input type="text" name="valor" placeholder="Valor" required>

        <div class="div_button">
            <button type="reset">Limpar</button>
            <button type="submit" name="cadastrar_item" value="cadastrar_item">Cadastrar</button>
        </div>
    </form>
    <div class="div_tabelas">
    <section>
        <?php if (isset($_SESSION['cadastrar_mensagem'])): ?>
            <p class="notificacao"><?= htmlspecialchars($_SESSION['cadastrar_mensagem']) ?></p>
        <?php endif; ?>
    </section>

        <?php if (!empty($_SESSION['item_cadastrado']) && !empty($_SESSION['item_igual'])): 
            $user_logado = unserialize($_SESSION['user']);
            $item = unserialize($_SESSION['item_cadastrado']); ?>
            <!-- Item que o usuário está cadastrando -->
            <p>Item a cadastrar</p>
            <table>
                <thead>
                    <tr>
                        <?php foreach($item->retorna_array_buscado_db() as $coluna => $campo): ?>
                            <th><?= htmlspecialchars(ucwords($coluna)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($item->retorna_array_buscado_db() as $coluna => $campo): ?>
                            <td>
                                <?= htmlspecialchars(($coluna == 'data de validade') ? $item->mostrar_data($campo) :
                                    ($coluna == 'Cadastrador' ? $user_logado->get_nome() : $campo)) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>

            <p>Item já cadastrado</p>
            <!-- Item igual -->
            <?php $item_igual = unserialize($_SESSION['item_igual']); ?>
            <table>
                <thead>
                    <tr>
                        <?php foreach($item_igual->retorna_array_buscado_db() as $coluna => $campo): ?>
                            <th><?= htmlspecialchars(ucwords($coluna)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($item_igual->retorna_array_buscado_db() as $coluna => $campo): ?>
                            <td>
                                <?= htmlspecialchars(($coluna == 'Cadastrador') ? $_SESSION['cadastrador']['nome'] :
                                    (($coluna == 'data de validade') ? $item->mostrar_data($campo) : $campo)) ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </tbody>
            </table>

            <form class="form_confirm" action="../../controller/item_manipular.php" method="POST">
                <input class="confirma" type="submit" name="confirmar_cadastro" value="Confirmar">
                <input class="cancelar" type="submit" name="cancelar_cadastro" value="Cancelar">
            </form>

        <?php elseif (!empty($_SESSION['sucesso_cadastro'])): 
            $item_cadastrado = unserialize($_SESSION['sucesso_cadastro']);
            $user_atual = unserialize($_SESSION['user']); ?>
            <p>Item cadastrado</p>
            <table>
                <thead>
                    <tr>
                        <?php foreach($item_cadastrado->retorna_array_buscado_db() as $coluna => $campo): ?>
                            <th><?= htmlspecialchars(ucwords($coluna)) ?></th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($item_cadastrado->retorna_array_buscado_db() as $coluna => $campo): ?>
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
        <?php endif; ?>
    </div>
</body>
</html>
