<?php 
class Usuario{
    protected $id;
    protected $nome;
    protected $cpf;
    protected $funcao;
    protected $grupo;

    public function __construct(string $nome, string $cpf, string $funcao, string $grupo = null, int $id = null){
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->funcao = $funcao;
        $this->grupo = $grupo;
        return;
    }

    // getter

    public function get_id(){ return $this->id; } 

    public function get_nome():string{ return $this->nome; } 

    public function get_cpf():string{ return $this->cpf; }

    public function get_funcao():string{ return $this->funcao; }

    public function get_grupo():string{ return $this->grupo; }

    // setter

    public function set_id(int $id){ return $this->id = $id; } 

    public function set_nome(string $nome){ return $this->nome = $nome; }
    
    public function set_cpf(string $cpf){ return $this->cpf = $cpf; }

    public function set_funcao(string $funcao){ return $this->funcao = $funcao; }

    public function set_grupo(string $grupo){ return $this->grupo = $grupo; }

    public function definir_grupo(){
         /*
        Esta função define a que grupo pertence o usuário de acordo com a função selecionada no cadastro
        */
        if($this->funcao == 'repositor'){
            return $this->grupo = "repositor";
        }
        elseif($this->funcao = 'gerente_de_estoque'){
            return $this->grupo = 'gerente_de_estoque';
        }
    }

    public function validar_senha($senha){
        /*
        Esta função verifica se a senha preenchia contém 8 dígitos, caracteres maiúsculos ,minúsculos e números, se sim retorna true senão false
        */
        if ($senha >= 8){
            if (preg_match('/[a-z]/',$senha) && preg_match('/[0-9]/',$senha) && preg_match('/[A-Z]/',$senha)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function valir_cpf(){

        // Esta função valida se o cpf possui os dois pontos e o hífen, assim como se não há nenhuma letra contida

        $digitos = ['p'=>0,'t'=>0,'n'=>0];
        for($i=0;$i<strlen($this->cpf);$i++){
            if(preg_match('/[.]/',$this->cpf[$i])){
                $digitos['p']++;
            }elseif(preg_match('/[-]/',$this->cpf[$i])){
                $digitos['t']++;
            }elseif(preg_match('/[a-z]/',$this->cpf[$i]) || preg_match('/[A-Z]/',$this->cpf[$i])){
                return 'Digite apenas números no cpf!';
            }else{
                $digitos['n']++;
            }
        }
            if(($digitos['p'] == 2 && $digitos['t'] == 1) && ($digitos['n']== 11)){
                return true;
            }elseif($digitos['n']> 11 || $digitos['n']< 11){
                return 'O cpf precisa de 11 números!';
            }else{
                return 'O cpf precisa de 2 pontos e um hífen!';
            }
    }

    }
    
class Usuario_db{
    public function cadastrar_user(Usuario $user,$senha){

        // Função responsável por cadastrar o usuário no sistema

        require_once('erros.php');
        require_once('conexao_db.php');
        try{
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $statement = $pdo->prepare('INSERT INTO users(nome,cpf,funcao,grupo,senha) VALUES(:nome,:cpf,:funcao,:grupo,:senha)');
            $statement->bindValue('nome',$user->get_nome());
            $statement->bindValue('cpf',$user->get_cpf());
            $statement->bindValue('funcao',$user->get_funcao());
            $statement->bindValue('grupo',$user->get_grupo());
            $statement->bindValue('senha',$senha);
            $statement->execute();
            return true;
        }catch (Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
        }
    }

    public function buscar_cpf_validar($cpf,$senha){

        /* Função responsável por realizar o login do usuário, buscando seu cpf e verificando se a senha digitada no formulário de login
        é igual a do banco de dados */

        require_once('erros.php');
        require_once('conexao_db.php');
        try{
            $statement = $pdo->prepare('SELECT * FROM users WHERE cpf = :cpf');
            $statement->bindValue('cpf', $cpf);
            $statement->execute();
            $dados = $statement->fetch(PDO::FETCH_ASSOC);
            if(password_verify($senha, $dados["senha"])){
                return $dados;
            }else{
                return false;
            }
        }catch (Exception $e){
        $erro = new Erros('',$e->getMessage(), $e->getFile(), $e->getLine());
        $_SESSION['erro'] = serialize($erro);
        header('Location: ../view/templates/erro.php');
        exit;
        }
        
    }

}
?>