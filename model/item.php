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
    string $peso, float $valor,string $codigo_barra = null, int $id_cadastrador=null)
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

    public function get_id_cadastrador(){ return $this->id_cadastrador; } 

    // setter

    public function set_codigo_barra(string $codigo_barra){ return $this->codigo_barra = $codigo_barra; }

    public function set_nome_item(string $nome_item){ return $this->nome_item = $nome_item; }

    public function set_data_validade(string $data_validade){ return $this->data_validade = $data_validade; }

    public function set_categoria(string $categoria){ return $this->categoria = $categoria; }

    public function set_marca(string $marca){ return $this->marca = $marca; }

    public function set_quantidade(int $quantidade){ return $this->quantidade = $quantidade; }

    public function set_valor(string $valor){ return $this->valor = $valor; }

    public function set_id_cadastrador(int $id_cadastrador) { return $this->id_cadastrador = $id_cadastrador; }


    // demais funções

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

}
