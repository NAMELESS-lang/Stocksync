<?php 
$tipo_soft = 'mysql';
$servidor = 'localhost';
$nome_db = 'projeto';
$porta = '3306';
$tipo_caracter = 'utf8mb4';

$config_db = "$tipo_soft:host=$servidor;dbname=$nome_db;port=$porta;charset=$tipo_caracter";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

try{
    $pdo = new PDO($config_db, 'root','matheuscolla',$options);
}catch(Exception $e){
    $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
    $_SESSION['erro'] = serialize($erro);
    header('Location: ../view/templates/erro.php');
    exit;
}


// $statement = $pdo->prepare("INSERT INTO users(nome,cpf,funcao,grupo,senha) VALUES(:nome,:cpf,:funcao,:grupo,:senha)");
// $statement->bindValue('nome','oia');
// $statement->bindValue('cpf','391823');
// $statement->bindValue('funcao','doido');
// $statement->bindValue('grupo','aodkao');
// $statement->bindValue('senha','sajsdijasj');
// $statement->execute();