<?php
require_once('item.php');
require_once('user.php');

class Alteracoes{
    protected User $usuario_id;
    protected Item $item_id;
    protected $data_acao;
    protected $hora_acao;
    protected $inicial;
    protected $final;

    public function __construct($usuario,$item,$data_acao, $hora_acao, $inicial = null, $final = null){
        $this->usuario_id = $usuario;
        $this->item_id = $item;
        $this->data_acao = $data_acao;
        $this->hora_acao = $hora_acao;
        $this->inicial = $inicial;
        $this->final = $final;
    }
    
    // getters 
    
    public function getUsuario_id() { return $this->usuario; }

    public function getItem_id() { return $this->item; }

    public function getData_acao() { return $this->data_acao; }

    public function getHora_acao() { return $this->hora_acao; }

    public function getInicial(){ return $this->inicial;}

    public function getFinal(){ return $this->final;}


    // demais funções

    public function next(){
        // esta função realiza a pequisa da próxima sequencia de alterações
    }

    public function voltar(){
        // esta função realiza a pequisa retorna sequencia de alterações já mostradas anteriormente
    }

}

?>