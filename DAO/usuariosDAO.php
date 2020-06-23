<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/classes/usuarios.php');
    require_once('Crud.php');
    
    class usuariosDAO extends Crud{
        
        private $d_usuario;
        protected $table = 'usuarios';
        
        //Construtor
        public function __construct($p_usuario){
            $this->d_usuario = $p_usuario;
        }
        
        //Clone
        public function __clone(){
        }
        
        //Destrutor
        public function __destruct(){
            foreach ($this as $key => $value):
                unset($this->$key);
            endforeach;
            
            foreach (array_keys(get_defined_vars()) as $var):
                unset(${"$var"});
            endforeach;
        }
        
    	public function insert(){
    		$sql  = "INSERT INTO $this->table (nome, email, senha, perfil) VALUES (:nome, :email, :senha, :perfil)";
    		$stmt = DB::prepare($sql);
    		$stmt->bindParam(':nome', $this->d_usuario->nome);
    		$stmt->bindParam(':email', $this->d_usuario->email);
    		$stmt->bindParam(':senha', $this->d_usuario->senha);
    		$stmt->bindParam(':perfil', $this->d_usuario->perfil);
    		return $stmt->execute(); 
    	}
    	
    	public function update($id){
    		$sql  = "UPDATE $this->table SET nome = :nome, email = :email, perfil = :perfil WHERE id = :id";
    		$stmt = DB::prepare($sql);
    		$stmt->bindParam(':nome', $this->nome);
    		$stmt->bindParam(':email', $this->email);
    		$stmt->bindParam(':id', $id);
    		$stmt->bindParam(':id', $perfil);
    		return $stmt->execute();	
    	}
    	
    	public function login(){
    	    $sql = "SELECT id FROM $this->table WHERE email = '" . $this->d_usuario->getEmail() . "' and senha = '";
    	    $sql = $sql . $this->d_usuario->getSenha() . '\'';
    	    $stmt = DB::prepare($sql);
    		$stmt->execute();
    		//$count = $stmt->rowCount();
    		//return $count;
    		$ident = $stmt->fetchAll();
    		foreach ($ident as $key => $value) {
    			if ($value->id > 0) {
    				return $value->id;
    			} else {
    				return 0;
    			}
    		}
    	}
    	
    	public function reset($id, $senha){
    		$sql  = "UPDATE $this->table SET senha = :senha WHERE id = :id";
    		$stmt = DB::prepare($sql);
    		$stmt->bindParam(':senha', $this->senha);
    		$stmt->bindParam(':id', $id);
    		return $stmt->execute();
    	}
    	
    	public function load(){
            // Buscando todos os dados da tabela usuarios
            $arr = $this->findAll();
            // Montando um array de objetos usuarios
            foreach($arr as $chave => $valor){
                $objeto = new usuarios();
                $objeto->setId($valor->id);
                $objeto->setNome($valor->nome);
                $objeto->setEmail($valor->email);
                $objeto->setSenha($valor->senha);
                $objeto->setPerfil($valor->id_perfil);
                $arrUsuarios[] = $objeto;
            }
            // Retornando o array montado
            return $arrUsuarios;
    }
            
    }
?>