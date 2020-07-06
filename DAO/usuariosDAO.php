<?php
    //require_once '$_SERVER['DOCUMENT_ROOT'].'classes/perfis.php';    
    require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/classes/usuarios.php');
    
    class usuariosDAO extends Crud {
        private $d_usuario;
        protected $table = 'usuarios';
        public function __construct($p_usuario){
            $this->d_usuario = $p_usuario;
        }
        public function __clone(){
        }
        public function __destruct(){
            foreach($this as $key => $value):
                unset($this->$key);
            endforeach;
            foreach(array_keys(get_defined_vars()) as $var):
                unset(${"$var"});
            endforeach;
        }
              
        public function load(){
            //buscando todos os dados da tabela perfis
            $arr = $this->findAll();
            // Montando o array de objetos perfis
            foreach ($arr as $chave => $valor) {
                $objeto = new usuarios();
                $objeto->setId($valor->id);
                $objeto->setNome($valor->nome);
                $objeto->setEmail($valor->email);
                $objeto->setSenha($valor->senha);
                $objeto->setId_perfil($valor->id_perfis);
                $arrUsuarios[] = $objeto;
            }
            return $arrUsuarios;
        }

        public function update(){
            $sql  = "UPDATE $this->table SET nome = '". $this->d_usuario->getNome() ."',
                            email = '". $this->d_usuario->getEmail() ."', 
                            senha = '". $this->d_usuario->getSenha() ."',
                            id_perfil = '". $this->d_usuario->getPerfil() ."' 
                        WHERE id = '". $this->d_usuario->getId() ."'";
            $stmt = DB::prepare($sql);
            return $stmt->execute();	
        }

        public function insert(){
            $sql  = "INSERT INTO $this->table (nome, email, senha, id_perfil) VALUES (
                '". $this->d_usuario->getNome() ."', 
                '". $this->d_usuario->getEmail() ."', 
                '". $this->d_usuario->getSenha() ."',
                '". $this->d_usuario->getPerfil()."'
                )";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':senha', $this->senha);
            return $stmt->execute(); 
        }       
        
        public function alteraDados($id){
            $sql  = "UPDATE $this->table SET nome = :nome, email = :email WHERE id = :id";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':nome', $this->nome);
            $stmt->bindParam(':email', $this->email);		
            $stmt->bindParam(':id', $id);
            return $stmt->execute();	
        }

        public function reset(){            
            $sql  = "UPDATE $this->table SET senha = '". $this->d_usuario->getSenha() ."'
                        WHERE id = '". $this->d_usuario->getId() ."'";
            //$sql = "UPDATE $this->table SET senha = 'AAAAAAAA' WHERE id = 15";
            $stmt = DB::prepare($sql);
            return $stmt->execute();
        }
    
        public function autenticacao(){
            $sql = "SELECT * FROM $this->table WHERE email = '". $this->d_usuario->getEmail() . "' and senha = '";
            $sql = $sql . $this->d_usuario->getSenha() . '\'';
            $stmt = DB::prepare($sql);
            $stmt->execute();
            $ident = $stmt->fetchAll();
            foreach($ident as $key=>$value){
                if($value->id > 0){
                    return $value->id;
                }else{
                    return 0;
                }
            }
            //$_SESSION["dados"] = $dados;
            // return $dados;
        }
    }
?>