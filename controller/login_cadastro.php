<?php 
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
session_start();
require_once('../model/erros.php');
require_once('../model/user.php');

set_error_handler('erros_nao_fatais');
register_shutdown_function('erros_fatais');

if (isset($_POST['cadastrar'])){
    try{
        foreach($_POST as $campo => $valor){ // Faz verificação dos campos(se estão vazios e corrige qualquer entrada de código malicioso).
            if (!empty($_POST[$campo])){
                $valor = filter_var($valor,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $_POST[$campo]=$valor;
            }else{
                $_SESSION['cadastro'] = 'Preencha todos os campos!';
                header('Location: ../view/templates/cadastro.php');
                exit;
            }
        }
        /* 
        Cria um objeto usuário, faz correções de ortografia, define um grupo baseado na 
        função e por fim valida se a senha se enquadra nos requisitos.
        */
        $usuario = new Usuario($_POST['nome'], $_POST['CPF'], $_POST['funcao']); 
        $usuario->set_nome(ucwords($usuario->get_nome()));
        $usuario->definir_grupo();
        $validar_cpf = $usuario->valir_cpf();
        if($validar_cpf !== true){
            $_SESSION['cadastro'] = $validar_cpf;
            header('Location: ../view/templates/cadastro.php');
            exit;
        }
        if(!$usuario->validar_senha($_POST['senha'])){
            $_SESSION['cadastro'] = 'A senha deve conter no mínimo 8 digitos letras maiúsculas, minúsculas e números!';
            header('Location: ../view/templates/cadastro.php');
            exit;
        }
        // Crio um objeto da classe Usuario_db que irá inserir o usuário no banco de dados
        $us_db = new Usuario_db;
        if($us_db->cadastrar_user($usuario,$_POST['senha'])){
            $_SESSION['cadastro'] = 'Cadastro feito com sucesso!';
            header('Location: ../view/templates/cadastro.php');
            exit;
        }
    }
    catch (Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
}
elseif(isset($_POST['logar'])){
    try{
        foreach($_POST as $campo => $valor){
            if (!empty($_POST[$campo])){
                $valor = filter_var($valor,FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $_POST[$campo]=$valor;
            }else{
                $_SESSION['cadastro'] = 'Preencha todos os campos!';
                header('Location: ../view/templates/cadastro.php');
                exit;
            }
        }   
            $us_db = new Usuario_db;
            $dados = $us_db->buscar_cpf_validar($_POST['cpf'],$_POST['senha']);
            if($dados == false){
                $_SESSION['cadastro'] = 'Cpf ou senha incorretos!';
                header('Location: ../view/templates/cadastro.php');
                exit;
            }else{
                $user = new Usuario($dados['nome'],$dados['cpf'],$dados['funcao'],$dados['grupo']);
                $user->set_id($dados['id']);
                $_SESSION['user'] = serialize($user);
                $_SESSION['logado'] = true;
                header('Location: ../view/templates/inicio.php');
                exit;
            }
    }catch (Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }

}
?>