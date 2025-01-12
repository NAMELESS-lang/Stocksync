<?php 
require_once('conexao_db.php');
class Relatorios{
    public function itens_vencendo($numero){
        global $pdo;
        $statement = $pdo->prepare('SELECT codigo_barra,nome_item,data_validade,valor 
                                    FROM item WHERE DATEDIFF(data_validade, CURRENT_DATE()) <=20 LIMIT 5 OFFSET :numero');
        $statement->bindValue('numero', $numero,PDO::PARAM_INT);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }   

    public function colunas_itens_vencendo(){
        return ['Código de barras','Nome do item','Data de validade','Valor'];
        }

    public function itens_acabando($numero){
        global $pdo;
        $statement = $pdo->prepare('SELECT codigo_barra,nome_item,data_validade,quantidade FROM item WHERE quantidade <= 50 LIMIT 5 OFFSET :numero');
        $statement->bindValue('numero', $numero, PDO::PARAM_INT);
        $statement->execute();
        $dados = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $dados;
    }

    public function colunas_itens_acabando(){
        return ['Código de barras','Nome do item','Data de validade','Quantidade'];
        }
    
    public function receita_total(){
        global $pdo;
        $statement = $pdo->query('SELECT SUM(valor) FROM item WHERE data_validade > CURRENT_DATE()');
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

