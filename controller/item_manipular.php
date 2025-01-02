<?php 
session_start();
require_once('../model/user.php');
require_once('../model/erros.php');
require_once('../model/item.php');
require_once('../model/alteracoes.php');

set_error_handler('erros_nao_fatais');
register_shutdown_function('erros_fatais');



if(isset($_POST['cadastrar_item'])){
    try{
        $usuario = unserialize($_SESSION['user']);
        /* 
        Analisa se todos os campos estão preenchidos e faz verificação dos campos(se estão vazios e corrige qualquer entrada de código malicioso).
        */
        foreach($_POST as $chave => $valor){
            if(!empty($valor) && (gettype($valor) == 'string')){
                $_POST[$chave] = filter_var($valor, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                continue;
            }elseif(!empty($valor) && $gettype($valor) == 'float'){
                $_POST[$chave] = filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT);
                continue;
            }else{
                $_SESSION['cadastrar_mensagem'] = 'Preencha todos os campos!';
                header('Location: ../view/templates/cadastrar_item.php');
                exit;
            }
        }

        // Crio o objeto item com os dados do formulário e corrigo o valores inseridos no campos
        $item = new Item($_POST['nome_item'],$_POST['data_validade'],$_POST['categoria'],$_POST['marca'],$_POST['quantidade'],$_POST['peso_valor'],$_POST['valor']);
        $item->setar_codigo_barras();
        $item->trocar_virgula_valor();
        $item->definir_peso($_POST['peso']);
        $item->set_id_cadastrador($usuario->get_id());

        // Crio os objetos que vão inserir tanto na tabela itens quanto na alterações
        $item_db = new Item_db;
        $alteracoes = new Alteracoes_db;

        // Verifica se o item já não está cadastrado na base de dados
        $item_igual = $item_db->buscar_item_igual($item);
        if(!empty($item_igual)){
            $_SESSION['cadastrador'] = $item_db->buscar_user_id($item_igual->get_id_cadastrador());
            $_SESSION['item_igual'] = serialize($item_igual);
            $_SESSION['item_cadastrado'] = serialize($item);
            $_SESSION['cadastrar_mensagem'] = 'O item pode já estar cadastrado, porfavor, verifique e confirme novamente!';
            header('Location: ../view/templates/cadastrar_item.php');
            exit;
        }

        // Cadastra o item na tabela itens, assim como registra na tabela alterações
        $result = $item_db->cadastrar_item($item);
        $result_alt = $alteracoes->cadastrar_alteracao($item,$usuario);
        if($item_db && $result_alt){
            $_SESSION['item_cadastrado'] = serialize($item);
            $_SESSION['cadastrar_mensagem'] = 'Item cadastrado com sucesso!';
            header('Location: ../view/templates/cadastrar_item.php');
            exit;
        }
    }catch(Exception $e){
        $erro = new Erro('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
}