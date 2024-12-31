<?php
class Erros{
    private $nome_erro_mensagem;
    private $nome_arquivo;
    private $linha;
    private $type;

    public function __construct($type,$nome_erro_mensagem, $nome_arquivo, $linha){
        $this->type = $type;
        $this->nome_erro_mensagem = $nome_erro_mensagem;
        $this->nome_arquivo = $nome_arquivo;
        $this->linha = $linha;
    }
    
    //getter

    public function getNome_erro_mensagem() { return $this->nome_erro_mensagem; }
    public function getNome_arquivo() { return $this->nome_arquivo; }
    public function getLinha(){ return $this->linha; }
    public function getType() { return $this->type; }
}


function erros_nao_fatais($errno, $errstr, $errfile, $errline){
    $erro = new Erros($errno, $errstr, $errfile, $errline);
    $_SESSION['erro'] = serialize($erro);
    header('Location: ../view/templates/erro.php');
    exit;
}

function erros_fatais(){
    $erro_fatal = error_get_last();
    if ($erro_fatal != null){
    $erro = new Erros($erro_fatal['type'],$erro_fatal['message'],$erro_fatal['file'],$erro_fatal['line']);
    $_SESSION['erro'] = serialize($erro);
    header('Location: ../view/templates/erro.php');
    exit;
    }
}
