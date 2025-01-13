<?php 
session_start();
require_once('./security/logado.php');

if($_SERVER['REQUEST_METHOD'] == "GET"){
    $mensagens = ['cadastrar_mensagem','cadastrador','item_igual','item_cadastrado','cadastrar_mensagem','consultar_messagem'
                    ,'item_consultado','sucesso_cadastro','login','cadastro','item_modificar','item_atualizacao_sucesso',
                    'sucesso_atualizacao','atualizacao_relatorios_menssagem'];
                    
    if(isset($_GET['pagina'])){
        foreach($mensagens as $ms){
            unset($_SESSION[$ms]);
        }
        header('Location: ../view/templates/inicio.php');
        exit;
    }

    elseif(isset($_GET['cadastrar'])){
            foreach($mensagens as $ms){
                unset($_SESSION[$ms]);
            }
        header('Location: ../view/templates/cadastrar_item.php');
        exit;
    }

    elseif(isset($_GET['consultar'])){
            foreach($mensagens as $ms){
                unset($_SESSION[$ms]);
            }   
        header('Location: ../view/templates/consultar_item.php');
        exit;
    }

    elseif(isset($_GET['perfil'])){
        foreach($mensagens as $ms){
            unset($_SESSION[$ms]);
        }   
    header('Location: ../view/templates/perfil.php');
    exit;

    }elseif(isset($_GET['cadastro'])){
        foreach($mensagens as $ms){
            unset($_SESSION[$ms]);
        }   
    header('Location: ../view/templates/cadastro.php');
    exit;

    }elseif(isset($_GET['atualizar_item'])){
            foreach($mensagens as $ms){
                unset($_SESSION[$ms]);
         }
        parse_str($_GET['item'],$item);
        $_SESSION['item_modificar'] = $item;  
        header('Location: ../view/templates/atualizar_item.php');
        exit;
    }elseif(isset($_GET['pos_atualizar'])){
        echo 'aqui';
            foreach($mensagens as $ms){
                unset($_SESSION[$ms]);
        }
            $_SESSION['item_modificar'] = $item;  
            header('Location: ../view/templates/consultar_item.php');
            exit;
    }
}
?>