<?php 
session_start();
if(!isset($_SESSION['logado']) || $_SESSION['logado'] == false){
    $_SESSION['response'] = 'Usuário não logado!';
    header('Location: ../../view/templates/login.php');
    exit;
}