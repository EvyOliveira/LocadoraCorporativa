<?php
    require_once($_SERVER['DOCUMENT_ROOT'].'/classes/perfis.php');
    //require_once 'classes/perfis.php';
    require_once 'Crud.php';

    class perfisDAO extends Crud {
        private $d_perfil;
        protected $table = 'perfis';
        //Construtor
        public function __construct(){
        }
        //Clone
        public function __clone(){
        }
        //Destrutor
        public function __destruct(){
            foreach($this as $key => $value):
                unset($this->$key);
            endforeach;
            foreach(array_keys(get_defined_vars()) as $var):
                unset(${"$var"});
            endforeach;
        }

        public function insert(){
    		$sql  = "INSERT INTO $this->table (nome) VALUES ('". $this->d_perfil->nome . "')";
    		$stmt = DB::prepare($sql);
    		return $stmt->execute(); 
        }
        
        public function update($id){
    		$sql  = "UPDATE $this->table SET nome = '".$this->d_perfil->nome."' WHERE id = this->d_perfil->id";
    		$stmt = DB::prepare($sql);
    		return $stmt->execute();	
    	}
        
        //public function autenticacao(){}

        public function load(){
    	    // Buscando todos os dados da tabela perfis
            $arr = $this->findAll();
            // Montando o array de objetos perfis
            foreach($arr as $chave => $valor){
                $objeto = new perfis();
                $objeto->seTId($valor->id);
                $objeto->setNome($valor->nome);
                $arrPerfis[] = $objeto;
            }
            return $arrPerfis;
        }
    }
?>