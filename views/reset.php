<?php
	require_once($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
	
	$myuser = new usuarios();
	//$myuser->setSenha(md5(123456));
	$myuser->setSenha("123456");
	$myuser->setId($_POST["f_id"]);
    $myUserDAO = new usuariosDAO($myuser);
    $myUserDAO->reset();		
	Header("Location:../views/cadastro.php");
?>