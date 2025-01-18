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

    static public function colunas_tabela(){
        return ['Usuário','Codigo de barras','Data da ação','Hora da ação','Ação realizada'];
    }

}


Class Alteracoes_db{
    public function gera_relatorio_item($categoria, $valor){
        try{
            global $pdo;
            if($categoria == 'Código de Barras'){
                $query = 'SELECT * FROM alteraçoes WHERE codigo_barra = :codigo_barra';
                $statement = $pdo->prepare($query);
                $statement->bindValue('codigo_barra',$valor);
                $statement->execute();
                $dados = $statement->fetchAll();
                return $dados;

            }elseif($categoria == 'Nome do Item'){
                $query = 'SELECT * FROM alteracoes WHERE nome_item = :nome_item';
                $statement = $pdo->prepare($query);
                $statement->bindValue('nome_item',$valor);
                $statement->execute();
                $dados = $statement->fetchAll();
                return $dados;
            
            }else{
                throw Exception('Categoria inválida');
            }
        }
        catch(Exception $e){
            $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
            $_SESSION['erro'] = serialize($erro);
            header('Location: ../view/templates/erro.php');
            exit;
        }
    }

    public function gera_relatorio_user($categoria, $valor){
        try{
            global $pdo;
            if($categoria == 'Nome Do Usuário'){
                $query = 'SELECT * FROM alteracoes WHERE usuario_id = :usuario_id';
                $statement = $pdo->prepare($query);
                $statement->bindValue('usuario_id',$valor);
                $statement->execute();
                $dados = $statement->fetchAll();
                return $dados;

            }elseif($categoria == 'CPF'){
                $query = 'SELECT * FROM alteracoes WHERE cpf = :cpf';
                $statement = $pdo->prepare($query);
                $statement->bindValue('cpf',$valor);
                $statement->execute();
                $dados = $statement->fetchAll();
                return $dados;
            
            }else{
                throw Exception('Categoria inválida');
            }
        }
        catch(Exception $e){
            $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
            $_SESSION['erro'] = serialize($erro);
            header('Location: ../view/templates/erro.php');
            exit;
        }
    }
}

?>