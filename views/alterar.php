<?php
	require_once ($_SERVER['DOCUMENT_ROOT'] . 'login_DAO/DAO/usuariosDAO.php');
	
	$myuser = new usuarios();
	$myuser->setNome($_POST['f_nome']);
	$myuser->setEmail($_POST['f_mail']);
	$myuser->setSenha($_POST['f_senha']);
	$myuser->setPerfil($_POST['f_perfil']);
	$myuser->setId($_POST['f_id']);
	$myUserDAO = new usuariosDAO($myuser);
	$myUserDAO->update();
	Header("Location:../views/cadastro.php");
?>