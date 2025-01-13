<?php 
require_once('conexao_db.php');
class Relatorios{
    public function itens_vencendo(){
        global $pdo;
        $statement = $pdo->query('SELECT codigo_barra,nome_item,data_validade,quantidade,valor 
                                    FROM item WHERE DATEDIFF(data_validade, CURRENT_DATE()) <=20');
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }   

    public function colunas_itens_vencendo(){
        return ['Código de barras','Nome do item','Data de validade','quantidade','Valor'];
        }

    public function itens_acabando(){
        global $pdo;
        $statement = $pdo->query('SELECT codigo_barra,nome_item,data_validade,quantidade,valor FROM item WHERE quantidade <= 50');
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function colunas_itens_acabando(){
        return ['Código de barras','Nome do item','Data de validade','Quantidade','Valor'];
        }
    
    public function receita_total(){
        global $pdo;
        $statement = $pdo->query('SELECT SUM(valor) FROM item');
        $receita = $statement->fetch(PDO::FETCH_NUM);
        return $receita[0];
    }

    function quantas_linhas_vencendo(){
        global $pdo;
        $statement = $pdo->query('SELECT COUNT(data_validade) 
                                    FROM item WHERE DATEDIFF(data_validade, CURRENT_DATE()) <=20');
        return $statement->fetch(PDO::FETCH_NUM);
    }

}

