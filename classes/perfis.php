<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/Crud.php');
session_start();

class usuarios extends Crud {
	protected $table = 'usuarios';
	private $id;
	private $nome;
	private $email;
	private $senha;
	private $perfil;

	public function insert(){}
	public function update(){}
	public function autenticacao(){}
	
	public function getId(){
		return $this->id;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getSenha(){
		return $this->senha;
	}

	public function getPerfil(){
		return $this->perfil;
	}
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}

	public function setSenha($senha){
		$this->senha = md5($senha);		
	}		
}

?>