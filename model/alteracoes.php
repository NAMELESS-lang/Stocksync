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


Class Alteracoes_db{
    public function cadastrar_alteracao(Item $item, Usuario $user){
        require_once('conexao_db.php');
        require_once('erros.php');
        try{
            $data_atual = new DateTime();
            $statement = $pdo->prepare('INSERT INTO alteracoes (usuario_id,codigo_barra_item,data_acao,hora_acao)
                                                    VALUES(:usuario_id,:codigo_barra_item,:data_acao,:hora_acao)');
            $statement->bindValue('usuario_id',$user->get_id());
            $statement->bindValue('codigo_barra_item',$user->get_codigo_barra());
            $statement->bindValue('data_acao',$data_atual->format('Y-d-m'));
            $statement->bindValue('hora_acao',$data_atual->format('H-i-s'));
            $statement->execute();
            return;
        }catch(Exception $e){
        $erro = new Erro('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
    }
}

?>