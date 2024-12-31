<?php 
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once('../model/user.php');
require_once('../model/erros.php');
require_once('../model/item.php');
require_once('../model/alteracoes.php');

set_error_handler('erros_nao_fatais');
register_shutdown_function('erros_fatais');


if(isset($_POST['cadastrar_item'])){
    try{
        // $usuario = unserialize($_SESSION['user']);
        /* 
        Analisa se todos os campos estão preenchidos e faz verificação dos campos(se estão vazios e corrige qualquer entrada de código malicioso).
        */
        $vazio = false;
        foreach($_POST as $chave => $valor){
            if(!empty($valor) && (gettype($valor) == 'string')){
                $_POST[$chave] = filter_var($valor, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                continue;
            }elseif(!empty($valor) && $gettype($valor) == 'float'){
                $_POST[$chave] = filter_var($valor, FILTER_SANITIZE_NUMBER_FLOAT);
                continue;
            }else{
                $vazio = true;
            }
        }
        if($vazio != false){
            $_SESSION['cadastrar_mensagem'] = 'Preencha todos os campos!';
            header('Location: ../view/templates/cadastrar_item.php');
            exit;
        }
        $item = new Item($_POST['nome_item'],$_POST['data_validade'],$_POST['categoria'],$_POST['marca'],$_POST['quantidade'],$_POST['peso_valor'],$_POST['valor']);
        $item->setar_codigo_barras();
        $formatar_moeda = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY); //Crio objeto conversor de moeda
        $item->set_valor($formatar_moeda->formatCurrency($item->get_valor(),'BRL')); //Converto o valor para o padrão
        $item->definir_peso($_POST['peso']);
        // $item->set_id_cadastrador($usuario->get_id());


        //cria objeto alterações e cadastra nas duas tabelas(alterações e itens)
        
        header('Location: ../view/templates/cadastrar_item.php');
        exit;
    }catch(Exception $e){
        $erro = new Erro('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
}