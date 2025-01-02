<?php 

class Item{
    protected $codigo_barra;
    protected $nome_item;
    protected $data_validade;
    protected $categoria;
    protected $marca;
    protected $quantidade;
    protected $peso;
    protected $valor;
    protected $id_cadastrador;

    public function __construct(string $nome_item, string $data_validade, string $categoria, string $marca, int $quantidade, 
    string $peso, string $valor,string $codigo_barra = null, int $id_cadastrador=null)
    {
        $this->nome_item = $nome_item;
        $this->data_validade = $data_validade;
        $this->categoria = $categoria;
        $this->marca = $marca;
        $this->quantidade = $quantidade;
        $this->peso = $peso;
        $this->valor = $valor;
        $this->codigo_barra = $codigo_barra;
        $this->id_cadastrador = $id_cadastrador;
        return;
    }

    // getter

    public function get_codigo_barra(){ return $this->codigo_barra; } 

    public function get_nome_item(){ return $this->nome_item; } 

    public function get_data_validade(){ return $this->data_validade; } 

    public function get_categoria(){ return $this->categoria; } 

    public function get_marca(){ return $this->marca; } 

    public function get_quantidade(){ return $this->quantidade; } 
    
    public function get_valor(){ return $this->valor; } 

    public function get_peso(){ return $this->peso;}

    public function get_id_cadastrador(){ return $this->id_cadastrador; } 

    // setter

    public function set_codigo_barra(string $codigo_barra){ return $this->codigo_barra = $codigo_barra; }

    public function set_nome_item(string $nome_item){ return $this->nome_item = $nome_item; }

    public function set_data_validade(string $data_validade){ return $this->data_validade = $data_validade; }

    public function set_categoria(string $categoria){ return $this->categoria = $categoria; }

    public function set_marca(string $marca){ return $this->marca = $marca; }

    public function set_quantidade(int $quantidade){ return $this->quantidade = $quantidade; }

    public function set_valor(string $valor){ return $this->valor = $valor; }

    public function set_peso(string $peso){ return $this->peso = $peso;}

    public function set_id_cadastrador(int $id_cadastrador) { return $this->id_cadastrador = $id_cadastrador; }

    public function mostrar_data($data_produto){
        $data = new DateTime($data_produto);
        $data_formatada = $data->format('m/d/y');
        return $data_formatada;
    }
    // demais funções

    public function retorna_array(){
        return ['nome do item' => $this->nome_item,'data de validade' => $this->data_validade,'categoria' => $this->categoria,
        'marca' => $this->marca, 'quantidade' => $this->quantidade, 'peso' => $this->peso,'valor' => $this->valor];
    }

    public function retorna_array_buscado_db(){
        return ['Código de barras'=> $this->codigo_barra, 'nome do item' => $this->nome_item,'data de validade' => $this->data_validade,'categoria' => $this->categoria,
        'marca' => $this->marca, 'quantidade' => $this->quantidade, 'peso' => $this->peso,'valor' => $this->valor, 'Cadastrador' => $this->id_cadastrador];
    }

    public function setar_codigo_barras(){
        for($i = 0; $i<10; $i++){
            $valor = mt_rand(0,9);
            $this->codigo_barra.= $valor;
        }
        return;
    }

    public function definir_peso($unidade){
        return $this->peso.=$unidade;
    }

    public function trocar_virgula_valor(){
        for($i=0; $i<strlen($this->valor);$i++){
            if(preg_match('/[,]/',$this->valor[$i])){
                $this->valor[$i] = '.';
            }else{
                continue;
            }
        }
        return;
    }

    public function imprimir_formatado($valor){
        if(gettype($valor == 'string')){
            $valor = floatval($valor);
        } 
        $formatar_moeda = new NumberFormatter('pt-BR', NumberFormatter::CURRENCY); //Crio objeto conversor de moeda
        return $formatar_moeda->formatCurrency($valor,'BRL'); //Converto o valor para moeda real  
    }
}

class Item_db{
    public function inserir_item_cadastrar_alteracao(Item $item,Usuario $user){
        require_once('conexao_db.php');
        require_once('erros.php');
        try{
            $data_atual = new DateTime();
            $pdo->beginTransaction();

            $statement  = $pdo->prepare('INSERT INTO item(codigo_barra,nome_item,data_validade,categoria,marca,quantidade,peso,valor,id_cadastrador) 
                                        VALUES(:codigo_barra,:nome_item,:data_validade,:categoria,:marca,:quantidade,:peso,:valor,:id_cadastrador)');
            $statement->bindValue('codigo_barra',$item->get_codigo_barra());
            $statement->bindValue('nome_item',$item->get_nome_item());
            $statement->bindValue('data_validade',$item->get_data_validade());
            $statement->bindValue('categoria',$item->get_categoria());
            $statement->bindValue('marca',$item->get_marca());
            $statement->bindValue('quantidade',$item->get_quantidade());
            $statement->bindValue('peso',$item->get_peso());
            $statement->bindValue('valor',$item->get_valor());
            $statement->bindValue('id_cadastrador',$item->get_id_cadastrador());
            $statement->execute();
            
            $statement = $pdo->prepare('INSERT INTO alteracoes (usuario_id,codigo_barra_item,data_acao,hora_acao)
                                        VALUES(:usuario_id,:codigo_barra_item,:data_acao,:hora_acao)');
            $statement->bindValue('usuario_id',$user->get_id());
            $statement->bindValue('codigo_barra_item',$item->get_codigo_barra());
            $statement->bindValue('data_acao',$data_atual->format('Y-d-m'));
            $statement->bindValue('hora_acao',$data_atual->format('H:i:s'));
            $statement->execute();

            $pdo->commit();
            return true;
        }catch(Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
    }

    public function buscar_item_igual(Item $item){
        require_once('conexao_db.php');
        require_once('erros.php');
        try{
            $statement  = $pdo->prepare('SELECT * FROM `item` WHERE nome_item = :nome_item AND marca = :marca');
            $statement->bindValue('nome_item',$item->get_nome_item());
            $statement->bindValue('marca',$item->get_marca());
            $statement->execute();
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
            $item_igual = new Item($dados['nome_item'],$dados['data_validade'],$dados['categoria'],$dados['marca'],$dados['quantidade'],
                                    $dados['peso'],$dados['valor'],$codigo_barra = $dados['codigo_barra'],$id_cadastrador = $dados['id_cadastrador']);
            return $item_igual;
        }catch(Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
    }

    public function buscar_user_id($id){
        include('conexao_db.php');
        require_once('erros.php');
        try{
            $statement  = $pdo->prepare('SELECT * FROM `users` WHERE id = :id');
            $statement->bindValue('id',$id);
            $statement->execute();
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
            return $dados;
        }catch(Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
    }
    }

}
