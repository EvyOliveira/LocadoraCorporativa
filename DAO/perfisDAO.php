<?php
    //require_once '$_SERVER['DOCUMENT_ROOT'].'classes/perfis.php';
    require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/classes/perfis.php');

    class perfisDAO extends Crud {
        private $d_perfil;
        protected $table = 'perfis';
        public function __construct($p_perfis){
            $this->d_perfil = $p_perfis;
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
        public function insert(){
        }
        public function update(){
        }
        public function autenticacao(){
        }
        public function load(){
            // Buscando todos os dados da tabela perfis
            $arr = $this->findAll();
            // Montando o array de objetos perfis
            foreach($arr as $chave => $valor){
                $objeto = new perfis();
                $objeto->setId($valor->id);
                $objeto->setNome($valor->nome);
                $arrPerfis[] = $objeto;
            }
            return $arrPerfis;
        }
    }
?>